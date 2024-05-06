<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/uploads/logos/hunab_icono.png">

        <title>@yield('title')</title>

        <link href="/assets/css/vendor.min.css" rel="stylesheet" />
        <link href="/assets/css/app.min.css" rel="stylesheet" />
        <link href="/assets/js/plugins/select2/select2.min.css"  rel="stylesheet" />
       <!-- <link href="/vendor/mckenziearts/laravel-notify/css/notify.css" rel="stylesheet" /> 
    -->
        @notifyCss
        @stack('css')
    
        
    </head>