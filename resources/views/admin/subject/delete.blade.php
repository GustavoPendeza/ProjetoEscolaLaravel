@extends('layouts.admin')

@section('content')

<h1>Deletar matéria</h1>

<hr>

<a href="{{route('admin.subject')}}">
    <button type="button" class="btn btn-light">Voltar</button>
</a>

<hr>

<form action="{{route('admin.subject.delete', ['subject' => $subject->id])}}" method="post" id="Form" name="Form">
    @csrf
    @method('delete')
    <div class="form-group">
        
    <div class="form-group">
        Você deseja realmente excluir a matéria <b>{{$subject->name}}</b> de <b>{{$subject->category}}</b>?
    </div>
        
    </div>

    <div class="form-group my-3">
        <button type="submit" class="btn btn-danger">Deletar matéria</button>
    </div>

</form>

@endsection