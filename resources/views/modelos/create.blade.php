<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RutaZero | Nuevo Modelo</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="{{ asset('assets/style_dashboard.css') }}">
    
    <style>
        .grid-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .link-back { display: block; margin-top: 20px; color: #ccc; text-decoration: none; text-align: center; }
    </style>
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
            <h1 class="form-title">REGISTRAR MÁQUINA</h1>
            
            <form id="create-moto-form" enctype="multipart/form-data" autocomplete="off">
                <div class="input-group">
                    <label>MARCA</label>
                    <select name="marca" id="select-marcas" required>
                        <option value="" disabled selected>Cargando marcas...</option>
                    </select>
                </div>
                
                <div class="input-group">
                    <label>MODELO (NOMBRE)</label>
                    <input type="text" name="modelo" placeholder="Ej: Ninja ZX-10R" required>
                </div>

                <div class="grid-form">
                    <div class="input-group">
                        <label>CILINDRADA (CC)</label>
                        <input type="number" name="cilindrada" placeholder="1000" required>
                    </div>

                    <div class="input-group">
                        <label>PRECIO ($)</label>
                        <input type="number" name="precio" placeholder="15000" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>IMAGEN DE LA BESTIA</label>
                    <input type="file" name="imagen" accept="image/*" required class="file-input" style="border: 1px dashed #444; padding: 10px;">
                </div>

                <button type="submit" class="btn-save">ARRANCAR REGISTRO</button>
            </form>
            
            <a href="{{ route('admin.modelos.index') }}" class="link-back">← Volver al Panel</a>
        </div>
    </main>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectMarcas = document.getElementById('select-marcas');
        const form = document.getElementById('create-moto-form');

        // 1. Llenar el select con las marcas desde la API de Equipos
        fetch('/api/equipos')
            .then(res => res.json())
            .then(res => {
                const equipos = res.data || res;
                
                selectMarcas.innerHTML = '<option value="" disabled selected>Selecciona la marca...</option>';
                
                if (Array.isArray(equipos)) {
                    equipos.forEach(eq => {
                        const opt = document.createElement('option');
                        opt.value = eq.nombre; // Guardamos el nombre de la marca
                        opt.textContent = eq.nombre;
                        selectMarcas.appendChild(opt);
                    });
                }
            })
            .catch(err => {
                console.error('Error al cargar marcas:', err);
                selectMarcas.innerHTML = '<option value="" disabled>Error al cargar marcas</option>';
            });

        // 2. Guardar la nueva moto vía API
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('/api/motos', {
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
            .then(data => {
                alert('¡Bestia registrada con éxito!');
                window.location.href = "{{ route('admin.modelos.index') }}";
            })
            .catch(err => {
                console.error('Error al guardar:', err);
                alert('Error: ' + (err.message || 'Revisa que la imagen no sea muy pesada y todos los campos estén llenos.'));
            });
        });
    });
</script>
</body>
</html>