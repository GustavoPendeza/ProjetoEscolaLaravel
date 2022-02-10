@extends('layouts.admin')

@section('content')

<h1>Cadastrar novo usuário</h1>

<hr>

<a href="{{route('admin.user')}}">
    <button type="button" class="btn btn-light">Voltar</button>
</a>

<hr>

<form action="{{route('admin.user.create')}}" method="post" id="Form" name="Form" enctype="multipart/form-data">
    @csrf
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
        <div class="row">

            <div class="col">
                <div class="form-floating my-3">

                    <input type="text" name="name" class="form-control" id="name" placeholder="Nome" value="{{old('name')}}" required>
                    <label for="name" class="text-dark">Nome*</label>
                    
                </div>
            </div>

            <div class="col">
                <div class="form-floating my-3">

                    <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" value="{{old('email')}}" required>
                    <label for="email" class="text-dark">E-mail*</label>
                    
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col">
                <div class="form-floating my-2">

                    <input type="password" name="password" class="form-control" id="password" placeholder="Senha" minlength="8" required>
                    <label for="password" class="text-dark">Senha*</label>
                    
                </div>
            </div>

            <div class="col">
                <div class="form-floating my-2">

                    <input type="password" name="confirm_password" class="form-control" id="confirm_password" minlength="8" placeholder="Confirmar Senha" required>
                    <label for="confirm_password" class="text-dark">Confirmar Senha*</label>
                    
                </div>
            </div>

        </div>

        <div class="form-check mt-2">
            <input class="form-check-input" type="radio" name="access" value="0" id="aluno" checked>
            <label class="form-check-label" for="aluno">
                Aluno
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="access" value="1" id="admin">
            <label class="form-check-label" for="admin">
                Administrador
            </label>
        </div>

        <div class="mt-3">
            <label for="formFile" class="form-label">Foto de Perfil</label>
        </div>
        <div class="input-group mb-4">
            <input type="file" name="image" class="form-control" id="formFile">
        </div>  

    </div>

    <div class="form-group my-3">
        <button type="submit" class="btn btn-success">Cadastrar usuário</button>
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