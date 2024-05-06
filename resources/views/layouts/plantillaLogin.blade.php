<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/uploads/logos/hunab_icono.png">
    <title>@yield('title')</title>

    <link href="/assets/css/vendor.min.css" rel="stylesheet" />
    <link href="/assets/css/app.min.css" rel="stylesheet" />
    <link href="/assets/css/app.min.css" rel="stylesheet" />
    <link href="/vendor/mckenziearts/laravel-notify/css/notify.css" rel="stylesheet" />

    <style>

        body {
          height: 100%;
          background-size: cover;
          background-repeat: no-repeat;
          background-position: center center;
          background-attachment: fixed;
        }
        /*
        @media (max-width: 480px) {
            body {
                background-image: url("/assets/img/login/fondo_mb.png");
            }
        }*/
        
        @media (min-width: 1025px) {
            body {
                background-image: url("/assets/img/login/fondo_pc.png");
           }
        }
    </style>
</head>
<body>
    @yield('content')
     <script src="/assets/js/vendor.min.js"></script>
    <script src="/assets/js/app.min.js"></script>
    <script src="/vendor/mckenziearts/laravel-notify/js/notify.js"></script>
  

</body>
</html>