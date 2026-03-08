<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - RutaZero</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body class="welcome-page">

    <div class="welcome-overlay">
        <div class="user_card_welcome">
            <div class="brand_logo_container">
                <img src="{{ asset('assets/images/redondoblanco.jpg') }}" class="brand_logo" alt="Logo">
            </div>

            <div class="welcome_info">
                <h1>RUTA<span>ZERO</span></h1>
                <p>Tu máquina, tus reglas</p>
                
                <div class="welcome_actions">
                    <a href="{{ route('login') }}" class="btn-welcome btn-gold-fill">
                        <i class="fas fa-lock"></i> INICIO DE SESIÓN
                    </a>
                    
                    <a href="{{ route('register') }}" class="btn-welcome btn-gold-outline">
                        <i class="fas fa-user-plus"></i> REGISTRO
                    </a>
                </div>
            </div>

            <div class="footer_text_welcome">
                © 2026 RutaZero Team
            </div>
        </div>
    </div>

</body>
</html>