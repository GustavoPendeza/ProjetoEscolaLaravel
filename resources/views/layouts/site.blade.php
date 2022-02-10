<!DOCTYPE HTML>
<html lang = "pt-br">
<head>
    <title>Projeto Laravel Escola</title>
    <meta charset = "UTF-8">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                
                <ul class="navbar-nav" style="width: 100%">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('site.home')}}">Início</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('site.category')}}">Matérias</a>
                    </li>
                    
                </ul>

                <div class="d-flex justify-content-end">
                    <a href="{{route('site.login')}}">
                        <button type="button" class="btn">Login</button>
                    </a>
                </div>

            </div>

        </nav>
    </div>
    <div class="container">
        @yield('content')
    

        <hr class="mt-5">

        <footer>
            Projeto Laravel Escola - 2022
        </footer>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>