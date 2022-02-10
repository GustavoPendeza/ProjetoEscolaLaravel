@extends('layouts.admin')

@section('content')

<h1>Matérias</h1>

<hr>

<a href="{{route('admin.subject.create')}}">
    <button type="button" class="btn btn-success">Cadastrar matéria</button>
</a>

<hr>

<table class="table table-light table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Categoria</th>
            <th>Matéria</th>
            <th>Descrição</th>
            <th style="width: 200px" colspan="2">Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($subjects as $subject)
        <tr>
            <td>{{$subject->id}}</td>
            <td>{{$subject->category}}</td>
            <td>{{$subject->name}}</td>
            <td>{{$subject->description}}</td>
            <td>
                <a href="{{route('admin.subject.edit', ['subject' => $subject->id])}}">
                    <button type="button" class="btn btn-primary">Editar</button>
                </a>
            </td>
            <td>
                <a href="{{route('admin.subject.delete', ['subject' => $subject->id])}}">
                    <button type="button" class="btn btn-danger">Excluir</button>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection