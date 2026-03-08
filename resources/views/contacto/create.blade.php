<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Contacto - RutaZero</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/style_dashboard.css') }}">
</head>
<body>
    @include('partials.header') 

    <main class="main-container">
        <div class="crud-container">
            <h2>Crear Nuevo Contacto</h2>
            <form id="create-contacto-form">
                <div class="form-group">
                    <label>Nombre Completo</label>
                    <input type="text" id="nombre_completo" required>
                </div>
                <div class="form-group">
                    <label>Correo Electrónico</label>
                    <input type="email" id="correo" required>
                </div>
                <div class="form-group">
                    <label>Asunto</label>
                    <input type="text" id="asunto">
                </div>
                <div class="form-group">
                    <label>Mensaje</label>
                    <textarea id="mensaje" required></textarea>
                </div>
                <button type="submit" class="btn-save">Guardar</button>
                <a href="{{ route('admin.contactos.index') }}" class="btn-cancel">Cancelar</a>
            </form>
        </div>
    </main>

    <script>
        document.getElementById('create-contacto-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const datos = {
                nombre_completo: document.getElementById('nombre_completo').value,
                correo: document.getElementById('correo').value,
                asunto: document.getElementById('asunto').value,
                mensaje: document.getElementById('mensaje').value
            };

            fetch('/api/contactos', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(datos)
            })
            .then(response => {
                if (!response.ok) throw new Error('Error en la validación');
                return response.json();
            })
            .then(result => {
                alert('Contacto creado con éxito');
                window.location.href = "{{ route('admin.contactos.index') }}";
            })
            .catch(err => {
                console.error(err);
                alert('Hubo un error al guardar el contacto. Revisa los datos.');
            });
        });
    </script>
</body>
</html>