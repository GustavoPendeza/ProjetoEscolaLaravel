@extends('layouts.site')

@section('content')

<h1>Alterar senha</h1>

<hr>

<form action="{{route('site.forgot.edit', ['user' => $user->id])}}" method="post" id="Form" name="Form">
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

        <div class="form-floating my-3">

            <input type="text" name="token" class="form-control" id="token" placeholder="Token" value="{{old('token')}}" required autofocus>
            <label for="token" class="text-dark">Token de acesso*</label>
            
        </div>

        <div class="form-floating my-3">

            <input type="password" name="password" class="form-control" id="password" placeholder="Senha" minlength="8" required>
            <label for="password" class="text-dark">Senha*</label>
            
        </div>

        <div class="form-floating my-3">

            <input type="password" name="confirm_password" class="form-control" id="confirm_password" minlength="8" placeholder="Confirmar Senha" required>
            <label for="confirm_password" class="text-dark">Confirmar Senha*</label>
            
        </div>

    </div>

    <div class="form-group my-3">
        <button type="submit" class="btn btn-success">Alterar senha</button>
    </div>

</form>

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