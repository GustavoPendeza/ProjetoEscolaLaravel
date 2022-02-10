@extends('layouts.site')

@section('content')

<div class="d-flex justify-content-center">

    <div class="card mt-3 text-dark text-center" style="width: 500px;">
       
        <div class="card-header">
            <h1>Crie sua conta</h1>
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

            <form action="{{route('site.login.create')}}" method="post">
                @csrf
                <div class="form-floating my-3">

                    <input type="text" name="name" class="form-control" id="name" placeholder="Nome" value="{{old('name')}}" required>
                    <label for="name" class="text-dark">Nome*</label>
                    
                </div>

                <div class="form-floating my-4">

                    <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" value="{{old('email')}}" required>
                    <label for="email" class="text-dark">E-mail*</label>
                    
                </div>

                <div class="form-floating my-3">

                    <input type="password" name="password" class="form-control" id="password" placeholder="Senha" minlength="8" required>
                    <label for="password" class="text-dark">Senha*</label>
                    
                </div>

                <div class="form-floating my-4">

                    <input type="password" name="confirm_password" class="form-control" id="confirm_password" minlength="8" placeholder="Confirmar Senha" required>
                    <label for="confirm_password" class="text-dark">Confirmar Senha*</label>
                    
                </div>

                <input type="hidden" id="access" name="access" value="0">
                        
                <div class="form-group my-3">
                    <button type="submit" class="btn btn-lg btn-primary">Entrar</button>
                </div>

            </form>

            <a href="{{route('site.login')}}">Já tenho uma conta</a>

        </div>

    </div>

</div>

<script>
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Senhas diferentes!");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>

@endsection