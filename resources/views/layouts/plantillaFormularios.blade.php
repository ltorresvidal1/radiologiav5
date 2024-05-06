<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
  
        @include('layouts.partial.head')
   
<body>
         <div id="app" class="app {{ (!empty($appClass)) ? $appClass : '' }}">
         @include('layouts.partial.header')
         @includeWhen(empty($sidebarHide), 'layouts.partial.sidebar')
         @include('layouts.partial.formulario')
         @include('layouts.partial.scripts')
</body>
</html>