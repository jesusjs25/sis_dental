@php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )
@php( $profile_url = View::getSection('profile_url') ?? config('adminlte.profile_url', 'logout') )

@if (config('adminlte.use_route_url', false))
    @php( $profile_url = $profile_url ? route($profile_url) : '' )
    @php( $logout_url = $logout_url ? route($logout_url) : '' )
@else
    @php( $profile_url = $profile_url ? url($profile_url) : '' )
    @php( $logout_url = $logout_url ? url($logout_url) : '' )
@endif

<li class="nav-item dropdown user-menu">

    {{-- Botón en el Navbar --}}
    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown">
        @if(config('adminlte.usermenu_image'))
            <img src="{{ Auth::user()->adminlte_image() }}"
                 class="user-image img-circle elevation-2 mr-2"
                 alt="{{ Auth::user()->name }}">
        @endif
        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
    </a>

    {{-- Desplegable del menú --}}
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 border-0 shadow">

        {{-- Encabezado Azul Centrado --}}
        <li class="user-header bg-primary d-flex flex-column align-items-center justify-content-center p-4">
            @if(config('adminlte.usermenu_image'))
                <img src="{{ Auth::user()->adminlte_image() }}"
                     class="img-circle elevation-3 mb-2"
                     style="width: 90px; height: 90px; object-fit: cover; border: 3px solid #fff;"
                     alt="{{ Auth::user()->name }}">
            @endif
            <p class="mb-0 text-center font-weight-bold text-uppercase" style="font-size: 1.1rem; letter-spacing: 0.5px;">
                {{ Auth::user()->name }}
            </p>
            @if(method_exists(Auth::user(), 'adminlte_desc'))
                <small class="text-uppercase font-weight-light">{{ Auth::user()->adminlte_desc() }}</small>
            @endif
        </li>

        {{-- Cuerpo con los Botones Blancos Centrados --}}
        <li class="user-body p-3 bg-white">
            <div class="d-flex flex-column gap-2">
                {{-- Botón 1: Contraseña --}}
                <a href="{{ url('admin/usuarios/' . Auth::id() . '/edit') }}" class="btn btn-outline-secondary text-dark btn-block py-2 mb-2 d-flex align-items-center justify-content-center shadow-sm" style="border-radius: 6px;">
                    <i class="fas fa-lock text-info mr-2"></i> Contraseña
                </a>

                {{-- Botón 2: Actualización de Datos --}}
                <a href="{{ url('admin/usuarios/' . Auth::id() . '/edit') }}" class="btn btn-outline-secondary text-dark btn-block py-2 mb-2 d-flex align-items-center justify-content-center shadow-sm" style="border-radius: 6px;">
                    <i class="fas fa-user-edit text-primary mr-2"></i> Actualización de Datos
                </a>

                {{-- Botón 3: Salir --}}
                <a href="#" class="btn btn-outline-secondary text-danger btn-block py-2 d-flex align-items-center justify-content-center shadow-sm" style="border-radius: 6px;"
                   onclick="event.preventDefault(); document.getElementById('logout-form-custom').submit();">
                    <i class="fas fa-power-off text-danger mr-2"></i> Salir
                </a>

                <form id="logout-form-custom" action="{{ $logout_url }}" method="POST" style="display: none;">
                    @if(config('adminlte.logout_method'))
                        @method(config('adminlte.logout_method'))
                    @endif
                    @csrf
                </form>
            </div>
        </li>

    </ul>
</li>
