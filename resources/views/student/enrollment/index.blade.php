@extends('layouts.student')

@section('content')

<h1 class="my-3">Matérias matriculadas</h1>

<hr>

<a href="{{route('student.enrollment.create')}}">
    <button type="button" class="btn btn-success">Matricular-se em uma matéria</button>
</a>

<hr>

<table class="table table-light table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Matéria</th>
            <th>Matriculado em:</th>
            <th style="width: 200px" colspan="2">Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($subjects as $subject)
        <tr>
            <td>{{$subject->id}}</td>
            <td>{{$subject->subject}}</td>
            <td>{{$subject->updated_at}}</td>
            <td>
                <a href="{{route('student.enrollment.edit', ['enrollment' => $subject->id])}}">
                    <button type="button" class="btn btn-primary">Trocar de matéria</button>
                </a>
            </td>
            <td>
                <a href="{{route('student.enrollment.delete', ['enrollment' => $subject->id])}}">
                    <button type="button" class="btn btn-danger">Trancar matrícula</button>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection