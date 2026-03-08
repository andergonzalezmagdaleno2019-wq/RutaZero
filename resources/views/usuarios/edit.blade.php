<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario - RutaZero</title>
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
        <div class="crud-container">
            <h2 id="edit-title">Cargando datos del usuario...</h2>
            
            <form id="edit-user-form" autocomplete="off">
                <div class="form-group">
                    <label>Nombre Completo</label>
                    <input type="text" id="name" required>
                </div>

                <div class="form-group">
                    <label>Correo Electrónico</label>
                    <input type="email" id="email" required>
                </div>

                <div class="form-group">
                    <label>Nueva Contraseña (opcional)</label>
                    <input type="password" id="password" placeholder="Mínimo 8 caracteres">
                </div>

                <div class="form-group">
                    <label>Confirmar Contraseña</label>
                    <input type="password" id="password_confirmation" placeholder="Repite la contraseña">
                </div>

                <button type="submit" class="btn-submit">ACTUALIZAR DATOS</button>
                <a href="{{ route('admin.dashboard') }}" class="link-back">Cancelar y volver</a>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Extraer ID de la URL
            const pathArray = window.location.pathname.split('/');
            const userId = pathArray[pathArray.length - 2]; 
            const form = document.getElementById('edit-user-form');

            // 1. Obtener datos actuales del usuario
            fetch(`/api/usuarios/${userId}`)
                .then(res => res.json())
                .then(res => {
                    const user = res.data; 

                    if (user) {
                        document.getElementById('edit-title').innerText = `Editar Usuario: ${user.name}`;
                        document.getElementById('name').value = user.name;
                        document.getElementById('email').value = user.email;
                    }
                })
                .catch(err => {
                    console.error('Error al cargar:', err);
                    alert('No se pudo cargar la información del usuario.');
            });
            // 2. Enviar actualización
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const password = document.getElementById('password').value;
                const confirmation = document.getElementById('password_confirmation').value;

                if (password && password !== confirmation) {
                    alert("Las contraseñas no coinciden.");
                    return;
                }

                const payload = {
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                };

                if (password) {
                    payload.password = password;
                    payload.password_confirmation = confirmation;
                }

                fetch(`/api/usuarios/${userId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                })
                .then(res => res.json())
                .then(() => {
                    alert('Datos actualizados correctamente.');
                    window.location.href = "{{ route('admin.dashboard') }}";
                })
                .catch(err => alert('Error al actualizar. Verifica los datos.'));
            });
        });
    </script>
</body>
</html>