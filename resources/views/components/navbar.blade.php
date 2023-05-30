<div class="bg-comapa">
    <div class="container">
        <nav class="navbar navbar-expand-lg" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="img-fluid" width="128" src="{{ asset('imagenes/logoComapaBlancoPequeno.png') }}" alt="COMAPA NUEVO LAREDO">
                </a>
                <button class="navbar-toggler text-white" type="button" data-bs-theme="light" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>
                <div class="collapse navbar-collapse mt-3 mt-lg-0" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-0 ms-md-3">
                        <li class="nav-item d-block d-lg-none mb-3 lead" style='color:#ffffb3'>
                            <i class="bi bi-person-circle"></i>
                            <span class='ms-1'>{{ auth()->user()->nombre_usuario }}</span>
                        </li>
                        <li class="nav-item d-block d-md-none">
                            <hr class="text-white my-3">
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ isRoute('pagar') ? 'active fw-bold' : '' }}" href="{{ route('pagar.index') }}">
                                <i class="bi bi-cash-coin"></i>
                                <span class='ms-1'>Pagar</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ isRoute('cuentas_asociadas') ? 'active fw-bold' : '' }}" href="{{ route('cuentas_asociadas.index') }}">
                                <i class="bi bi-bookmarks"></i>
                                <span class='ms-1'>Cuentas asociadas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ isRoute('tarjetas_bancarias') ? 'active fw-bold' : '' }}" href="{{ route('tarjetas_bancarias.index') }}">
                                <i class="bi bi-credit-card"></i>
                                <span class='ms-1'>Tarjetas bancarias</span>
                            </a>
                        </li>
                        <li class="nav-item d-block d-lg-none">
                            <a class="nav-link {{ isRoute('usuario') ? 'active fw-bold' : '' }}" href="{{ route('usuario.edit') }}">
                                <i class="bi bi-gear"></i>
                                <span class='ms-1'>Mi configuracion</span>
                            </a>
                        </li>
                        <li class="nav-item d-block d-lg-none">
                            <a class="nav-link {{ isRoute('ayuda') ? 'active fw-bold' : '' }}" href="{{ route('ayuda.index') }}">
                                <i class="bi bi-question-circle"></i>
                                <span class='ms-1'>Ayuda</span>
                            </a>
                        </li>
                        <li class="nav-item d-block d-lg-none">
                            <hr class="text-white my-3">
                        </li>
                        <li class="nav-item d-block d-lg-none">
                            <a class="nav-link terminar-sesion" href="#logout">
                                <i class="bi bi-escape"></i>
                                <span class='ms-1'>Terminar sesión</span>
                            </a>
                        </li>
                    </ul>
                    <div class="d-none d-lg-inline-block dropdown" data-bs-theme="light">
                        <button class="btn border-0 text-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class='d-inline-block' style="color:#ffffb3">
                                <i class="bi bi-person-circle"></i>
                                <span>{{ auth()->user()->nombre_usuario }}</span>
                            </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                            <li>
                                <a class="dropdown-item" href="{{ route('usuario.edit') }}">
                                    <i class="bi bi-gear"></i>
                                    <span class='ms-1'>Mi configuración</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('ayuda.index') }}">
                                    <i class="bi bi-question-circle"></i>
                                    <span class='ms-1'>Ayuda</span>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger terminar-sesion" href="#logout">
                                    <i class="bi bi-escape"></i>
                                    <span class='ms-1'>Terminar sesión</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<form action="{{ route('logout') }}" method="post" id="formTerminarSesion">@csrf</form>
<br>
