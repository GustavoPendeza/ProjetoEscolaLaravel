@extends('layouts.admin')

@section('content')

<h1>Cadastro de categoria de estudo</h1>

<hr>

<a href="{{route('admin.category')}}">
    <button type="button" class="btn btn-light">Voltar</button>
</a>

<hr>

<form action="{{route('admin.category.create')}}" method="post" enctype="multipart/form-data">
    @csrf
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
        <div class="form-floating">

            <input type="text" name="name" class="form-control" id="floatingCategoria" placeholder="Categoria" value="{{old('name')}}" required>
            <label for="floatingCategoria" class="text-dark">Categoria*</label>
            
        </div>

        <div class="mt-3">
            <label for="formFile" class="form-label">Imagem de categoria</label>
        </div>
        <div class="input-group mb-4">
            <input type="file" name="image" class="form-control" id="formFile">
        </div> 
    </div>

    <div class="form-group my-3">
        <button type="submit" class="btn btn-success">Cadastrar categoria</button>
    </div>

</form>

@endsection