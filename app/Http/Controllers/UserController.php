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
}
