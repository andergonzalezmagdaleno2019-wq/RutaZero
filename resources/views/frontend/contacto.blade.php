<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - RutaZero</title>
    <link rel="stylesheet" href="{{ asset('assets/style_dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style_pag-princ.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header class="header-publico">
        <div class="logo">
            <img src="{{ asset('assets/images/logo-white.jpg') }}" alt="RutaZero Logo">
        </div>
        <nav>
            <a href="{{ route('home') }}">INICIO</a>
            <a href="{{ route('modelos.publico') }}">MODELOS</a> 
            <a href="{{ route('contacto.create') }}" class="active">CONTACTO</a>
            <a href="{{ route('equipo.publico') }}">EQUIPO</a>

            @auth
                <a href="{{ route('logout') }}" class="btn-exit" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">SALIR</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            @else
                <a href="{{ route('login') }}" class="btn-login">LOGIN</a>
            @endauth
        </nav>
    </header>

    <main class="contacto-section">
        <div class="form-container">
            <h1>CONTÁCTANOS</h1>
            <p>Escríbenos y nos pondremos en contacto contigo a la brevedad.</p>

            <div id="response-message" style="display:none; padding: 15px; border-radius: 5px; margin-bottom: 20px; font-weight: bold;"></div>

            <form id="public-contact-form" autocomplete="off">
                @csrf
                <div class="input-box">
                    <input type="text" id="nombre_completo" name="nombre_completo" placeholder="Nombre Completo" required>
                </div>
                <div class="input-box">
                    <input type="email" id="correo" name="correo" placeholder="Correo Electrónico" required>
                </div>
                <div class="input-box">
                    <input type="text" id="asunto" name="asunto" placeholder="Asunto del mensaje" required>
                </div>
                <div class="input-box">
                    <textarea id="mensaje" name="mensaje" placeholder="Tu Mensaje" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn-submit" id="btn-enviar">ENVIAR MENSAJE</button>
            </form>
        </div>
    </main>

    <script>
        document.getElementById('public-contact-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const btn = document.getElementById('btn-enviar');
            const respDiv = document.getElementById('response-message');
            
            btn.innerText = "ENVIANDO...";
            btn.disabled = true;
            respDiv.style.display = "none";

            // Estructura del JSON 
            const datos = {
                nombre_completo: document.getElementById('nombre_completo').value,
                correo: document.getElementById('correo').value,
                asunto: document.getElementById('asunto').value, 
                mensaje: document.getElementById('mensaje').value
            };

            fetch('/api/public/contacto', { 
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(datos)
            })
            .then(async response => {
                const data = await response.json();
                if (!response.ok) throw data;
                return data;
            })
            .then(data => {
                respDiv.style.display = "block";
                respDiv.style.background = "#f1b317";
                respDiv.style.color = "#000";
                respDiv.innerText = "¡Mensaje enviado con éxito! Nos contactaremos pronto.";
                
                document.getElementById('public-contact-form').reset();
            })
            .catch(error => {
                respDiv.style.display = "block";
                respDiv.style.background = "#ff4d4d";
                respDiv.style.color = "#fff";
                
                // Manejo de errores de validación de Laravel
                if (error.errors) {
                    respDiv.innerText = "Error: " + Object.values(error.errors).flat().join(', ');
                } else {
                    respDiv.innerText = error.message || "Error al enviar. Inténtalo de nuevo.";
                }
                console.error('Error:', error);
            })
            .finally(() => {
                btn.innerText = "ENVIAR MENSAJE";
                btn.disabled = false;
            });
        });
    </script>
</body>
</html>