@extends('layouts.site')

@section('content')

<h1 class="my-3">Matérias</h1>

<hr>

<div class="row">
@foreach($categories as $category)

    <div class="col">

        <div class="card my-3" style="width: 16rem;">
            <img src="{{ asset('../storage/app/public/categoryimage/'.$category->image) }}" class="card-img-top" height="250px">
            <div class="card-body">
                <h5 class="card-title">{{$category->name}}</h5>
                <a href="{{route('site.category.subject', ['category' => $category->id])}}" class="btn btn-primary">Ver matérias</a>
            </div>
        </div>
    
    </div>
    

@endforeach
</div>

@endsection