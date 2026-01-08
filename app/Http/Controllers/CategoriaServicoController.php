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
        $categorias = CategoriaServico::get();
        return view('categoria_servico.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('categoria_servico.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->except('_token');
        if($request->hasFile('imgPlanta'))
        {
            $arquivo = $request->file('imgPlanta');            
            $extension = $arquivo->extension();
            $filename = hash('sha256', 'plantasala_'.$sala->id.$arquivo->getClientOriginalName().date('Y-m-d H:i:s'));
            $filename = $filename.'.'.$extension;
            $arquivo->move(public_path('storage/salas/'), $filename);// ?
            $sala->imgPlanta = $filename;
        }
        $categoriaServico = CategoriaServico::create([
            'nome' => $data['nome'],
            'descricao' => $data['descricao'],
        ]);
        return redirect()->route('categorias.index');
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
