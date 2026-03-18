<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Especificaciones - Power Moto</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/style_dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            <h1 class="form-title">Gestión de Especificaciones Técnicas</h1>
            <a href="{{ route('admin.especificaciones.create') }}" class="btn-create">
                <i class="fas fa-plus"></i> Nueva Ficha
            </a>
        </div>

        @if(session('success'))
        <div style="background: rgba(40, 167, 69, 0.1); border: 1px solid rgba(40, 167, 69, 0.3); color: #28a745; padding: 15px 20px; border-radius: 10px; margin-bottom: 25px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; animation: pulseGlow 2s infinite;">
            {{ session('success') }}
        </div>
        @endif

        <div class="crud-container" style="padding: 0; overflow: hidden;">
            <table class="user-table">
                <thead>
                    <tr>
                        <th>Moto / Modelo</th>
                        <th>Cilindrada</th>
                        <th>Motor</th>
                        <th>Potencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($especificaciones as $info)
                    <tr>
                        <td>
                            <span style="font-weight: 700; color: #fff;">{{ $info->moto->modelo }}</span>
                        </td>
                        <td>{{ $info->cilindrada }}</td>
                        <td>{{ $info->motor }}</td>
                        <td>{{ $info->potencia }}</td>
                        <td>
                            <div style="display: flex; gap: 10px; justify-content: center;">
                                <a href="{{ route('admin.especificaciones.edit', $info->id) }}" 
                                   class="btn-edit-link" 
                                   style="padding: 8px 16px; font-size: 0.75rem;">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                
                                <form action="{{ route('admin.especificaciones.destroy', $info->id) }}" 
                                      method="POST" 
                                      style="display: inline;"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar esta ficha técnica?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" style="padding: 8px 16px; font-size: 0.75rem;">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px; color: #666; font-size: 1.1rem;">
                            No hay fichas técnicas registradas aún.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>