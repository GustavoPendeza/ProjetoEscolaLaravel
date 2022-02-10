<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Método responsável por verificar se o usuário está logado como estudante ou admin para o LoginController
     * @return Route
     */
    public static function authLogin()
    {
        if (Auth::user()->access === 0) {
            return redirect()->route('student.home');
        }elseif(Auth::user()->access === 1) {
            return redirect()->route('admin.home');
        }
    }

    /**
     * Método responsável por verificar se o usuário está logado como estudante e retornar uma view
     * @param string $view
     * @param array $data
     * @return View
     */
    public static function authStudent($view, $data = [])
    {
        if (Auth::user()->access === 0) {
            return view($view, $data);
        }elseif(Auth::user()->access === 1) {
            return redirect()->route('admin.home');
        }      
    }

    /**
     * Método responsável por verificar se o usuário está logado como admin e retornar uma view
     * @param string $view
     * @param array $data
     * @return View
     */
    public static function authAdmin($view, $data = [])
    {
        if (Auth::user()->access === 0) {
            return redirect()->route('student.home');
        }elseif(Auth::user()->access === 1) {
            return view($view, $data);
        }      
    }
}
