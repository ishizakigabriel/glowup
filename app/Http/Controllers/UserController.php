<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function userType()
    {
        return view('config_user.tipo_usuario');
    }

    public function chooseUserType($tipo)
    {
        if($tipo == 2)
        {
            $user = auth()->user();
            $user->UAC = $tipo;
            $user->save();
            return redirect()->route('home');
        }
        else
        {
            return redirect()->route('escolher_plano');
        }
    }

    public function escolherPlano()
    {
        return view('config_user.plano_estabelecimento');
    }

    public function escolherPlanoSubmit($plano)
    {
        $user = auth()->user();
        $user->UAC = $plano;
        $user->save();
        return redirect()->route('home');
    }

    public function raioBusca(Request $request)
    {
        $user = $request->user();
        $user->raio_busca = $request->input('raio_busca');
        $user->save();
        return response()->json($user, 200);
    }

    public function aviso24h(Request $request)
    {
        $user = $request->user();
        $user->aviso_24h = $request->input('aviso_24h');
        $user->save();
        return response()->json($user, 200);
    }

    public function aviso2h(Request $request)
    {
        $user = $request->user();
        $user->aviso_2h = $request->input('aviso_2h');
        $user->save();
        return response()->json($user, 200);
    }

    public function editProfile(Request $request)
    {
        $user = $request->user();
        if($request->hasFile('avatar'))
        {
            $arquivo = $request->file('avatar');            
            $extension = $arquivo->extension();
            $filename = hash('sha256', 'user'.$arquivo->getClientOriginalName().date('Y-m-d H:i:s'));
            $filename = $filename.'.'.$extension;
            $arquivo->move(public_path('storage/avatar/'), $filename);            
            $user->foto = $filename;
        }
        $user->name = $request->input('nome');
        $user->save();
        return response()->json($user, 200);
    }
}
