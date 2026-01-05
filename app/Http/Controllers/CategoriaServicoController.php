<?php

namespace App\Http\Controllers;

use App\Models\CategoriaServico;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriaServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return CategoriaServico::get();
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
    public function show(CategoriaServico $categoriaServico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoriaServico $categoriaServico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoriaServico $categoriaServico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoriaServico $categoriaServico)
    {
        //
    }
}
