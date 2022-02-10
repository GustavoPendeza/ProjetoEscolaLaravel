@extends('layouts.site')

@section('content')

<h1 class="my-3">Matérias de {{$category['0']->category}}</h1>

<hr>

<div class="row">
    <div class="col">
        @foreach($category as $subject)

        <div class="card my-4">
            <div class="card-header">
                <b>{{$subject->name}}</b>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>{{$subject->description}}</p>
                </blockquote>
            </div>
        </div>

        @endforeach
    </div>

</div>

@endsection