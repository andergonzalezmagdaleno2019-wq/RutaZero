<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especificaciones - RutaZero</title>
    <link rel="stylesheet" href="{{ asset('assets/style_pag-princ.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap">
</head>
<body style="background: #000; color: #fff; font-family: 'Poppins', sans-serif; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0;">

    <div style="text-align: center; padding: 40px; border: 2px solid #f1b317; border-radius: 20px; background: rgba(241, 179, 23, 0.05); max-width: 500px; margin: 20px;">
        <div style="font-size: 4rem; margin-bottom: 20px;">🏍️</div>
        
        <h1 style="color: #f1b317; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px;">¡Selecciona tu máquina!</h1>
        
        <p style="color: #ccc; line-height: 1.6; margin-bottom: 30px;">
            Para ver una <strong>Ficha Técnica</strong> detallada, primero debes elegir uno de nuestros modelos disponibles en el catálogo.
        </p>

        <a href="{{ route('modelos.publico') }}" 
           style="display: inline-block; padding: 15px 30px; background: #f1b317; color: #000; text-decoration: none; font-weight: 800; border-radius: 50px; text-transform: uppercase; transition: 0.3s; box-shadow: 0 0 20px rgba(241, 179, 23, 0.4);">
            Ir al Catálogo de Motos
        </a>

        <br><br>
        <a href="{{ route('home') }}" style="color: #666; text-decoration: none; font-size: 0.9rem;">Volver al inicio</a>
    </div>

</body>
</html>