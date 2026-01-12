<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estabelecimento;

class HomeController extends Controller
{
    //
    public function home()
    {
        $user = auth()->user();
        switch ($user->UAC) {
            case 0:
                return redirect()->route('choose_user_type');
                break;
            case 1:
                
                break;
            case 2:
                
                break;
            default:
                $estabelecimento = Estabelecimento::with('servicos')->where('user_id', $user->id)->first();
                if(is_null($estabelecimento))
                {
                    return redirect()->route('estabelecimentos.create');
                }
                else
                {
                    return redirect()->route('meus-servicos');
                }
                break;
        }
    }

    public function meuPerfil()
    {
        $user = auth()->user();
        $estabelecimento = Estabelecimento::where('user_id', $user->id)->first();
        if(!is_null($estabelecimento))
        {
            return redirect()->route('estabelecimentos.edit', ['estabelecimento' => $estabelecimento->id]);
        }
        else
        {
            return redirect()->route('estabelecimentos.create');
        }
    }
}
