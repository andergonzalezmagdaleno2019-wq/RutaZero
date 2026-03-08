<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario - RutaZero</title>
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
    <main class="form-wrapper">
        <div class="form-container">
            <h2>Nuevo Usuario</h2>
            <p class="subtitle">Completa los datos para el registro.</p>

            <form id="create-user-form" autocomplete="off">
                <div class="form-group">
                    <label>Nombre Completo</label>
                    <input type="text" id="name" required placeholder="Ej. Juan Pérez">
                </div>
                <div class="form-group">
                    <label>Correo Electrónico</label>
                    <input type="email" id="email" required placeholder="correo@ejemplo.com">
                </div>
                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" id="password" required placeholder="********">
                </div>
                <div class="form-group">
                    <label>Confirmar Contraseña</label>
                    <input type="password" id="password_confirmation" required placeholder="********">
                </div>

                <button type="submit" class="btn-submit">Guardar Usuario</button>
                <a href="{{ route('admin.dashboard') }}" class="link-back">← VOLVER</a>
            </form>
        </div>
    </main>

   <script>
    document.getElementById('create-user-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const password_confirmation = document.getElementById('password_confirmation').value;

        // 1. Validación frontal rápida
        if (password !== password_confirmation) {
            alert("Las contraseñas no coinciden en el formulario.");
            return;
        }

        // 2. Usamos /api/registro que es el endpoint correcto para crear usuarios
        fetch('/api/registro', { 
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                name: name,
                email: email,
                password: password,
                password_confirmation: password_confirmation // Enviamos la confirmación real
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                alert('¡Usuario creado correctamente!');
                window.location.href = "/admin/usuarios"; // Te manda a la lista
            } else {
                alert("Error: " + (data.message || JSON.stringify(data.errors)));
            }
        })
        .catch(err => {
            console.error(err);
            alert('Error al conectar con el servidor.');
        });
    });
</script>
</body>
</html>