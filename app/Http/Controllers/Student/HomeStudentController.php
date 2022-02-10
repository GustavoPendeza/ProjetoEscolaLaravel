<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeStudentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO COMO ESTUDANTE
        if (Auth::check() === true) {
            $authUser = Auth::user();
            
            return AuthController::authStudent('student.home.index', [
                'authUser' => $authUser
            ]);
        }

        return redirect()->route('site.login');
    }
}
