<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

                break;
        }
    }
}
