<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Marca - RutaZero</title>
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
        <div class="form-container">
            <h2 class="form-title" id="edit-title">Cargando Marca...</h2>

            <form id="edit-equipo-form" class="crud-form" enctype="multipart/form-data" autocomplete="off">
                <div class="input-group">
                    <label for="nombre">Nombre de la Marca</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>

                <div class="input-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="3" required></textarea>
                </div>

                <div class="input-group">
                    <label>Imagen Actual</label>
                    <div class="current-image-preview">
                        <img id="preview-img" src="" alt="Vista previa">
                    </div>
                    <label for="imagen">Cambiar Imagen (opcional)</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*">
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn-save">Actualizar Cambios</button>
                    <a href="{{ route('admin.equipo.index') }}" class="btn-cancel">Cancelar</a>
                </div>
            </form>
        </div>
    </main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    // 1. Extraer el ID de la URL
    const urlSegments = window.location.pathname.split('/');
    const equipoId = urlSegments[urlSegments.indexOf('edit') - 1];
    
    const form = document.getElementById('edit-equipo-form');
    console.log("Trabajando con el ID:", equipoId);

    // CARGAR LOS DATOS AL ENTRAR 
    fetch(`/api/equipos/${equipoId}`)
        .then(res => {
            if (!res.ok) throw new Error("Error al obtener datos");
            return res.json();
        })
        .then(res => {
            const equipo = res.data; 
            
            if (equipo) {
                // Rellenar el título si existe el ID
                const titleElem = document.getElementById('edit-title');
                if (titleElem) {
                    titleElem.innerText = `Editar Marca: ${equipo.nombre}`;
                }
                
                // Rellenar los campos de texto
                document.getElementById('nombre').value = equipo.nombre;
                document.getElementById('descripcion').value = equipo.descripcion;
                
                // Mostrar la imagen actual en la vista previa
                const previewImg = document.getElementById('preview-img');
                if (previewImg && equipo.imagen_full_url) {
                    previewImg.src = equipo.imagen_full_url;
                }
            }
        })
        .catch(err => {
            console.error("Error al cargar datos:", err);
            alert("No se pudo cargar la información de la marca.");
        });

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData();
            formData.append('nombre', document.getElementById('nombre').value);
            formData.append('descripcion', document.getElementById('descripcion').value);
            
            // Si el usuario seleccionó una nueva imagen
            const imageInput = document.getElementById('imagen');
            if (imageInput && imageInput.files[0]) {
                formData.append('imagen', imageInput.files[0]);
            }

            formData.append('_method', 'PUT');

            fetch(`/api/equipos/${equipoId}`, {
                method: 'POST', // Físicamente es un POST
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'

                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('¡Marca actualizada correctamente!');
                    window.location.href = "/admin/equipo"; // Regresamos a la lista
                } else {
                    console.error("Error de validación:", data.errors);
                    alert('Error: ' + (data.message || 'Verifica los datos enviados.'));
                }
            })
            .catch(err => {
                console.error("Error en la petición:", err);
                alert('Ocurrió un error al conectar con el servidor.');
            });
        });
    }
});
</script>
</body>
</html>