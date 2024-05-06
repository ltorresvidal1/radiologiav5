<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
    <head>
        @include('layouts.partial.head')
    </head>
<body>
         <div id="app" class="app {{ (!empty($appClass)) ? $appClass : '' }}">
         @include('layouts.partial.headercitas')
         @includeWhen(false, 'layouts.partial.sidebar')
         @includeWhen(false, 'layouts.partial.menu_lateral')
  
         @include('layouts.partial.citas')
         @include('layouts.partial.scripts')
</body>
</html>