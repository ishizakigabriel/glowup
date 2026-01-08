<?php

namespace App\Http\Controllers;

use App\Models\Estabelecimento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstabelecimentoController extends Controller
{
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
        return view('estabelecimento.form');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estabelecimento $estabelecimento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estabelecimento $estabelecimento)
    {
        //
    }

    public function estabelecimentosCategoria($categoria)
    {
        $estabelecimento = Estabelecimento::with('servicos')->whereRelation('servicos', 'categoria_servico_id', $categoria)->get();
        return $estabelecimento;
    }
}
