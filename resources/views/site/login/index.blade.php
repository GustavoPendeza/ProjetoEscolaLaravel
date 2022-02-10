@extends('layouts.site')

@section('content')

<div class="d-flex justify-content-center mt-3">

    <div class="card mt-3 text-dark text-center" style="width: 500px;">
       
        <div class="card-header">
            <h1>Login</h1>
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

            <form action="{{route('site.login.do')}}" method="post">
                @csrf
                <div class="form-floating my-3">

                    <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" value="{{old('name')}}" required autofocus>
                    <label for="email" class="text-dark">E-mail</label>
                    
                </div>

                <div class="form-floating my-4">

                    <input type="password" name="password" class="form-control" id="senha" minlength="8" placeholder="Senha" required>
                    <label for="senha" class="text-dark">Senha</label>
                    
                </div>
                        
                <div class="form-group my-3">
                    <button type="submit" class="btn btn-lg btn-primary">Entrar</button>
                </div>

            </form>

            <a href="{{route('site.forgot')}}">Esqueceu sua senha?</a>
            |
            <a href="{{route('site.login.create')}}">Cadastre-se</a>

        </div>

    </div>

</div>

@endsection