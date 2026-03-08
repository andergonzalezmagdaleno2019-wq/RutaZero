<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Contacto - RutaZero</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/style_dashboard.css') }}">
</head>
<body>
    @include('partials.header') 

    <main class="main-container">
        <div class="crud-container">
            <h2 id="titulo-edit">Cargando datos...</h2>
            
            <form id="edit-contacto-form">
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
                <button type="submit" class="btn-save">Actualizar</button>
                <a href="{{ route('admin.contactos.index') }}" class="btn-cancel">Cancelar</a>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const pathArray = window.location.pathname.split('/');
            const contactoId = pathArray[pathArray.length - 2]; 
            const form = document.getElementById('edit-contacto-form');

            fetch(`/api/contactos/${contactoId}`)
                .then(response => response.json())
                .then(contacto => {
                    document.getElementById('titulo-edit').innerText = `Editar Contacto: ${contacto.nombre_completo}`;
                    document.getElementById('nombre_completo').value = contacto.nombre_completo;
                    document.getElementById('correo').value = contacto.correo;
                    document.getElementById('asunto').value = contacto.asunto || '';
                    document.getElementById('mensaje').value = contacto.mensaje;
                });

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const datos = {
                    nombre_completo: document.getElementById('nombre_completo').value,
                    correo: document.getElementById('correo').value,
                    asunto: document.getElementById('asunto').value,
                    mensaje: document.getElementById('mensaje').value
                };

                fetch(`/api/contactos/${contactoId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(datos)
                })
                .then(response => response.json())
                .then(result => {
                    alert('Contacto actualizado correctamente');
                    window.location.href = "{{ route('admin.contactos.index') }}";
                })
                .catch(err => alert('Error al actualizar'));
            });
        });
    </script>
</body>
</html>