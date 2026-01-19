<?php

namespace App\Http\Controllers;

use App\Models\Estabelecimento;
use App\Models\Cnae;
use App\Http\Services\BrasilApiService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Geocoder\Facades\Geocoder;

class EstabelecimentoController extends Controller
{
    protected $brasilApi;
    public function __construct(BrasilApiService $brasilApi)
    {
        $this->brasilApi = $brasilApi;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $estabelecimento = null;
        return view('estabelecimento.form', compact('estabelecimento'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = auth()->user();
        $data = $request->except('_token');
        $endereco = $data['logradouro'].', '.$data['numero'].' - '.$data['bairro'].', '.$data['cidade'].' - '.$data['estado'].', '.$data['cep'];
        $latLong = Geocoder::getCoordinatesForAddress($endereco);
        if($request->hasFile('logo'))
        {
            $arquivo = $request->file('logo');  
            $extension = $arquivo->extension();
            $filename = hash('sha256', 'logo'.$user->id.$arquivo->getClientOriginalName().date('Y-m-d H:i:s'));
            $filename = $filename.'.'.$extension;
            $arquivo->move(public_path('storage/logos/'), $filename);// ? 
        }
        $estabelecimento = Estabelecimento::create([
            'user_id' => $user->id,
            'nome' => $data['nome'],  
            'cnpj' => $data['cnpj'],         
            'imagem' => $filename,
            'cep' => $data['cep'],
            'logradouro' => $data['logradouro'],
            'numero' => $data['numero'],
            'complemento' => $data['complemento'],
            'bairro' => $data['bairro'],
            'cidade' => $data['cidade'],
            'estado' => $data['estado'],
            'telefone' => $data['telefone'],
            'email' => $data['email'],
            'lat' => $latLong['lat'],
            'long' => $latLong['lng'],
        ]);
        return redirect()->route('estabelecimentos.edit', ['estabelecimento' => $estabelecimento->id]);
            
    }

    /**
     * Display the specified resource.
     */
    public function show(Estabelecimento $estabelecimento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estabelecimento $estabelecimento)
    {
        //
        return view('estabelecimento.form', compact('estabelecimento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estabelecimento $estabelecimento)
    {
        //
        $user = auth()->user();
        $data = $request->except('_token');
        $endereco = $data['logradouro'].', '.$data['numero'].' - '.$data['bairro'].', '.$data['cidade'].' - '.$data['estado'].', '.$data['cep'];
        $latLong = Geocoder::getCoordinatesForAddress($endereco);
        if($request->hasFile('logo'))
        {
            $arquivo = $request->file('logo');  
            $extension = $arquivo->extension();
            $filename = hash('sha256', 'logo'.$user->id.$arquivo->getClientOriginalName().date('Y-m-d H:i:s'));
            $filename = $filename.'.'.$extension;
            $arquivo->move(public_path('storage/logos/'), $filename);// ? 
        }
        else
        {
            $filename = $estabelecimento->imagem;
        }
        $estabelecimento->update([
            'nome' => $data['nome'], 
            'cnpj' => $data['cnpj'],            
            'imagem' => $filename,
            'cep' => $data['cep'],
            'logradouro' => $data['logradouro'],
            'numero' => $data['numero'],
            'complemento' => $data['complemento'],
            'bairro' => $data['bairro'],
            'cidade' => $data['cidade'],
            'estado' => $data['estado'],
            'telefone' => $data['telefone'],
            'email' => $data['email'],
            'lat' => $latLong['lat'],
            'long' => $latLong['lng'],
        ]);
        return redirect()->route('estabelecimentos.edit', ['estabelecimento' => $estabelecimento->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estabelecimento $estabelecimento)
    {
        //
    }

    public function estabelecimentosCategoria(Request $request, $categoria)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $query = Estabelecimento::with('servicos', 'galeria')
            ->whereRelation('servicos', 'categoria_servico_id', $categoria);

        if ($latitude && $longitude) {
            // Calcula a distância em KM usando a fórmula de Haversine e ordena por proximidade
            // Nota: Usamos `long` entre crases pois é uma palavra reservada no MySQL
            $query->select('*')
                ->selectRaw("(6371 * acos(cos(radians(?)) * cos(radians(lat)) * cos(radians(`long`) - radians(?)) + sin(radians(?)) * sin(radians(lat)))) AS distancia", [$latitude, $longitude, $latitude])
                ->orderBy('distancia');
        }

        return $query->get();
    }

    public function verificaCnpj(Request $request)
    {
        $user = auth()->user();
        $estabelecimento = Estabelecimento::where('user_id', $user->id)->first();
        $response = $this->brasilApi->getCnae($estabelecimento->cnpj);
        $estabelecimento->verificado_em = date('Y-m-d H:i:s');
        $estabelecimento->save();
        $cnaesVerificados = [];
        $cnae = Cnae::where('codigo', $response['cnae_fiscal'])->first();
        if(is_null($cnae))
        {
            $cnae = Cnae::create([
                'codigo' => $response['cnae_fiscal'],
                'descricao' => $response['cnae_fiscal_descricao']
            ]);
        }
        $cnaesVerificados[] = $cnae->id;
        foreach($response['cnaes_secundarios'] as $cnaeApi)
        {
            $cnae = Cnae::where('codigo', $cnaeApi['codigo'])->first();
            if(is_null($cnae))
            {
                $cnae = Cnae::create([
                    'codigo' => $cnaeApi['codigo'],
                    'descricao' => $cnaeApi['descricao']
                ]);
            }
            $cnaesVerificados[] = $cnae->id;
        }
        $estabelecimento->cnaes()->sync($cnaesVerificados);
        return redirect()->route('estabelecimentos.edit', ['estabelecimento' => $estabelecimento->id]);
    }
}
