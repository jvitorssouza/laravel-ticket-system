<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Bootstrap Admin App + jQuery">
    <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
    <title>Gestor 2.0</title>
    <!-- =============== VENDOR STYLES ===============-->
    <!-- FONT AWESOME-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- =============== BOOTSTRAP STYLES ===============-->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" id="bscss">
    <!-- =============== APP STYLES ===============-->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" id="maincss">
</head>

<body>
<div class="wrapper" style="padding: 10%">
    <div class="block-center mt-5 wd-xl">
        <!-- START card-->
        <div class="card card-flat">
            <div class="card-header text-center bg-dark">
                <a href="#">
                    <img class="block-center rounded" src="{{ asset('assets/images/logo.png') }}" alt="Image">
                </a>
            </div>
            <div class="card-body">
                <p class="text-center py-2">IDENTIFIQUE-SE PARA CONTINUAR.</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <div class="input-group with-focus">
                            <input type="text" name="credencial_login" id="credencial_login" class="form-control{{ $errors->has('credencial_login') ? ' is-invalid' : '' }}" placeholder="Usuário" required>
                            <div class="input-group-append">
                                <span class="input-group-text fa fa-user text-muted bg-transparent border-left-0"></span>
                            </div>
                        </div>
                    </div>

                    @if ($errors->has('credencial_login'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('credencial_login') }}</strong>
                        </span>
                    @endif

                    <div class="form-group">
                        <div class="input-group with-focus">
                            <input type="password" name="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Senha" required>
                            <div class="input-group-append">
                                <span class="input-group-text fas fa-user-lock text-muted bg-transparent border-left-0"></span>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-block btn-primary mt-3" type="submit">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

</html>