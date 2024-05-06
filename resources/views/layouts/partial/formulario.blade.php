<div id="content" class="app-content">
	

    <div class="card">
            
        <div class="card-body">
            <div id="validation" class="mb-5">


                <div class="d-flex align-items-center mb-3">
                    <div>
                        <h1 class="page-header mb-0"> @yield('tituloformulario')</h1>
                        
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item "><a href="@yield('hrefformulario')">@yield('principalformulario')</a></li>
                            <li class="breadcrumb-item active">@yield('accionformulario')</li>
                        </ul>
                        <p> @yield('descripcionformulario')</p>
                    </div>     

                    @yield('botonesformulario')
                   
                </div>
                
                <div class="mb-5">
 
                        <div>
                            
                       
                        
                            <div class="@yield('classformulario')">
                                
                                <div class="card-body pb-2">

                                    @yield('content')
                                    
                                </div>
                            </div>                                
                         </div>
                </div>
            </div>
        
    </div>
</div>