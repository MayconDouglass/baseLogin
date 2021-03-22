<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - ADMIN</title>
    <link rel="stylesheet" href="{{ url('/') }}/css/login.css">
    <link rel="stylesheet" href="{{ url('/') }}/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ url('/') }}/fonts/fontawesome-all.min.css?h=18313f04cea0e078412a028c5361bd4e">
    <link rel="stylesheet" href="{{ url('/') }}/fonts/font-awesome.min.css?h=18313f04cea0e078412a028c5361bd4e">
    <link rel="stylesheet"
        href="{{ url('/') }}/fonts/simple-line-icons.min.css?h=18313f04cea0e078412a028c5361bd4e">
    <link rel="stylesheet"
        href="{{ url('/') }}/fonts/fontawesome5-overrides.min.css?h=18313f04cea0e078412a028c5361bd4e">
    <link rel="stylesheet" href="{{ url('/') }}/css/styles.min.css?h=fe3b477ea03b5a5c97a8b9e500f60492">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image"
                                    style="background-image: url({{ url('/') }}/storage/img/logo/paraibadosul.jpeg);">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Bem vindo ao Painel</h4>
                                    </div>

                                    @if (session('status_error'))
                                        <div class="alert alert-danger status ">
                                            {{ session('status_error') }}
                                        </div>
                                    @endif

                                    <form class="user" method="POST" action="/login">
                                        @csrf

                                        <div class="form-group">
                                            <input class="form-control control-user" type="email" placeholder="Email"
                                                name="email" autofocus>
                                        </div>

                                        <div class="form-group">
                                            <input class="form-control control-password" type="password"
                                                placeholder="Senha" name="senha">
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <div class="form-check">
                                                    <input class="form-check-input custom-control-input" type="checkbox"
                                                        id="checkRemember" name="remember">
                                                    <label class="form-check-label custom-control-label"
                                                        for="checkRemember">Manter conectado</label>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block text-white btn-user"><i
                                                class="fas fa-sign-in-alt"></i> Entrar</button>

                                        <hr>
                                    </form>
                                    <div class="text-center"><a class="small" href="forgot-password.html">Esqueci a
                                            senha</a></div>
                                    <div class="text-center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('/') }}/js/jquery.min.js?h=83e266cb1712b47c265f77a8f9e18451"></script>
    <script src="{{ url('/') }}/bootstrap/js/bootstrap.min.js?h=e46528792882c54882f660b60936a0fc"></script>
    <script src="{{ url('/') }}/js/chart.min.js?h=18313f04cea0e078412a028c5361bd4e"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="{{ url('/') }}/js/script.min.js?h=aef9b7341ddd357a7e1fdafce39099f1"></script>
</body>

</html>
