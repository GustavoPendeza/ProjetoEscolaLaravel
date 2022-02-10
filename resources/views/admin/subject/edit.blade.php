@extends('layouts.admin')

@section('content')

<h1>Atualização de matéria</h1>

<hr>

<a href="{{route('admin.subject')}}">
    <button type="button" class="btn btn-light">Voltar</button>
</a>

<hr>

<form action="{{route('admin.subject.edit', ['subject' => $subject->id])}}" method="post">
    @csrf
    @method('put')
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
        <div class="row">
            <div class="col">
                <div class="form-floating">

                <select class="form-select" id="category" name="category_id" required>
                    <option>Selecione uma categoria</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{$subject->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
                <label for="category">Categoria*</label>

                </div>
            </div>

            <div class="col">
                <div class="form-floating">

                    <input type="text" name="name" class="form-control" id="floatingCategoria" placeholder="Categoria" value="{{$subject->name}}" required>
                    <label for="floatingCategoria" class="text-dark">Matéria*</label>

                </div>
            </div>
        </div>

        <div class="form-floating my-4">
            <textarea class="form-control" name="description" placeholder="Descrição" id="description" style="height: 100px; resize: none;" required>{{$subject->description}}</textarea>
            <label for="description">Descrição</label>
        </div>

    </div>

    <div class="form-group my-3">
        <button type="submit" class="btn btn-success">Atualizar matéria</button>
    </div>

</form>

@endsection