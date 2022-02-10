@extends('layouts.site')

@section('content')

<div class="d-flex justify-content-center mt-3">

    <div class="card mt-3 text-dark text-center" style="width: 500px;">
       
        <div class="card-header">
            <h3>Esqueceu sua senha?</h3>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('site.forgot')}}" method="post">
                @csrf
                <div class="form-floating my-3">

                    <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" value="{{old('name')}}" required autofocus>
                    <label for="email" class="text-dark">E-mail</label>
                    
                </div>
                        
                <div class="form-group my-3">
                    <button type="submit" class="btn btn-primary">Enviar e-mail</button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection