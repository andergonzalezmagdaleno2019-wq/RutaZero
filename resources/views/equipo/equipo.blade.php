<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipo - RutaZero</title>
    
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
                <a href="/admin/contacto">Mensajes</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Salir') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </nav>
    </header>

    <main class="main-container">
        <div class="section-header">
            <h1>Marcas de Equipo</h1>
            <a href="{{ route('admin.equipo.create') }}" class="btn-add-brand">+ Agregar Nueva Marca</a>
        </div>

        @if(session('success'))
            <div class="alert-success-container">{{ session('success') }}</div>
        @endif

        <section class="brand-grid" id="brand-grid-container">
            <p style="color: white;">Cargando marcas...</p>
        </section>
    </main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const gridContainer = document.getElementById('brand-grid-container');

        // Función para cargar los equipos desde la API 
function cargarEquipos() {
    fetch('/api/equipos')
        .then(response => response.json())
        .then(res => { 
            gridContainer.innerHTML = ''; 

            const equipos = res.data || [];

            if (equipos.length === 0) {
                gridContainer.innerHTML = '<p style="color: white; grid-column: 1/-1; text-align: center;">No hay registros de marcas.</p>';
                return;
            }

            equipos.forEach(item => {
                const card = document.createElement('div');
                card.className = 'brand-card';
                
                const rutaImagen = item.imagen_full_url 
                    ? item.imagen_full_url 
                    : '/assets/images/default-brand.jpg';

                card.innerHTML = `
                    <div class="brand-img-container">
                        <img src="${rutaImagen}" alt="${item.nombre}" class="brand-img" onerror="this.src='/assets/images/default-brand.jpg'">
                    </div>
                    <h3>${item.nombre}</h3>
                    <p>${item.descripcion || 'Sin descripción'}</p>
                    <div class="card-admin-actions">
                        <a href="/admin/equipo/${item.id}/edit" class="btn-edit-link">EDITAR</a>
                        <button onclick="eliminarEquipo(${item.id})" class="btn-delete-action" style="cursor:pointer; border:none;">ELIMINAR</button>
                    </div>
                `;
                gridContainer.appendChild(card);
            });
        })
        .catch(err => {
            console.error('Error:', err);
            gridContainer.innerHTML = '<p style="color: #ff4d4d; grid-column: 1/-1; text-align: center;">Error al conectar con la API.</p>';
        });
}

        window.eliminarEquipo = function(id) {
            if (confirm('¿Estás seguro de eliminar esta marca?')) {
                fetch(`/api/equipos/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(() => cargarEquipos())
                .catch(err => alert('No se pudo eliminar la marca.'));
            }
        }

        cargarEquipos();
    });
</script>
</body>
</html>