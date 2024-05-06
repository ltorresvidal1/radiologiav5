<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
    <head>
        @include('layouts.partial.head')
    </head>
<body>
         <div id="app" class="app {{ (!empty($appClass)) ? $appClass : '' }}">
         @include('layouts.partial.header')
         @includeWhen(false, 'layouts.partial.sidebar')
         @includeWhen(true, 'layouts.partial.menu_horizontal')
         @include('layouts.partial.tablero')
         @include('layouts.partial.scripts')
</body>
</html>