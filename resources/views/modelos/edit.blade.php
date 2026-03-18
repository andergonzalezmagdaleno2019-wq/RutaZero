<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Modelo - RutaZero</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/style_dashboard.css') }}">
</head>
<body>
    <header class="admin-header">
        <div class="logo">
            <img src="{{ asset('assets/images/logo-white.jpg') }}" alt="RutaZero Logo">
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
        <div class="crud-container">
            <h2 id="titulo-modelo">Cargando datos de la moto...</h2>

            <form id="edit-moto-form" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group">
                    <label>Marca:</label>
                    <select name="marca" id="select-marcas" required class="form-control-admin"></select>
                </div>

                <div class="form-group">
                    <label>Modelo:</label>
                    <input type="text" name="modelo" id="modelo_input" required class="form-control-admin">
                </div>

                <div class="form-group">
                    <label>Cilindrada (cc):</label>
                    <input type="number" name="cilindrada" id="cilindrada_input" required class="form-control-admin">
                </div>

                <div class="form-group">
                    <label>Precio ($):</label>
                    <input type="number" step="0.01" name="precio" id="precio_input" required class="form-control-admin">
                </div>

                <div class="form-group">
                    <label>Imagen Actual:</label>
                    <div class="current-img-container">
                        <img id="preview-img" src="" alt="Cargando imagen..." class="img-edit-preview">
                    </div>
                    <label>Subir nueva imagen (opcional):</label>
                    <input type="file" name="imagen" id="imagen_input" accept="image/*" class="input-file-admin">
                </div>

                <div class="actions">
                    <a href="{{ route('admin.modelos.index') }}" class="btn-cancel">Cancelar</a>
                    <button type="submit" class="btn-update">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </main>

    <script>
    const motoId = "{{ $moto->id }}";

    document.addEventListener("DOMContentLoaded", async function() {
        const selectMarcas = document.getElementById('select-marcas');
        const previewImg = document.getElementById('preview-img');

        try {
            const [resEquipos, resMoto] = await Promise.all([
                fetch('/api/equipos'),
                fetch(`/api/motos/${motoId}`)
            ]);

            const jsonEquipos = await resEquipos.json();
            const jsonMoto = await resMoto.json();

            const equipos = jsonEquipos.data || jsonEquipos;
            const moto = jsonMoto.data || jsonMoto;

            if (!moto) throw new Error('No se encontraron los datos de la moto');

            selectMarcas.innerHTML = '<option value="">Seleccione una marca</option>';
            if (Array.isArray(equipos)) {
                equipos.forEach(eq => {
                    const opt = document.createElement('option');
                    opt.value = eq.nombre;
                    opt.textContent = eq.nombre;
                    if (eq.nombre === moto.marca) opt.selected = true;
                    selectMarcas.appendChild(opt);
                });
            }

            document.getElementById('titulo-modelo').innerText = `Editar Moto: ${moto.modelo}`;
            document.getElementById('modelo_input').value = moto.modelo || '';
            document.getElementById('cilindrada_input').value = moto.cilindrada || '';
            document.getElementById('precio_input').value = moto.precio || '';

            if (moto.imagen) {
                previewImg.src = moto.imagen.startsWith('http') ? moto.imagen : '/' + moto.imagen;
            } else {
                previewImg.src = '/assets/images/no-image.jpg';
            }

        } catch (err) {
            console.error("Error al cargar datos:", err);
            const titulo = document.getElementById('titulo-modelo');
            titulo.innerText = "Error: No se pudo cargar la información";
            titulo.classList.add('text-error');
        }

        document.getElementById('edit-moto-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('_method', 'PUT'); 

            fetch(`/api/motos/${motoId}`, {
                method: 'POST', 
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => {
                if (!res.ok) return res.json().then(err => { throw err; });
                return res.json();
            })
            .then(() => {
                alert('¡Máquina actualizada con éxito!');
                window.location.href = "{{ route('admin.modelos.index') }}";
            })
            .catch(err => {
                console.error(err);
                alert('Error al guardar los cambios');
            });
        });
    });
</script>
</body>
</html>