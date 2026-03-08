<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Términos y Condiciones - RutaZero</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body class="welcome-page">

    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="user_card_welcome card_terms">
            
            <div class="brand_logo_container">
                <img src="{{ asset('assets/images/redondoblanco.jpg') }}" class="brand_logo" alt="Logo">
            </div>

            <div class="welcome_info mb-4">
                <h1>TÉRMINOS <span>LEGALES</span></h1>
            </div>

            <div class="terms-content">
                <h4 class="gold-text">1. Acuerdo de Uso:</h4>
                <p>Al acceder a este sitio web, aceptas estos términos. RutaZero es un proyecto demostrativo sin operación comercial real.</p>

                <h4 class="gold-text">2. Propiedad Intelectual:</h4>
                <p>Todas las imágenes de motos y logotipos de marcas son propiedad de sus respectivos dueños. Se utilizan solo con fines educativos.</p>

                <h4 class="gold-text">3. Exactitud de la Información:</h4>
                <p>La información técnica se proporciona "tal cual" y puede contener errores, ya que el sitio es una simulación de portafolio.</p>

                <h4 class="gold-text">4. Limitación de Responsabilidad:</h4>
                <p>RutaZero no se hace responsable por el uso de la información aquí mostrada. Este es un entorno de desarrollo controlado.</p>

                <h4 class="gold-text">5. Contacto:</h4>
                <p>Preguntas sobre el proyecto: <a href="mailto:RutaZero@gmail.com" class="gold-link">RutaZero@gmail.com</a></p>
            </div>

            <div class="welcome_actions mt-4">
                <a href="{{ url('/') }}" class="btn-welcome btn-gold-fill">
                    <i class="fas fa-arrow-left"></i> VOLVER AL INICIO
                </a>
            </div>

            <div class="footer_text_welcome">
                © 2026 RutaZero Team
            </div>
        </div>
    </div>

</body>
</html>