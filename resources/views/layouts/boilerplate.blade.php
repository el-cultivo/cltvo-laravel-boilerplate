<!DOCTYPE html>

<html lang="es">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <!-- include summernote css/js-->
        <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    </head>

    <body>
        @include('boilerplate.general.menu')
        <div class="container-fluid">
            <div class="row">
                @include('boilerplate.general.sidebar')

                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 content">
                    <div class="row">
                        <div class="col-xs-12">
                            <h1 class="page-header content__header-title">@yield('h1')</h1>                        
                        </div>
                    </div>
                    @yield('content')
                </div>

                <footer role="footer" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 footer">
                    @include('boilerplate.general.footer')
                </footer>
            </div>
        </div>


        <!-- Note: jQuery is on the head -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
        <!-- JavaScripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <!--Summernote -->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>
    </body>

</html>
