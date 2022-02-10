<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeAdminController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO COMO ADMIN
        if (Auth::check() === true) {
            // PEGA DADOS DO USUÁRIO LOGADO
            $authUser = Auth::user();

            return AuthController::authAdmin('admin.home.index', [
                'authUser' => $authUser
            ]);
        }

        return redirect()->route('site.login');
    }
}
