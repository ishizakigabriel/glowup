<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Estabelecimento;
use App\Models\Colaborador;
use App\Models\Servico;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('agendamentos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Agendamento $agendamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agendamento $agendamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agendamento $agendamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agendamento $agendamento)
    {
        //
    }

    public function horariosDisponiveis(Request $request, Estabelecimento $estabelecimento)
    {
        $data = date('Y-m-d', strtotime($request->input('data')));
        $servico = Servico::find($request->input('servico_id'));
        $colaborador_id = $request->input('colaborador_id');
        if($colaborador_id)
        {
            $colaboradoresAptos = Colaborador::where('id', $colaborador_id)->get();
        }        
        else
        {
            $colaboradoresAptos = $servico->colaboradoresCapacitados()->get();
        }

        $agendamentos = $estabelecimento->agendamentos()
            ->where('data', $data)
            ->whereIn('colaborador_id', $colaboradoresAptos->pluck('id'))
            ->get();

        $inicio_expediente = '08:00:00';
        $fim_expediente = '18:00:00';
        $horario = $inicio_expediente;
        $horarios = [];
        while($horario < $fim_expediente)
        {
            $inicio_agendamento = $horario;
            $fim_agendamento = date('H:i:s', strtotime("+$servico->tempo_medio_duracao minutes", strtotime($horario)));
            
            if($fim_agendamento > $fim_expediente) {
                break;
            }
            $horarioDisponivel = false;
            foreach($colaboradoresAptos as $colaborador) {
                if(!$this->verificarConflito($colaborador, $agendamentos, $inicio_agendamento, $fim_agendamento)) {
                    $horarioDisponivel = true;
                    break;
                }
            }
            if($horarioDisponivel)
            {
                $horarios[] = $horario;
            }            
            $horario = date('H:i:s', strtotime("+$estabelecimento->intervalo minutes", strtotime($horario)));
        }
        return response()->json($horarios, 200);
    }

    public function lockHorario(Request $request, Estabelecimento $estabelecimento)
    {
        return DB::transaction(function () use ($request, $estabelecimento) {
        $user = $request->user();
        $data = date('Y-m-d', strtotime($request->input('data')));
        $horario = date('H:i:s', strtotime($request->input('horario')));
        $servico = Servico::find($request->input('servico_id'));
        
        // Calcula o fim do agendamento
        $fim_agendamento = date('H:i:s', strtotime("+$servico->tempo_medio_duracao minutes", strtotime($horario)));
        $fim_expediente = '18:00:00';

        if($fim_agendamento > $fim_expediente) {
            return $this->gerarRespostaIndisponivel($request, $estabelecimento, 'Horário indisponível (excede expediente).');
        }

        $colaborador_id = $request->input('colaborador_id');
        if($colaborador_id)
        {
            $colaboradoresCandidatos = Colaborador::where('id', $colaborador_id)->lockForUpdate()->get();
        }        
        else
        {
            $colaboradoresCandidatos = $servico->colaboradoresCapacitados()->lockForUpdate()->get();
        }

        // Busca agendamentos existentes para verificar conflitos
        $agendamentosDia = $estabelecimento->agendamentos()
            ->where('data', $data)
            ->whereIn('colaborador_id', $colaboradoresCandidatos->pluck('id'))
            ->where('status', '!=', 2) // Ignora cancelados
            ->get();

        $disponiveis = [];

        foreach($colaboradoresCandidatos as $colaborador) {
            if(!$this->verificarConflito($colaborador, $agendamentosDia, $horario, $fim_agendamento)) {
                $disponiveis[] = $colaborador;
            }
        }

        if(empty($disponiveis)) {
            return $this->gerarRespostaIndisponivel($request, $estabelecimento, 'Horário não está mais disponível.');
        }

        // Seleção do colaborador (Balanceamento de carga se necessário)
        $colaboradorSelecionado = $colaborador_id ? $disponiveis[0] : $this->balancearCarga($disponiveis, $agendamentosDia);

        $agendamento = Agendamento::create([
            'user_id' => $user->id,
            'estabelecimento_id' => $estabelecimento->id,
            'servico_id' => $servico->id,
            'colaborador_id' => $colaboradorSelecionado->id,
            'data' => $data,
            'inicio' => $horario,
            'fim' => $fim_agendamento,
            'status' => 0
        ]);
        $response = Agendamento::with('user', 'estabelecimento', 'servico', 'colaborador')->find($agendamento->id);
        return response()->json($response, 201);
        });
    }

    private function verificarConflito($colaborador, $agendamentos, $inicio, $fim)
    {
        foreach($agendamentos as $agendamento) {
            if($agendamento->colaborador_id == $colaborador->id) {
                if($inicio < $agendamento->fim && $fim > $agendamento->inicio) {
                    return true;
                }
            }
        }
        return false;
    }

    private function balancearCarga($disponiveis, $agendamentosDia)
    {
        $menorCarga = -1;
        $selecionado = null;
        foreach($disponiveis as $colaborador) {
            $carga = 0;
            foreach($agendamentosDia as $agendamento) {
                if($agendamento->colaborador_id == $colaborador->id) {
                    $carga += (strtotime($agendamento->fim) - strtotime($agendamento->inicio));
                }
            }
            if($menorCarga == -1 || $carga < $menorCarga) {
                $menorCarga = $carga;
                $selecionado = $colaborador;
            }
        }
        return $selecionado;
    }

    private function gerarRespostaIndisponivel(Request $request, Estabelecimento $estabelecimento, $mensagem)
    {
        $response = $this->horariosDisponiveis($request, $estabelecimento);
        return response()->json([
            'message' => $mensagem,
            'horarios_disponiveis' => $response->getData()
        ], 422);
    }

    public function meusAgendamentos(Request $request)
    {
        $user = $request->user();
        $agendamentos = $user->agendamentos()->with('estabelecimento', 'servico', 'colaborador', 'servico.categoria')->where('status', '!=', 2)->get();
        return response()->json($agendamentos, 200);
    }

    public function confirmarAgendamento(Request $request, Agendamento $agendamento)
    {
        $user = $request->user();
        if($user->id == $agendamento->user_id)
        {            
            $agendamento->update(['status' => 1]);
            $agendamento->save();
        }
        return response()->json($agendamento, 200);
    }

    public function cancelarAgendamento(Request $request, Agendamento $agendamento)
    {
        $user = $request->user();
        if($user->id == $agendamento->user_id)
        {
            $agendamento->update(['status' => 2]);
            $agendamento->save();
        }        
        return response()->json($agendamento, 200);
    }
}
