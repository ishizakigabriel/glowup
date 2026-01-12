<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Models\Estabelecimento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = auth()->user();
        // Usamos first() para pegar o modelo único, em vez de get() que retorna uma coleção
        $estabelecimento = Estabelecimento::with('colaboradores')->where('user_id', $user->id)->first();
        
        if (!$estabelecimento) {
            return redirect()->route('estabelecimentos.create');
        }

        $colaboradores = $estabelecimento->colaboradores;

        // Definição de limites baseados no plano (UAC)
        $maxColaboradores = match($user->UAC) {
            3 => 1,   // Plano Básico
            4 => 5,  // Plano Prata
            5 => 999, // Plano Ouro (Ilimitado)
            default => 3
        };

        return view('colaboradores.index', compact('colaboradores', 'maxColaboradores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $colaborador = null;
        return view('colaboradores.form', compact('colaborador'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = auth()->user();
        $estabelecimento = Estabelecimento::where('user_id', $user->id)->first();

        if (!$estabelecimento) {
            return redirect()->route('estabelecimentos.create')->with('error', 'Cadastre seu estabelecimento primeiro.');
        }

        // Verificar limite de colaboradores
        $maxColaboradores = match($user->UAC) {
            3 => 1,
            4 => 5,
            5 => 999,
            default => 3
        };

        if ($estabelecimento->colaboradores()->count() >= $maxColaboradores) {
            return redirect()->route('colaboradores.index')->with('error', 'Limite de colaboradores atingido para seu plano.');
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'cargo' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'biografia' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['estabelecimento_id'] = $estabelecimento->id;

        if ($request->hasFile('foto')) {
            $arquivo = $request->file('foto');            
            $extension = $arquivo->extension();
            $filename = hash('sha256', 'colaborador'.$arquivo->getClientOriginalName().date('Y-m-d H:i:s'));
            $filename = $filename.'.'.$extension;
            $arquivo->move(public_path('storage/colaboradores/'), $filename);// ?
        }

        $data['foto'] = $filename;


        Colaborador::create($data);

        return redirect()->route('colaboradores.index')->with('success', 'Colaborador cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Colaborador $colaboradore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Colaborador $colaboradore)
    {
        //
        $colaborador = $colaboradore;
        return view('colaboradores.form', compact('colaborador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Colaborador $colaboradore)
    {
        //
        $request->validate([
            'nome' => 'required|string|max:255',
            'cargo' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'biografia' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $arquivo = $request->file('foto');            
            $extension = $arquivo->extension();
            $filename = hash('sha256', 'colaborador'.$arquivo->getClientOriginalName().date('Y-m-d H:i:s'));
            $filename = $filename.'.'.$extension;
            $arquivo->move(public_path('storage/colaboradores/'), $filename);// ?
        }

        $data['foto'] = $filename;

        $colaboradore->update($data);

        return redirect()->route('colaboradores.index')->with('success', 'Colaborador atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Colaborador $colaboradore)
    {
        //
        $colaboradore->delete();
        return redirect()->route('colaboradores.index')->with('success', 'Colaborador removido com sucesso!');
    }
}
