<!-- BEGIN #header -->
<div id="header" class="app-header">
    <!-- BEGIN mobile-toggler -->
    <div class="mobile-toggler">
        <button type="button" class="menu-toggler" data-toggle="sidebar-mobile">
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
    </div>
    <!-- END mobile-toggler -->

    <!-- BEGIN brand -->
    <div class="brand">
        <div class="desktop-toggler">
            
        </div>

        <a href="#" class="brand-logo"> 
            <img src="/uploads/logos/hunab.png" alt="" width="150" height="30" />
        </a>
    </div>
    <!-- END brand -->

    <!-- BEGIN menu -->
    <div class="menu">
        <form class="menu-search">
            
        </form>
     
        
        <div class="menu-item dropdown">

          
            <a href="#" data-bs-toggle="dropdown" data-bs-display="static" class="menu-link">
                <div class="menu-img online">
                    <img src="/assets/img/usuarios/ulogo.png" alt="" class="mw-100 mh-100 rounded-circle" />  
                </div>
                <div class="menu-text">{{auth()->user()->nombre}}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-end me-lg-3">
                <a class="dropdown-item d-flex align-items-center" href="#">Cambiar Clave <i class="fa fa-key fa-fw ms-auto text-gray-400 fs-16px"></i></a>
                <a class="dropdown-item d-flex align-items-center" href="/principal">Inicio<i class="fa fa-laptop fa-fw ms-auto text-gray-400 fs-16px"></i></a>
                <div class="dropdown-divider"></div>
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item d-flex align-items-center">Cerrar Session <i class="fa fa-toggle-on fa-fw ms-auto text-gray-400 fs-16px"></i></button>
                </form>
            </div>
        </div>
    </div>
    <!-- END menu -->
</div>
<!-- END #header -->
