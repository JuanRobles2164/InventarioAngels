<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{route('material.index')}}">Inicio</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarClienteDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Cliente
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="{{route('cliente.index')}}">Index</a>
            <a class="dropdown-item" href="{{route('cliente.create')}}">Crear</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarMaterialDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Material
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarMaterialDropDown">
            <a class="dropdown-item" href="{{route('material.index')}}">Index</a>
            <a class="dropdown-item" href="{{route('material.create')}}">Crear</a>
            <a class="dropdown-item" href="#">Reportes</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarFacturaDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Factura
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarFacturaDropDown">
            <a class="dropdown-item" href="{{route('factura.index')}}">Index</a>
            <a class="dropdown-item" href="{{route('factura.create')}}">Crear</a>
            <a class="dropdown-item" href="{{route('reportes.facturas')}}">Reportes</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarInventarioDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Inventario
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarInventarioDropDown">
            <a class="dropdown-item" href="{{route('kardex.index')}}">Index</a>
            <a class="dropdown-item" href="#">Reportes</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarTipoMovimientoDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Tipo Movimiento
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Index</a>
            <a class="dropdown-item" href="#">Crear</a>
          </div>
        </li>

      </ul>
    </div>
  </nav>