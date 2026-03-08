<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestro Equipo - RutaZero</title>
    <link rel="stylesheet" href="{{ asset('assets/style_dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style_pag-princ.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap">
</head>

<body class="body-equipo">

    <header class="header-publico">
        <div class="logo">
            <img src="{{ asset('assets/images/logo-white.jpg') }}" alt="RutaZero Logo">
        </div>
        <nav>
            <a href="{{ route('home') }}">INICIO</a>
            <a href="{{ route('modelos.publico') }}">MODELOS</a> 
            <a href="{{ route('contacto.create') }}">CONTACTO</a>
            <a href="{{ route('equipo.publico') }}" class="active">EQUIPO</a>

            @auth
                <a href="{{ route('logout') }}" class="btn-exit" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">SALIR</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            @endauth
        </nav>
    </header>

    <main class="container equipo-page">
        <h1>Conoce a nuestro Equipo</h1>
        
        <div id="equipo-grid" class="grid-container">
            <p class="loading-text">Cargando equipo...</p>
        </div>
    
        <div class="error-mensaje"></div>
    </main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const contenedor = document.getElementById('equipo-grid');

        fetch('/api/public/equipo')
            .then(res => res.json())
            .then(response => {
                if (!contenedor) return;
                contenedor.innerHTML = "";

                const integrantes = response.data || response;
                
                integrantes.forEach(persona => {
                    let pathBD = persona.imagen_url || '';
                    let fotoUrl = pathBD ? (pathBD.startsWith('/') ? pathBD : '/' + pathBD) : '/assets/images/logo-white.jpg';

                    contenedor.innerHTML += `
                        <div class="integrante-card">
                            <div class="img-wrapper-equipo">
                                <img src="${fotoUrl}" 
                                     alt="${persona.nombre}" 
                                     class="img-equipo-foto"
                                     onerror="this.src='/assets/images/logo-white.jpg';">
                            </div>
                            <h3 class="nombre-integrante">
                                ${persona.nombre}
                            </h3>
                        </div>
                    `;
                });
            })
            .catch(err => console.error("Error cargando equipo:", err));
    });
</script>
</body>
</html>