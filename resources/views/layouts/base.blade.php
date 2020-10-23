<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Sistema de Inventario</title>
        <!-- Fontfaces CSS-->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link href="{{ asset('css/font-face.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
        <!-- Bootstrap CSS-->
        <link href="{{ asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
        <!-- Vendor CSS-->
        <!-- Main CSS-->
        <link href="{{ asset('css/theme.css') }}" rel="stylesheet" media="all">
    </head>
    <body>
        <div class="page-wrapper">
            <!-- HEADER MOBILE-->
            <header class="header-mobile d-block d-lg-none">
                <div class="header-mobile__bar">
                    <div class="container-fluid">
                        <div class="header-mobile-inner">
                            <a class="logo" href="/">
                                <h1><span class="text-info">S</span>is<span class="text-info">Inv</span></h1>
                            </a>
                            <button class="hamburger hamburger--slider" type="button">
                                <span class="hamburger-box">
                                    <h2 class="hamburger-inner"><i class="zmdi zmdi-menu"></i></h2>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <nav class="navbar-mobile">
                    <div class="container-fluid">
                        <ul class="navbar-mobile__list list-unstyled">
                            <li>
                                <a href="/"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#"><i class="fas fa-boxes"></i>Productos <i class="fa fa-chevron-right"></i></a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li><a href="/categoria">Categorias</a></li>
                                    <li><a href="/producto">Productos</a></li>
                                    <li><a href="/medida">Unidad de Medida</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="/proveedores"><i class="fas fa-chart-bar"></i>Proveedores</a>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#"><i class="fas fa-copy"></i>Movimientos <i class="fa fa-chevron-right"></i></a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li><a href="/entrada">Entradas</a></li>
                                    <li><a href="/salida">Salidas</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- END HEADER MOBILE-->

            <!-- MENU SIDEBAR-->
            <aside class="menu-sidebar d-none d-lg-block">
                <div class="logo">
                    <a href="/">
                        <h1><span class="text-info">S</span>is<span class="text-info">Inv</span></h1>
                    </a>
                </div>
                <div class="menu-sidebar__content js-scrollbar1">
                    <nav class="navbar-sidebar">
                        <ul class="list-unstyled navbar__list">
                            <li>
                                <a href="/"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#"><i class="fas fa-boxes"></i>Productos <i class="fa fa-chevron-right"></i></a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li><a href="/categoria">Categorias</a></li>
                                    <li><a href="/producto">Productos</a></li>
                                    <li><a href="/medida">Unidad de Medida</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="/proveedor"><i class="fas fa-chart-bar"></i>Proveedores</a>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#"><i class="fas fa-copy"></i>Movimientos <i class="fa fa-chevron-right"></i></a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li><a href="/entrada">Entradas</a></li>
                                    <li><a href="/salida">Salidas</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <!-- END MENU SIDEBAR-->

            <!-- PAGE CONTAINER-->
            <div class="page-container">
                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid bg-white">
                            @yield('contenido')
                        </div>
                    </div>
                </div>
                @yield('modales')
                <!-- END MAIN CONTENT-->
                <!-- END PAGE CONTAINER-->
            </div>
        </div>
        <!-- Jquery JS-->
        <script src="{{ asset('vendor/jquery-3.2.1.min.js') }}"></script>
        <!-- Bootstrap JS-->
        <script src="{{ asset('vendor/bootstrap-4.1/popper.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
        <!-- Vendor JS       -->
        <script src="{{ asset('vendor/animsition/animsition.min.js') }}"></script>
        <!-- Main JS-->
        <script src="{{ asset('js/main.js') }}"></script>
        @yield('scripts')
    </body>
</html>
