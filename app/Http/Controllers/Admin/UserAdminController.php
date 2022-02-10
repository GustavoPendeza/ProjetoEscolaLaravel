<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    /**
     * Retorna uma lista com todos os usuário ativos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO COMO ADMIN
        if (Auth::check() === true) {
            
            $users = User::all();

            return AuthController::authAdmin('admin.user.index', [
                'users' => $users
            ]);
        }

        return redirect()->route('site.login');
        
    }

    /**
     * Retorna uma lista com todos os usuários desativados
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO COMO ADMIN
        if (Auth::check() === true) {

            $users = User::onlyTrashed()->get();

            return AuthController::authAdmin('admin.user.disabled', [
                'users' => $users
            ]);
            
        }

        return redirect()->route('site.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO COMO ADMIN
        if (Auth::check() === true) {
            return AuthController::authAdmin('admin.user.create');
        }

        return redirect()->route('site.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EditUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function post(CreateUserRequest $request)
    {
        $user = $request->all();

        $user['password'] = Hash::make($user['password']);

        // VERIFICA SE O ARQUIVO DE IMAGEM EXISTE
        if(isset($user['image'])){
            // TRANSFORMA O NOME DELA EM UM HASH E SALVA NO STORAGE
            $user['image']->store('userimage', 'public');

            $user['image'] = $user['image']->hashName();
        }

        User::create($user);

        return redirect()->route('admin.user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO COMO ADMIN
        if (Auth::check() === true) {
            
            // RETORNA CHECKED NO CAMPO RADIO DE ACCESS COM BASE NO NÍVEL DE ACESSO
            if ($user->access === 0) {
                $aluno = 'checked';
                $admin = '';
            }elseif ($user->access === 1) {
                $aluno = '';
                $admin = 'checked';
            }
    
            return AuthController::authAdmin('admin.user.edit', [
                'user' => $user,
                'aluno' => $aluno,
                'admin' => $admin
            ]);

        }

        return redirect()->route('site.login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  User  $user
     * @param  EditUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, EditUserRequest $request)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->access = $request->access;
        $user->updated_at = now();

        $user->save();

        return redirect()->route('admin.user');
    }

    /**
     * Show the form for delete the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function delete(User $user)
    {
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO COMO ADMIN
        if (Auth::check() === true) {
                
            return AuthController::authAdmin('admin.user.delete', [
                'user' => $user
            ]);

        }

        return redirect()->route('site.login');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.user');
    }
    
}
