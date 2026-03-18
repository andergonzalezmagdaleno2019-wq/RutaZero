<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestros Modelos - RutaZero</title>
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
            <a href="{{ route('modelos.publico') }}" class="active">MODELOS</a>
            <a href="{{ route('especificaciones.info') }}" class="{{ request()->is('especificaciones') ? 'active' : '' }}">ESPECIFICACIONES</a>
            <a href="{{ route('contacto.create') }}">CONTACTO</a>
            <a href="{{ route('equipo.publico') }}">EQUIPO</a>

            @auth
                <a href="{{ route('logout') }}" 
                   class="btn-exit-header"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   SALIR
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            @endauth
        </nav>
    </header>

    <main class="carousel">
        <div class="list" id="moto-list">
            <p class="loading-catalog">Cargando catálogo de potencia...</p>
        </div>

        <div class="arrows">
            <button id="prev"><</button>
            <button id="next">></button>
        </div>
    </main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const listItem = document.getElementById('moto-list');
        const carousel = document.querySelector('.carousel');

        const urlParams = new URLSearchParams(window.location.search);
        const marcaFiltrada = urlParams.get('marca'); 

        let apiURL = '/api/public/modelos';
        if (marcaFiltrada) {
            apiURL += '?marca=' + encodeURIComponent(marcaFiltrada);
        }

        fetch(apiURL)
            .then(res => res.json())
            .then(response => {
                listItem.innerHTML = ""; 

                const motos = response.data;

                if(!motos || motos.length === 0) {
                    listItem.innerHTML = `<p class="no-models-msg">No hay modelos disponibles ${marcaFiltrada ? 'para ' + marcaFiltrada : ''} actualmente.</p>`;
                    return;
                }

                motos.forEach(moto => {
                    const precioNumerico = parseFloat(moto.precio) || 0;
                    const precioFormateado = precioNumerico.toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

                    const itemHtml = `
                        <div class="item">
                            <img src="${moto.imagen_url ? moto.imagen_url : '/' + moto.imagen}" alt="${moto.modelo}">
                            <div class="content">
                                <div class="brand">${moto.marca}</div>
                                <div class="model">${moto.modelo}</div>
                                <div class="details">
                                    <p>Cilindrada: ${moto.cilindrada}cc</p>
                                    <p>Precio: $${precioFormateado}</p>
                                </div>
                                <div class="buttons">
                                <button class="btn-interest" 
                                        onclick="window.location.href='/modelos/detalle/${moto.id}'">
                                    VER FICHA TÉCNICA
                                </button>
                                </div>
                            </div>
                        </div>
                    `;
                    listItem.innerHTML += itemHtml;
                });

                initCarousel();
            })
            .catch(err => {
                console.error("Error cargando motos:", err);
                listItem.innerHTML = "<p class='error-msg-catalog'>Error al conectar con la base de datos.</p>";
            });

        function initCarousel() {
            let nextBtn = document.querySelector('#next');
            let prevBtn = document.querySelector('#prev');

            nextBtn.onclick = () => showSlider('next');
            prevBtn.onclick = () => showSlider('prev');

            function showSlider(type) {
                let items = document.querySelectorAll('.carousel .list .item');
                if(items.length < 2) return; 

                if(type === 'next') {
                    listItem.appendChild(items[0]);
                    carousel.classList.add('next');
                } else {
                    listItem.prepend(items[items.length - 1]);
                    carousel.classList.add('prev');
                }

                setTimeout(() => {
                    carousel.classList.remove('next');
                    carousel.classList.remove('prev');
                }, 500);
            }
        }
    });
</script>
</body>
</html>