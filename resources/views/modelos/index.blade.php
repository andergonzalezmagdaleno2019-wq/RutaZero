<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelos - RutaZero</title>
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
            <h1>Gestión de Modelos (Motos)</h1>
            <a href="{{ route('admin.modelos.create') }}" class="btn-add-brand">+ AÑADIR NUEVA MOTO</a>
        </div>

        <table class="user-table">
            <thead>
                <tr>
                    <th>IMAGEN</th>
                    <th>MARCA</th>
                    <th>MODELO</th>
                    <th>CILINDRADA</th>
                    <th>PRECIO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody id="modelos-table-body">
                <tr><td colspan="6" style="text-align:center; color:white;">Cargando...</td></tr>
            </tbody>
        </table>
    </main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        cargarModelos(); 

        function cargarModelos() {
            const tableBody = document.getElementById('modelos-table-body');
            
            fetch('/api/motos') 
                .then(response => {
                    if (!response.ok) throw new Error('Error en la API: ' + response.status);
                    return response.json();
                })
                .then(res => {
                    console.log("Datos recibidos de la API:", res);
                    tableBody.innerHTML = ''; 

                    const motos = res.data || res; 

                    if (!Array.isArray(motos) || motos.length === 0) {
                        tableBody.innerHTML = '<tr><td colspan="6" style="text-align:center; color:white;">No hay motos registradas.</td></tr>';
                        return;
                    }

                    motos.forEach(moto => {
                        const imgPath = moto.imagen_url ? moto.imagen_url : '/assets/images/no-image.jpg';
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>
                                <img src="${imgPath}" style="width: 70px; border-radius: 4px;" onerror="this.src='/assets/images/no-image.jpg'">
                            </td>
                            <td style="color: #f1c40f; font-weight: bold;">${moto.marca || 'N/A'}</td>
                            <td>${moto.modelo || '---'}</td>
                            <td>${moto.cilindrada || '0'} cc</td>
                            <td>$${parseFloat(moto.precio || 0).toLocaleString()}</td>
                            <td>
                                <div class="card-admin-actions">
                                    <a href="/admin/modelos/${moto.id}/edit" class="btn-edit-link">Editar</a>
                                    <button onclick="eliminarMoto(${moto.id})" class="btn-delete-action" style="cursor:pointer; border:none; background:none; color:#e74c3c;">Eliminar</button>
                                </div>
                            </td>
                        `;
                        tableBody.appendChild(tr);
                    });
                })
                .catch(err => {
                    console.error('Error en el script:', err);
                    tableBody.innerHTML = '<tr><td colspan="6" style="text-align:center; color:red;">Error al cargar datos. Revisa la consola.</td></tr>';
                });
        }

        window.eliminarMoto = function(id) {
            if (confirm('¿Eliminar esta moto?')) {
                fetch(`/api/motos/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    alert(data.message || 'Eliminado');
                    cargarModelos();
                })
                .catch(err => alert('Error al eliminar'));
            }
        }
    });
</script>
</body>
</html>