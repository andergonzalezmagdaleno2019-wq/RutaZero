<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Ficha Técnica - Power Moto</title>
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
            <h1 class="form-title">Nueva Ficha Técnica</h1>
            <a href="{{ route('admin.modelos.index') }}" class="btn-cancel">Volver</a>
        </div>

        <div class="form-container">
            <form action="{{ route('admin.especificaciones.store') }}" method="POST">
                @csrf
                
                <div class="input-group">
                    <label for="moto_id">Seleccionar Modelo de Moto</label>
                    <select name="moto_id" id="moto_id" class="form-control" required>
                        <option value="" disabled selected>Elija una de sus motos...</option>
                        @foreach($motos as $moto)
                            <option value="{{ $moto->id }}">{{ $moto->modelo }} ({{ $moto->cilindrada }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <label>Tipo de Motor</label>
                            <input type="text" name="motor" class="form-control" placeholder="Ej: 4 cilindros en línea" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <label>Cilindrada Exacta</label>
                            <input type="text" name="cilindrada" class="form-control" placeholder="Ej: 599 cc" autocomplete="off" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <label>Sistema de Frenos</label>
                            <input type="text" name="frenos" class="form-control" placeholder="Ej: ABS de doble canal" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <label>Transmisión</label>
                            <input type="text" name="transmision" class="form-control" placeholder="Ej: 6 marchas" autocomplete="off" required>
                        </div>
                    </div>
                </div>

                <div class="input-group">
                    <label>Potencia</label>
                    <input type="text" name="potencia" class="form-control" placeholder="Ej: 119 HP @ 14,500 rpm" autocomplete="off" required>
                </div>

                <div class="input-group">
                    <label>Descripción Detallada</label>
                    <textarea name="descripcion" class="form-control" rows="4" placeholder="Escribe detalles sobre el rendimiento o tecnología..." autocomplete="off "></textarea>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn-submit">Registrar Especificaciones</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>