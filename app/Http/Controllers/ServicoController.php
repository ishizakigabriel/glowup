<?php

namespace App\Http\Controllers;

use App\Models\Servico;
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
            'preco' => str_replace(',', '.', $data['preco']),
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
            'preco' => str_replace(',', '.', $data['preco'])
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

    public function servicosEstabelecimento($estabelecimento)
    {
        $estabelecimento = Estabelecimento::with('servicos')->find($estabelecimento);
        return $estabelecimento;
    }

    public function meusServicos()
    {
        $user = auth()->user();
        $estabelecimento = Estabelecimento::with('servicos')->where('user_id', $user->id)->first();
        $servicos = $estabelecimento->servicos;
        return view('servicos.index', compact('servicos'));
    }
}
