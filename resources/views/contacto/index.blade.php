<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes de Contacto - RutaZero</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <main class="main-container">
        <div class="section-header">
            <h1>Mensajes Recibidos</h1>
        </div>

        <table class="user-table">
            <thead>
                <tr>
                    <th>NOMBRE</th>
                    <th>CORREO</th>
                    <th>ASUNTO</th>
                    <th>MENSAJE</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody id="contactos-table-body">
                <tr><td colspan="5" class="text-center loading-msg">Cargando mensajes...</td></tr>
            </tbody>
        </table>
    </main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tableBody = document.getElementById('contactos-table-body');

        function cargarContactos() {
            fetch('/api/contactos')
                .then(response => response.json())
                .then(responseObj => {
                    tableBody.innerHTML = '';
       
                    const mensajes = responseObj.data;

                    if (!mensajes || mensajes.length === 0) {
                        tableBody.innerHTML = '<tr><td colspan="5" class="text-center empty-msg">No hay mensajes nuevos.</td></tr>';
                        return;
                    }

                    mensajes.forEach(msg => {
                        tableBody.innerHTML += `
                            <tr>
                                <td>${msg.nombre_completo}</td>
                                <td>${msg.correo}</td>
                                <td>${msg.asunto}</td>
                                <td class="td-mensaje">${msg.mensaje}</td>
                                <td>
                                    <button onclick="eliminarMensaje(${msg.id})" class="btn-delete-action">Eliminar</button>
                                </td>
                            </tr>
                        `;
                    });
                })
                .catch(err => {
                    console.error("Error cargando contactos:", err);
                    tableBody.innerHTML = '<tr><td colspan="5" class="text-center error-msg">Error al cargar mensajes.</td></tr>';
                });
        }

        window.eliminarMensaje = function(id) {
            if(confirm('¿Deseas eliminar este mensaje permanentemente?')) {
                fetch(`/api/contactos/${id}`, {
                    method: 'DELETE',
                    headers: { 
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    alert(data.message);
                    cargarContactos();
                })
                .catch(err => console.error("Error al eliminar:", err));
            }
        }

        cargarContactos();
    });
</script>
</body>
</html>