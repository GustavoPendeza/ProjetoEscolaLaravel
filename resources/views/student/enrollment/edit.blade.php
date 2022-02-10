@extends('layouts.student')

@section('content')

<h1 class="my-3">Atualizar matrícula</h1>

<hr>

<a href="{{route('student.enrollment')}}">
    <button type="button" class="btn btn-light">Voltar</button>
</a>

<hr>

<form action="{{route('student.enrollment.edit', ['enrollment' => $enrollment->id])}}" method="post">
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
        <div class="form-floating">

            <select class="form-select" id="subject" name="subject_id" required>
                <option>Selecione uma matéria</option>
                @foreach($subjects as $subject)
                    <option value="{{$subject->id}}" {{$enrollment->subject_id == $subject->id ? 'selected' : ''}}>{{$subject->name}}</option>
                @endforeach
            </select>
            <label for="subject">Matéria*</label>

        </div>

    </div>

    <div class="form-group my-3">
        <button type="submit" class="btn btn-success">Atualizar matrícula</button>
    </div>

</form>

@endsection