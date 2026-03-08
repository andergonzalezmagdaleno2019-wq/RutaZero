<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - RutaZero</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/style_dashboard.css') }}">
</head>
<body>
    {{-- @include('partials.header') --}}

    <main class="main-container">
        <div class="crud-container">
            <h2>Mi Perfil</h2>
            <p class="section-subtitle">Actualiza tu información personal</p>

            <form id="edit-profile-form" autocomplete="off">
                <div class="form-group">
                    <label for="nombre_completo">Nombre Completo</label>
                    <input type="text" id="nombre_completo" name="nombre_completo" required class="form-control-admin">
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required class="form-control-admin">
                </div>

                <hr class="separator">
                <p class="info-text">Deja la contraseña en blanco si no deseas cambiarla</p>

                <div class="form-group">
                    <label for="password">Nueva Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control-admin">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control-admin">
                </div>

                <div class="actions">
                    <button type="submit" class="btn-save">Actualizar Datos</button>
                    <a href="/home" class="btn-cancel">Volver</a>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
    // 1. CARGAR DATOS ACTUALES
    fetch('/api/user/me', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'include' 
    })
    .then(res => {
        if (!res.ok) throw new Error('No autenticado');
        return res.json();
    })
    .then(user => {
        document.getElementById('nombre_completo').value = user.name || '';
        document.getElementById('email').value = user.email || '';
        console.log("Datos cargados:", user);
    })
    .catch(err => {
        console.error("Error al cargar datos:", err);
        alert('No se pudieron cargar los datos. Asegúrate de estar logueado.');
    });

    // 2. ENVIAR ACTUALIZACIÓN
    const form = document.getElementById('edit-profile-form'); 
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());

            fetch('/api/user/me/update', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data),
                credentials: 'include'
            })
            .then(res => res.json())
            .then(result => {
                if(result.status === 'success') {
                    alert('¡Datos actualizados con éxito!');
                } else {
                    alert('Error: ' + (result.message || 'No se pudo actualizar'));
                }
            })
            .catch(err => alert('Error en la conexión al guardar'));
        });
    }
});
    </script>
</body>
</html>