<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('clientes')}}" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        <span class="hide-menu">Clientes</span>
                    </a>
                </li>
                @if ($usuario->perfil === 'administrador')
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            <i class="fas fa-bed"></i>
                            <span class="hide-menu">Habitaciones</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{route('tipo_habitaciones')}}" class="sidebar-link">
                                    <i class="far fa-circle"></i>
                                    <span class="hide-menu">Tipos de habitaciones</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('habitaciones')}}" class="sidebar-link">
                                    <i class="far fa-circle"></i>
                                    <span class="hide-menu">Listado de habitaciones</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('personal')}}" aria-expanded="false">
                            <i class="fas fa-tools"></i>
                            <span class="hide-menu">Personal</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('usuarios')}}" aria-expanded="false">
                            <i class="fas fa-users"></i>
                            <span class="hide-menu">Usuarios</span>
                        </a>
                    </li>
                @endif
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('incidencias')}}" aria-expanded="false">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span class="hide-menu">Incidencias</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('reservas')}}" aria-expanded="false">
                        <i class="fas fa-calendar"></i>
                        <span class="hide-menu">Reservas</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('facturas')}}" aria-expanded="false">
                        <i class="fas fa-file-alt"></i>
                        <span class="hide-menu">Facturas</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
