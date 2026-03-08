<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RutaZero - Pasión por las Motos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/style_dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style_pag-princ.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap">
</head>
<body>
    <header class="header-publico">
        <div class="logo">
            <img src="{{ asset('assets/images/logo-white.jpg') }}" alt="RutaZero Logo">
        </div>
        <nav>
            <a href="{{ route('home') }}">INICIO</a>
            <a href="{{ route('modelos.publico') }}">MODELOS</a>
            <a href="{{ route('contacto.create') }}">CONTACTO</a>
            <a href="{{ route('equipo.publico') }}">EQUIPO</a>
            <div class="user-nav-box">
    <span class="welcome-text">HOLA, {{ Auth::user()->name }}</span>
    <a href="{{ route('perfil.editar') }}" class="user-icon-circle">
        <i class="fa-solid fa-user"></i>
    </a>
</div>
            
            @auth
                <a href="{{ route('logout') }}" 
                   class="btn-exit"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   SALIR
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            @else
                <a href="{{ route('login') }}" class="btn-login">LOGIN</a>
            @endauth
        </nav>
    </header>

    <section id="hero">
        <div class="hero-content">
            <h1>Descubre la adrenalina <br> sobre dos ruedas</h1>
            <button onclick="document.getElementById('somos-rutazero').scrollIntoView({behavior: 'smooth'})">EMPEZAR</button>
        </div>
    </section>

    <section id="somos-rutazero">
        <div class="container">
            <div class="img-container">
                <img src="{{ asset('assets/images/about-bike.jpg') }}" alt="">
            </div>
            <div class="texto">
                <h2>Somos <span class="color-nom">RutaZero</span></h2>
                <p>
                    En RutaZero, somos un apasionado equipo de estudiantes dedicados a crear un espacio único para los amantes de las motos deportivas. Nuestra plataforma exhibe la potencia de tres marcas icónicas: <strong>Honda, Kawasaki y Suzuki</strong>.
                </p>
                <p>
                    Ofrecemos una experiencia visual y educativa para que explores la historia y especificaciones de cada bestia.
                </p>
            </div>
        </div>
    </section>

    <section id="modelos">
        <div class="container">
            <h2 class="section-title">Nuestras Marcas</h2>
            <div class="models-grid">
                @foreach($equipos as $integrante)
                    <div class="carta" style="background-image: url('{{ asset($integrante->imagen_url) }}');">
                        <div class="card-overlay">
                            <h3>{{ strtoupper($integrante->nombre) }}</h3>
                            <button type="button" onclick="irAMarca('{{ strtolower($integrante->nombre) }}')">
                                Ver catálogo
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2026 RutaZero Team - Todos los derechos reservados.</p>
    </footer>

    <script>
        function irAMarca(nombre) {
            // Esto construye la URL: /modelos?marca=honda
            const urlBase = "{{ route('modelos.publico') }}";
            window.location.href = urlBase + "?marca=" + nombre;
        }
    </script>
</body>
</html>