@extends('layouts.admin')

@section('content')

<h1>Deletar usuário</h1>

<hr>

<a href="{{route('admin.user')}}">
    <button type="button" class="btn btn-light">Voltar</button>
</a>

<hr>

<form action="{{route('admin.user.delete', ['user' => $user->id])}}" method="post" id="Form" name="Form">
    @csrf
    @method('delete')
    <div class="form-group">
        
    <div class="form-group">
        Você deseja realmente excluir o usuário <b>{{$user->name}}</b> - <b>"{{$user->email}}"</b>?
    </div>
        
    </div>

    <div class="form-group my-3">
        <button type="submit" class="btn btn-danger">Deletar usuário</button>
    </div>

</form>

@endsection