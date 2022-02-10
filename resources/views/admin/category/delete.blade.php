@extends('layouts.admin')

@section('content')

<h1>Deletar categoria de estudos</h1>

<hr>

<a href="{{route('admin.category')}}">
    <button type="button" class="btn btn-light">Voltar</button>
</a>

<hr>

<form action="{{route('admin.category.delete', ['category' => $category->id])}}" method="post" id="Form" name="Form">
    @csrf
    @method('delete')
    <div class="form-group">
        
    <div class="form-group">
        Você deseja realmente excluir a categoria <b>{{$category->name}}</b>?
    </div>
        
    </div>

    <div class="form-group my-3">
        <button type="submit" class="btn btn-danger">Deletar categoria</button>
    </div>

</form>

@endsection