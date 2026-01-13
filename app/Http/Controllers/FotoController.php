<?php

namespace App\Http\Controllers;

use App\Models\Estabelecimento;
use App\Models\Foto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FotoController extends Controller
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
            $fotos = Servico::get();
        }
        else if(in_array($user->UAC, [3, 4, 5]))
        {
            $estabelecimento = Estabelecimento::with('galeria')->where('user_id', $user->id)->first();
            $fotos = $estabelecimento->galeria;
        }
        else
        {
            $fotos = [];
        }
        return view('galeria.index', compact('fotos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $foto = null;
        return view('galeria.form', compact('foto'));
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
        if($request->hasFile('foto'))
        {
            $arquivo = $request->file('foto');            
            $extension = $arquivo->extension();
            $filename = hash('sha256', 'servico'.$arquivo->getClientOriginalName().date('Y-m-d H:i:s'));
            $filename = $filename.'.'.$extension;
            $arquivo->move(public_path('storage/fotos/'), $filename);// ?
        }
        $foto = Foto::create([
            'foto' => $filename,
            'descricao' => $data['descricao'],
            'ordem' => $data['ordem'],
            'estabelecimento_id' => $estabelecimento->id
        ]);
        return redirect()->route('fotos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Foto $foto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Foto $foto)
    {
        //
        return view('galeria.form', compact('foto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Foto $foto)
    {
        //
        $user = auth()->user();
        $estabelecimento = Estabelecimento::where('user_id', $user->id)->first();
        $data = $request->except('_token');
        $filename = '';
        if($request->hasFile('foto'))
        {
            $arquivo = $request->file('foto');            
            $extension = $arquivo->extension();
            $filename = hash('sha256', 'servico'.$arquivo->getClientOriginalName().date('Y-m-d H:i:s'));
            $filename = $filename.'.'.$extension;
            $arquivo->move(public_path('storage/fotos/'), $filename);// ?
        }
        else
        {
            $filename = $foto->foto;
        }
        $foto->update([
            'foto' => $filename,
            'descricao' => $data['descricao'],
            'ordem' => $data['ordem'],
            'estabelecimento_id' => $estabelecimento->id
        ]);
        $foto->save();
        return redirect()->route('servicos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Foto $foto)
    {
        //
        $foto->delete();
        return redirect()->route('servicos.index');
    }
}
