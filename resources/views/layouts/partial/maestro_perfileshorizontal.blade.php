@php    
if(auth()->user()->perfile_id==1) {

    
}
if(auth()->user()->perfile_id==2) {

}

if(auth()->user()->perfile_id==3) {
    echo '<div class="menu-item">
            <a href="/principal" class="menu-link">
                <span class="menu-icon"><i class="fa fa-address-book"></i></span>
                <span class="menu-text">Agenda</span>		
            </a>
        </div>
        <div class="menu-item">
            <a href="/estudiosdeturno" class="menu-link">
                <span class="menu-icon"><i class="fa fa-hospital"></i></span>
                <span class="menu-text">Turno</span>		
            </a>
        </div>
        
    <div class="menu-item has-sub">
        
        <a class="menu-link">
            <span class="menu-icon">
            <i class="fa fa-tasks"></i>
            </span>
            <span class="menu-text">Estudios</span>
            <span class="menu-caret"><b class="caret"></b></span>
        </a>
    <div class="menu-submenu">   
        <div class="menu-item">
            <a href="/estudioscompletados" class="menu-link">
            <span class="menu-text">Completados</span>
            </a>
        </div>
        <div class="menu-item">
            <a href="/estudiosenproceso" class="menu-link">
            <span class="menu-text">En Proceso</span>
            </a>
        </div>
        <div class="menu-item">
            <a href="/estudiosporvalidar" class="menu-link">
            <span class="menu-text">Por Validar</span>
            </a>
        </div>
    </div>
</div>';
}
@endphp