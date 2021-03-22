<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | PAINEL</title>
    @yield('css')

    <link rel="stylesheet"
        href="{{ url('/') }}/bootstrap/css/bootstrap.min.css?h=ef7c97c3fc500717ce2d42d4e06f70d1">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ url('/') }}/fonts/fontawesome-all.min.css?h=18313f04cea0e078412a028c5361bd4e">
    <link rel="stylesheet" href="{{ url('/') }}/fonts/font-awesome.min.css?h=18313f04cea0e078412a028c5361bd4e">
    <link rel="stylesheet"
        href="{{ url('/') }}/fonts/simple-line-icons.min.css?h=18313f04cea0e078412a028c5361bd4e">
    <link rel="stylesheet"
        href="{{ url('/') }}/fonts/fontawesome5-overrides.min.css?h=18313f04cea0e078412a028c5361bd4e">
    <link rel="stylesheet" href="{{ url('/') }}/css/styles.min.css?h=fe3b477ea03b5a5c97a8b9e500f60492">
    <link rel="stylesheet" href="{{ url('/') }}/css/menu.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">

</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0"
                    href="{{ route('login') }}s">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-university"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>SEDUC</span></div>
                </a>
                <hr class="sidebar-divider my-0">


                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="{{ route('login') }}"><i
                                class="fas fa-tachometer-alt"></i><span>Página Inicial</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="../profile.html"><i
                                class=" fas fa-user"></i><span>Perfil</span></a></li>

                    @if ($rolesPerfil[0] == 1)
                        <li class="nav-item dropdownshow"><a data-toggle="dropdown" aria-expanded="false"
                                class="dropdown-toggle nav-link" href="#"><i
                                    class=" fas fa-user"></i><span>Usuário</span></a>
                            <div role="menu" class="dropdown-menu">
                                <a role="presentation" class="dropdown-item"
                                    href="{{ route('usuario') }}">Cadastro</a>
                                <a role="presentation" class="dropdown-item" href="{{ route('cargo') }}">Cargo</a>
                            </div>
                        </li>
                    @endif


                </ul>

                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                        id="sidebarToggle" type="button"></button></div>


            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3"
                            id="sidebarToggleTop" data-toggle="push-menu" type="button"><i
                                class="fas fa-bars"></i></button>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link"
                                    data-toggle="dropdown" aria-expanded="false" href="#"><i
                                        class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" role="menu"
                                    aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small"
                                                type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0"
                                                    type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>


                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow" role="presentation">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"
                                        data-toggle="dropdown" aria-expanded="false" href="#"><span
                                            class="d-none d-lg-inline mr-2 text-gray-600 small">{{ $uNomeSimples }}</span><img
                                            class="border rounded-circle img-profile" src="{{ $avatar }}"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
                                        <a class="dropdown-item" role="presentation" href="#"><i
                                                class="fas fa-user fa-sm fa-fw mr-2 text-gray-100"></i>Perfil</a><a
                                            class="dropdown-item" role="presentation" href="#"><i
                                                class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-100"></i>Configuração</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation"
                                            href="{{ route('logout') }}"><i
                                                class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-100"></i>Sair</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © MidoTech 2021</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>


    <!-- PAGE SCRIPTS -->
    <script src="{{ url('/') }}/js/jquery.min.js"></script>
    <script src="{{ url('/') }}/js/theme.js"></script>
    <script src="{{ url('/') }}/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ url('/') }}/js/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="{{ url('/') }}/js/script.min.js"></script>
    <script src="{{ url('/') }}/js/plugins/jquery-cookie/jquery.cookie-1.4.1.min.js"></script>

    <!-- PAGE PLUGINS -->
    @yield('js')

</body>

</html>
