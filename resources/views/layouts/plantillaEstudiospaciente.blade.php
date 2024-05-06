<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
    <head>
        @include('layouts.partial.head')
    </head>
<body>
         <div id="app" class="app {{ (!empty($appClass)) ? $appClass : '' }}">
         @include('layouts.partial.headerportalpaciente')
         @includeWhen(false, 'layouts.partial.sidebar')
         @include('layouts.partial.tableroportalpaciente')
         @include('layouts.partial.scripts')
</body>
</html>