<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\EditForgotRequest;
use App\Http\Requests\Site\ForgotRequest;
use App\Http\Requests\Site\LoginRequest;
use App\Http\Requests\Site\RegisterUserRequest;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // VERIFICA SE O USUÁRIO NÃO ESTÁ LOGADO
        if (Auth::check() === true) {
            return AuthController::authLogin();
        }

        return view('site.login.index');
    }
    
    /**
     * Método responsável por fazer o login do usuário
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // VERIFICA AS CREDENCIAIS
        if (Auth::attempt($credentials)) {
            // REALIZA O LOGIN
            if (Auth::check() === true) {
                return AuthController::authLogin();
            }
        }

        // RETORNA PARA O LOGIN COM MENSAGEM DE ERRO
        return redirect()->route('site.login')->withErrors(['E-mail e/ou senha inválidos.']);

    }
    
    /**
     * Método responsável por realizar o logout do usuário
     * @return Response
     */
    public function logout()
    {
        // REALIZA O LOGOUT
        Auth::logout();

        return redirect()->route('site.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // VERIFICA SE O USUÁRIO NÃO ESTÁ LOGADO
        if (Auth::check() === true) {
            return AuthController::authLogin();
        }

        return view('site.login.create');
    }

    /**
     * Método responsável por cadastrar um usuário.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(RegisterUserRequest $request)
    {

        $user = $request->all();

        $user['password'] = Hash::make($user['password']);
        
        User::create($user);

        return redirect()->route('site.login')->withErrors(['Seu cadastro foi realizado com sucesso']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function forgot()
    {
        // VERIFICA SE O USUÁRIO NÃO ESTÁ LOGADO
        if (Auth::check() === true) {
            return AuthController::authLogin();
        }

        return view('site.forgot.forgotpassword');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ForgotRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function sendMail(ForgotRequest $request)
    {
        $users = User::all();
        
        // VERIFICA SE O E-MAIL ENVIADO NO CAMPO 'ESQUECI MINHA SENHA' EXISTE NO BANCO
        foreach ($users as $user) {
            if ($request->email == $user->email) {
                // CRIA UM TOKEN BASEADO NO E-MAIL
                $user->token = Hash::make($request->email);

                $user->save();

                // ENVIA UM E-MAIL AO USUÁRIO
                Mail::send(new ForgotPasswordMail($user));

                return redirect()->route('site.forgot')->withErrors('E-mail enviado. Acesse o link em seu e-mail para trocar sua senha.');
            }
        }
        
        return redirect()->route('site.forgot')->withErrors('Digite um e-mail cadastrado');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // VERIFICA SE O USUÁRIO NÃO ESTÁ LOGADO
        if (Auth::check() === true) {
            return AuthController::authLogin();
        }
            
        return view('site.forgot.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditForgotRequest $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(EditForgotRequest $request, User $user)
    {
        $request = $request->all();

        // VERIFICA SE O TOKEN DIGITADO ESTÁ CORRETO
        if($request['token'] == $user->token){

            $user->password = Hash::make($request['password']);

            // 'RESETA' O TOKEN 
            $user->token = Hash::make('reset_token');
                
            $user->updated_at = now();
    
            $user->save();
            
            return redirect()->route('site.login')->withErrors('Sua senha foi alterada com sucesso.');
        }

        return redirect()->back()->withErrors('Digite corretamente o token.');
    }

}
