<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - RutaZero</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/style_dashboard.css') }}">
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('assets/images/logo-white.jpg') }}" alt="Logo">
        </div>
        <div class="container">
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Usuarios</a>
                <a href="{{ route('admin.equipo.index') }}" class="{{ request()->routeIs('admin.equipo.*') ? 'active' : '' }}">Equipo</a>
                <a href="{{ route('admin.modelos.index') }}" class="{{ request()->routeIs('admin.modelos.*') ? 'active' : '' }}">Modelos</a>
                <a href="{{ route('admin.especificaciones.index') }}" class="{{ request()->routeIs('admin.especificaciones.*') ? 'active' : '' }}">Especificaciones</a>

                <a href="{{ route('admin.contactos.index') }}" class="{{ request()->routeIs('admin.contactos.*') ? 'active' : '' }}">Mensajes</a>
                
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Salir') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </nav>
        </div>
    </header>

    <div class="main-container">
        <div class="crud-container">
            <h2>Gestión de Usuarios</h2>
            
            <table class="user-table">
                <thead>
                    <tr>
                        <th>Nombre Completo</th>
                        <th>Correo Electrónico</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="usuarios-table-body">
                    <tr>
                        <td colspan="3" class="text-center loading-msg">Cargando usuarios...</td>
                    </tr>
                </tbody>
            </table>

            <div class="actions">
                <a href="/admin/usuarios/create" class="btn-create">Registrar Nuevo</a>
            </div>
        </div>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tableBody = document.getElementById('usuarios-table-body');

        function cargarUsuarios() {
            fetch('/api/usuarios')
                .then(response => response.json())
                .then(res => {
                    tableBody.innerHTML = ''; 
                    const usuarios = res.data || [];

                    if (usuarios.length === 0) {
                        tableBody.innerHTML = '<tr><td colspan="3" class="text-center empty-msg">No hay usuarios registrados.</td></tr>';
                        return;
                    }

                    usuarios.forEach(user => {
                        const row = `
                            <tr>
                                <td>${user.name}</td>
                                <td>${user.email}</td>
                                <td class="actions-cell">
                                    <a href="/admin/usuarios/${user.id}/edit" class="btn-edit">Editar</a>
                                    <button onclick="eliminarUsuario(${user.id})" class="btn-delete">Eliminar</button>
                                </td>
                            </tr>`;
                        tableBody.innerHTML += row;
                    });
                })
                .catch(err => {
                    console.error('Error:', err);
                    tableBody.innerHTML = '<tr><td colspan="3" class="text-center error-msg">Error al cargar los usuarios.</td></tr>';
                });
        }

        window.eliminarUsuario = function(id) {
            if (confirm('¿Estás seguro de eliminar este usuario?')) {
                fetch(`/api/usuarios/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(result => {
                    alert(result.message || 'Usuario eliminado');
                    cargarUsuarios();
                })
                .catch(err => alert('Error al eliminar'));
            }
        }

        cargarUsuarios();
    });
</script>
</body>
</html>