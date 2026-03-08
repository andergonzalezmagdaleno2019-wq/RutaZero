<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Marca - RutaZero</title>
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
        <div class="form-container">
            <h2 class="form-title">Nueva Marca de Equipo</h2>

            <form id="create-equipo-form" autocomplete="off">
                <div class="input-group">
                    <label for="nombre">Nombre de la Marca</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Ej: Honda" required>
                </div>

                <div class="input-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="4" placeholder="Breve reseña..." required></textarea>
                </div>

                <div class="input-group">
                    <label for="imagen_url">Imagen / Logo de la Marca</label>
                    <input type="file" name="imagen" id="imagen" accept="image/*" required style="border: 1px dashed #444; padding: 15px; cursor: pointer;">
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn-save" id="btn-save">Guardar Marca</button>
                    <a href="{{ route('admin.equipo.index') }}" class="btn-cancel">Cancelar</a>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.getElementById('create-equipo-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const btn = document.getElementById('btn-save');
            btn.innerText = "Guardando...";
            btn.disabled = true;

            const formData = new FormData(this);

            fetch('/api/equipos', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(async response => {
                const result = await response.json();
                if (!response.ok) {
                    // Si Laravel devuelve errores de validación, los mostramos
                    throw new Error(result.message || 'Error en los datos');
                }
                return result;
            })
            .then(result => {
                alert('¡Marca guardada con éxito!');
                window.location.href = "{{ route('admin.equipo.index') }}";
            })
            .catch(err => {
                console.error("Detalle del error:", err);
                alert('Error: ' + err.message);
                btn.innerText = "Guardar Marca";
                btn.disabled = false;
            });
        });
    </script>
</body>
</html>