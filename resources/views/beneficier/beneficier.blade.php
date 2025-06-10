<!DOCTYPE html>
<html lang="en">
<head>
    <title>app medicament by sen-csu</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="{{asset('assets/plugins/fontawesome/js/all.min.js')}}"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="{{asset('assets/css/portal.css')}}">
    @stack('styles')

    <style>
        .app-wrapper {
            margin-left: 250px; /* Ajustez selon la largeur de votre sidebar */
            padding-top: 56px; /* Hauteur de votre header */
        }
        .app-content {
            padding: 1rem;
        }
        .app-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
        }
        .app-sidebar {
            position: fixed;
            top: 56px; /* Hauteur de votre header */
            left: 0;
            bottom: 0;
            width: 250px; /* Largeur de votre sidebar */
            overflow-y: auto;
        }
        @media (max-width: 768px) {
            .app-wrapper {
                margin-left: 0;
            }
        }
    </style>
</head>

<body class="app">
    <header class="app-header fixed-top">
        @include('admin.topbare')
     @include('beneficier.sideB')
    </header>

    @yield('content')

    <footer class="app-footer">
        <div class="container text-center py-2">
            <small class="copyright">sen_csu <i class="fas fa-heart" style="color: #fb866a;"></i> by <a class="app-link" href="{{ route('home') }}" target="_blank"></a> for t6</small>
		    </div>
    </footer>

    <!-- Javascript -->
    <script src="{{asset('assets/plugins/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/plugins/chart.js/chart.min.js')}}"></script>
    <script src="{{asset('assets/js/index-charts.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    @stack('scripts')
</body>
</html>

