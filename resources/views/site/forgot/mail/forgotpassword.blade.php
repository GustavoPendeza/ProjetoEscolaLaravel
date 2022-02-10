<p>Olá, {{$user->name}}.</p>

<p>Você deve usar esse token para poder mudar sua senha:</p>

<p>{{$user->token}}</p>

<a href="{{route('site.forgot.edit', ['user' => $user->id])}}">Clique aqui para trocar sua senha</a>