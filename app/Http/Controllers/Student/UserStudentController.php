<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Student\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserStudentController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO COMO ESTUDANTE
        if (Auth::check() === true) {
            $authUser = Auth::user();
            
            return AuthController::authStudent('student.user.edit', [
                'user' => $user,
                'authUser' => $authUser
            ]);

        }

        return redirect()->route('site.login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditUserRequest  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, User $user)
    {
        $request = $request->all();
        
        $user->name = $request['name'];
        $user->email = $request['email'];

        // VERIFICA SE O AQUIVO DE IMAGEM EXISTE
        if(isset($request['image'])){
            // TRANSFORMA O NOME DELA EM UM HASH E SALVA NO STORAGE
            $request['image']->store('userimage', 'public');

            $request['image'] = $request['image']->hashName();

            $user->image = $request['image'];
        }

        // VERIFICA SE O PASSWORD NÃO É NULL
        if ($request['password'] !== null) {
            $user->password = Hash::make($request['password']);
        }

        $user->updated_at = now();

        $user->save();

        return redirect()->back();
    }
}
