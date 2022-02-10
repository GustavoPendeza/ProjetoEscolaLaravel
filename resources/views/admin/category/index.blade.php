@extends('layouts.admin')

@section('content')

<h1>Categorias de estudo</h1>

<hr>

<a href="{{route('admin.category.create')}}">
    <button type="button" class="btn btn-success">Cadastrar categoria de estudo</button>
</a>

<hr>

<table class="table table-light table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Imagem</th>
            <th>Categoria</th>
            <th style="width: 200px" colspan="2">Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <td>{{$category->id}}</td>
            <td>
                @if($category->image)
                    <img src="{{ asset('../storage/app/public/categoryimage/'.$category->image) }}" width="100px" height="100px">
                @endif
            </td>
            <td>{{$category->name}}</td>
            <td>
                <a href="{{route('admin.category.edit', ['category' => $category->id])}}">
                    <button type="button" class="btn btn-primary">Editar</button>
                </a>
            </td>
            <td>
                <a href="{{route('admin.category.delete', ['category' => $category->id])}}">
                    <button type="button" class="btn btn-danger">Excluir</button>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection