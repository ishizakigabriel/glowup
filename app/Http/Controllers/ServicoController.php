<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use App\Models\Colaborador;
use App\Models\Estabelecimento;
use App\Models\CategoriaServico;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = auth()->user();
        if($user->UAC == 1)
        {
            $servicos = Servico::get();
        }
        else if(in_array($user->UAC, [3, 4, 5]))
        {
            $estabelecimento = Estabelecimento::with('servicos')->where('user_id', $user->id)->first();
            $servicos = $estabelecimento->servicos;
        }
        else
        {
            $servicos = [];
        }
        return view('servicos.index', compact('servicos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = auth()->user();
        $estabelecimento = Estabelecimento::where('user_id', $user->id)->first();
        $servico = null;
        $categorias = CategoriaServico::get();
        return view('servicos.form', compact('estabelecimento', 'servico', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = auth()->user();
        $estabelecimento = Estabelecimento::where('user_id', $user->id)->first();
        $data = $request->except('_token');
        $filename = '';
        if($request->hasFile('imagem'))
        {
            $arquivo = $request->file('imagem');            
            $extension = $arquivo->extension();
            $filename = hash('sha256', 'servico'.$arquivo->getClientOriginalName().date('Y-m-d H:i:s'));
            $filename = $filename.'.'.$extension;
            $arquivo->move(public_path('storage/servicos/'), $filename);// ?
        }
        $servico = Servico::create([
            'nome' => $data['nome'],
            'descricao' => $data['descricao'],
            'imagem' => $filename,
            'tempo_medio_duracao' => $data['tempo_medio_duracao'],
            'preco' => str_replace(',', '.', str_replace('.', '', $data['preco'])),
            'categoria_servico_id' => $data['categoria_servico_id'],
            'estabelecimento_id' => $estabelecimento->id
        ]);
        return redirect()->route('servicos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Servico $servico)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servico $servico)
    {
        //
        $user = auth()->user();
        $estabelecimento = Estabelecimento::where('user_id', $user->id)->first();
        $categorias = CategoriaServico::get();
        return view('servicos.form', compact('estabelecimento', 'servico', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servico $servico)
    {
        //
        $user = auth()->user();
        $estabelecimento = Estabelecimento::where('user_id', $user->id)->first();
        $data = $request->except('_token');
        $filename = '';
        if($request->hasFile('imagem'))
        {
            $arquivo = $request->file('imagem');            
            $extension = $arquivo->extension();
            $filename = hash('sha256', 'servico'.$arquivo->getClientOriginalName().date('Y-m-d H:i:s'));
            $filename = $filename.'.'.$extension;
            $arquivo->move(public_path('storage/servicos/'), $filename);// ?
        }
        else
        {
            $filename = $servico->imagem;
        }
        $servico->update([
            'nome' => $data['nome'],
            'descricao' => $data['descricao'],
            'imagem' => $filename,
            'tempo_medio_duracao' => $data['tempo_medio_duracao'],
            'preco' => str_replace(',', '.', str_replace('.', '', $data['preco']))
        ]);
        $servico->save();
        return redirect()->route('servicos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servico $servico)
    {
        //
        $servico->delete();
        return redirect()->route('servicos.index');
    }

    public function servicosEstabelecimento(Request $request, $estabelecimento)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $query = Estabelecimento::with('servicos', 'galeria', 'servicos.colaboradoresCapacitados');

        if ($latitude && $longitude) {
            // Calcula a distância em KM usando a fórmula de Haversine e ordena por proximidade
            // Nota: Usamos `long` entre crases pois é uma palavra reservada no MySQL
            $query->select('*')
                ->selectRaw("(6371 * acos(cos(radians(?)) * cos(radians(lat)) * cos(radians(`long`) - radians(?)) + sin(radians(?)) * sin(radians(lat)))) AS distancia", [$latitude, $longitude, $latitude])
                ->orderBy('distancia');
        }

        return $query->find($estabelecimento);
    }

    public function teste($estabelecimento)
    {
        $query = Estabelecimento::with('servicos', 'galeria', 'servicos.colaboradoresCapacitados');
        return $query->find($estabelecimento);
    }

    public function meusServicos()
    {
        $user = auth()->user();
        $estabelecimento = Estabelecimento::with('servicos')->where('user_id', $user->id)->first();
        $servicos = $estabelecimento->servicos;
        return view('servicos.index', compact('servicos'));
    }

    public function colaboradoresCapacitados(Servico $servico)
    {
        $user = auth()->user();
        $estabelecimento = Estabelecimento::with('servicos')->where('user_id', $user->id)->first();
        $colaboradores = $estabelecimento->colaboradores;
        $colaboradoresCapacitados = $servico->colaboradoresCapacitados()->get();
        return view('colaborador_servicos.index', compact('colaboradores', 'colaboradoresCapacitados', 'servico'));
    }   

    public function colaboradoresCapacitadosStore(Request $request, Servico $servico)
    {
        $data = $request->all();
        $servico->colaboradoresCapacitados()->attach($data['colaborador_id']);
        $servico->save();
        return redirect()->route('colaboradores_capacitados', ['servico' => $servico->id]);
    }

    public function colaboradoresCapacitadosDestroy(Request $request, Servico $servico, Colaborador $colaborador)
    {
        $servico->colaboradoresCapacitados()->detach($colaborador);
        return redirect()->route('colaboradores_capacitados', ['servico' => $servico->id]);
    }
}
