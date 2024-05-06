
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
    <head>
        @include('layouts.partial.head')
    </head>
<body>
  
         <div id="app" class="app {{ (!empty($appClass)) ? $appClass : '' }}">
         @include('layouts.partial.header')
             
        
     @includeWhen(empty($sidebarHide), 'layouts.partial.sidebar')
   
         @include('layouts.partial.tableroprincipal')
         @include('layouts.partial.footer')
         @include('layouts.partial.scripts')
</body>
</html>