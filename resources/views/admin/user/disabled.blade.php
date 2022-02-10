@extends('layouts.admin')

@section('content')

<h1>Usuários desativados</h1>

<hr>

<a href="{{route('admin.user.create')}}">
    <button type="button" class="btn btn-success">Cadastrar usuários</button>
</a>

<hr>

<div class="my-3">
    <a href="{{route('admin.user')}}">
        <button type="button" class="btn btn-light">Usuários Ativos</button>
    </a>
    
    <a href="{{route('admin.user.disabled')}}">
        <button type="button" class="btn btn-light">Usuários Desativados</button>
    </a>
</div>

<table class="table table-light table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Foto</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Nível de acesso</th>
            <th>Data de desativação</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>
                @if($user->image)
                    <img src="{{ asset('../storage/app/public/userimage/'.$user->image) }}" width="100px" height="100px">
                @endif
                @if(!$user->image)
                    <img src="{{ asset('../storage/app/public/userimage/user.jpg') }}" width="100px" height="100px">
                @endif
            </td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            @if($user->access === 0)
            <td>Aluno</td>
            @endif
            @if($user->access === 1)
            <td>Administrador</td>
            @endif
            <td>{{$user->deleted_at->format("d/m/Y H:i")}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection