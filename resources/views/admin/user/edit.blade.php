@extends('layouts.admin')

@section('content')

<h1>Atualizar usuário</h1>

<hr>

<a href="{{route('admin.user')}}">
    <button type="button" class="btn btn-light">Voltar</button>
</a>

<hr>

<form action="{{route('admin.user.edit', ['user' => $user->id])}}" method="post" id="Form" name="Form">
    @csrf
    @method('patch')
    <div class="form-group">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <input type="hidden" value="{{ $user->id }}" name="user_id"> <!--Usado na Request de validação de e-mail-->

        <div class="row">

            <div class="col">
                <div class="form-floating my-3">

                    <input type="text" name="name" class="form-control" id="name" placeholder="Nome" value="{{$user->name}}" required>
                    <label for="name" class="text-dark">Nome*</label>
                    
                </div>
            </div>

            <div class="col">
                <div class="form-floating my-3">

                    <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" value="{{$user->email}}" required>
                    <label for="email" class="text-dark">E-mail*</label>
                    
                </div>
            </div>

        </div>

        <div class="form-check mt-2">
            <input class="form-check-input" type="radio" name="access" value="0" id="aluno" {{$aluno}}>
            <label class="form-check-label" for="aluno">
                Aluno
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="access" value="1" id="admin" {{$admin}}>
            <label class="form-check-label" for="admin">
                Administrador
            </label>
        </div>
        
    </div>

    <div class="form-group my-3">
        <button type="submit" class="btn btn-success">Atualizar usuário</button>
    </div>

</form>

@endsection