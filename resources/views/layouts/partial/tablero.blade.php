<div id="content" class="app-content">
	

    <div class="card">
            
        <div class="card-body">
            <div id="validation" class="mb-5">


                <div class="d-flex align-items-center mb-2">
                    
                    <div class="form-group col-11 m-0">
                    <div>
                        <h1 class="page-header mb-0"> @yield('tituloformulario')</h1>                    
                    </div>     
                    </div>     
                    <div class="form-group col-1 m-0">
                        <div>
                            <button type="button" class="btn btn-primary mb-1 btn-sm" onclick="AbrirModalFiltros()">
                                <i class="fa fa-cog"></i> Filtros
                            </button>
 
                        </div>     
                        </div>     
                   
                </div>



                <hr class="mb-1">
                
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