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
        $categoria = null;
        return view('categoria_servico.form', compact('categoria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->except('_token');
        $filename = '';
        if($request->hasFile('imagem'))
        {
            $arquivo = $request->file('imagem');            
            $extension = $arquivo->extension();
            $filename = hash('sha256', 'categoria_'.$arquivo->getClientOriginalName().date('Y-m-d H:i:s'));
            $filename = $filename.'.'.$extension;
            $arquivo->move(public_path('storage/categorias/'), $filename);// ?
        }
        $categoriaServico = CategoriaServico::create([
            'nome' => $data['nome'],
            'descricao' => $data['descricao'],
            'imagem' => $filename
        ]);
        return redirect()->route('categorias.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoriaServico $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoriaServico $categoria)
    {
        //
        return view('categoria_servico.form', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaServico $categoria, Request $request)
    {
        //
        $data = $request->except('_token');
        $filename = '';
        if($request->hasFile('imagem'))
        {
            $arquivo = $request->file('imagem');            
            $extension = $arquivo->extension();
            $filename = hash('sha256', 'categoria_'.$arquivo->getClientOriginalName().date('Y-m-d H:i:s'));
            $filename = $filename.'.'.$extension;
            $arquivo->move(public_path('storage/categorias/'), $filename);// ?
        }
        $categoria->update([
            'nome' => $data['nome'],
            'descricao' => $data['descricao'],
            'imagem' => $filename
        ]);
        $categoria->save();
        return redirect()->route('categorias.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoriaServico $categoria)
    {
        //
        $categoria->delete();
        return redirect()->route('categorias.index');
    }
}
