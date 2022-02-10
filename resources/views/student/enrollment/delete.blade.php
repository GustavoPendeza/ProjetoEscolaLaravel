@extends('layouts.student')

@section('content')

<h1>Trancar matrícula</h1>

<hr>

<a href="{{route('student.enrollment')}}">
    <button type="button" class="btn btn-light">Voltar</button>
</a>

<hr>

<form action="{{route('student.enrollment.delete', ['enrollment' => $enrollment->id])}}" method="post" id="Form" name="Form">
    @csrf
    @method('delete')
    <div class="form-group">
        
    <div class="form-group">
        Você deseja realmente trancar a matrícula de <b>{{$subject->subject}}</b>?
    </div>
        
    </div>

    <div class="form-group my-3">
        <button type="submit" class="btn btn-danger">Trancar matrícula</button>
    </div>

</form>

@endsection