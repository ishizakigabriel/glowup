<?php

namespace App\Http\Controllers;

use App\Models\Cnae;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CnaeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cnaes = Cnae::get();
        return view('cnae.index', compact('cnaes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $cnae = null;
        return view('cnae.form', compact('cnae'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->except('_token');
        $cnae = Cnae::create([
            'codigo' => $data['codigo'],
            'descricao' => $data['descricao'],
        ]);
        return redirect()->route('cnaes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cnae $cnae)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cnae $cnae)
    {
        //
        return view('cnae.form', compact('cnae'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cnae $cnae)
    {
        //
        $data = $request->except('_token');
        $cnae->update([
            'codigo' => $data['codigo'],
            'descricao' => $data['descricao'],
        ]);        
        return redirect()->route('cnaes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cnae $cnae)
    {
        //
        $cnae->delete();
        return redirect()->route('cnaes.index');
    }
}
