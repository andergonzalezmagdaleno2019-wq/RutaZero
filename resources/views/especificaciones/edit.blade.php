<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ficha Técnica - Power Moto</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/style_dashboard.css') }}">
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('assets/images/logo-white.jpg') }}" alt="Logo">
        </div>
            <nav>
                <a href="/admin/dashboard">Usuarios</a>
                <a href="/admin/equipo">Equipo</a>
                <a href="/admin/modelos">Modelos</a>
                <a href="{{ route('admin.especificaciones.index') }}" class="{{ request()->routeIs('admin.especificaciones.*') ? 'active' : '' }}">Especificaciones</a>
                <a href="/admin/contacto">Mensajes</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Salir') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </nav>
    </header>

    <div class="main-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="form-title">Editar Ficha Técnica: <span style="color: #f1b317;">{{ $especificacion->moto->modelo }}</span></h1>
            <a href="{{ route('admin.especificaciones.index') }}" class="btn-cancel">Volver al listado</a>
        </div>

        <div class="form-container">
            <form action="{{ route('admin.especificaciones.update', $especificacion->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <label>Tipo de Motor</label>
                            <input type="text" name="motor" value="{{ $especificacion->motor }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <label>Cilindrada Exacta</label>
                            <input type="text" name="cilindrada" value="{{ $especificacion->cilindrada }}" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <label>Sistema de Frenos</label>
                            <input type="text" name="frenos" value="{{ $especificacion->frenos }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <label>Transmisión</label>
                            <input type="text" name="transmision" value="{{ $especificacion->transmision }}" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="input-group">
                    <label>Potencia</label>
                    <input type="text" name="potencia" value="{{ $especificacion->potencia }}" class="form-control" required>
                </div>

                <div class="input-group">
                    <label>Descripción Detallada</label>
                    <textarea name="descripcion" class="form-control" rows="4" required>{{ $especificacion->descripcion }}</textarea>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn-update">Actualizar Especificaciones</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>