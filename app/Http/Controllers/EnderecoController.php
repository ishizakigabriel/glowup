<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Geocoder\Facades\Geocoder;

class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $user = $request->user();
        $enderecos = $user->enderecos()->get();
        return response()->json($enderecos, 200);
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
        $data = $request->except('_token');
        $user = $request->user();
        $endereco = $data['logradouro'].', '.$data['numero'].' - '.$data['bairro'].', '.$data['cidade'].' - '.$data['estado'].', '.$data['cep'];
        $latLong = Geocoder::getCoordinatesForAddress($endereco);
        $endereco = Endereco::create([
            'user_id' => $user->id,
            'nome' => $data['nome'],
            'cep' => $data['cep'],
            'logradouro' => $data['logradouro'],
            'numero' => $data['numero'],
            'complemento' => $data['complemento'],
            'bairro' => $data['bairro'],
            'cidade' => $data['cidade'],
            'estado' => $data['estado'],
            'lat' => $latLong['lat'],
            'long' => $latLong['lng'],
        ]);
        return response()->json($endereco, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Endereco $endereco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Endereco $endereco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Endereco $endereco)
    {
        //
        $data = $request->except('_token');
        $user = $request->user();
        $endereco = $data['logradouro'].', '.$data['numero'].' - '.$data['bairro'].', '.$data['cidade'].' - '.$data['estado'].', '.$data['cep'];
        $latLong = Geocoder::getCoordinatesForAddress($endereco);
        $endereco->update([
            'nome' => $data->nome,
            'cep' => $data->cep,
            'logradouro' => $data->logradouro,
            'numero' => $data->numero,
            'complemento' => $data->complemento,
            'bairro' => $data->bairro,
            'cidade' => $data->cidade,
            'estado' => $data->estado,
            'lat' => $latLong['lat'],
            'long' => $latLong['lng'],
        ]);
        return response()->json($endereco, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Endereco $endereco)
    {
        //
        $user = $endereco->user();
        if($user->id != $endereco->user_id)
        {
            $endereco->delete();
        }
        return response()->json($user, 200);
    }
}
