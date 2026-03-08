<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - RutaZero</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>
<body class="welcome-page">

    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="user_card_welcome">
            
            <div class="brand_logo_container">
                <img src="{{ asset('assets/images/redondoblanco.jpg') }}" class="brand_logo" alt="Logo">
            </div>

            <div class="welcome_info mb-4">
                <h1>NUEVA <span>CUENTA</span></h1>
                <p>Únete a la ruta</p>
            </div>

            <div class="form_container text-left">
                <form id="register-form" autocomplete="off">
                    @csrf
                    <div id="register-error" class="alert alert-danger d-none"></div>

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nombre completo" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Correo electrónico" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="password" id="password" autocomplete="new-password" class="form-control" placeholder="Contraseña" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-check-double"></i></span>
                        </div>
                        <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" class="form-control" placeholder="Confirmar contraseña" required>
                    </div>

                    <div class="text-center mb-3">
                        <a href="{{ route('terms.index') }}" class="terms-link">Acepto términos y condiciones</a>
                    </div>

                    <div class="welcome_actions">
                        <button type="submit" id="btn-register" class="btn-welcome btn-gold-fill">
                            REGISTRARSE
                        </button>
                    </div>
                </form>
            </div>
    
            <div class="mt-4">
                <div class="d-flex justify-content-center links">
                    ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="ml-2 login-link">Inicia sesión</a>
                </div>
            </div>

            <div class="footer_text_welcome">
                © 2026 RutaZero Team
            </div>
        </div>
    </div>

<script>
    document.getElementById('register-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.getElementById('btn-register');
        const errorDiv = document.getElementById('register-error');
        
        btn.innerText = "CREANDO CUENTA...";
        btn.disabled = true;
        errorDiv.classList.add('d-none');

        const formData = new FormData(this);

        fetch("{{ route('register') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(async response => {
            const resData = await response.json();
            if (!response.ok) throw resData;
            return resData;
        })
        .then(data => {
            alert('¡Registro exitoso! Bienvenido a RutaZero.');
            window.location.href = "{{ route('login') }}";
        })
        .catch(error => {
            btn.innerText = "REGISTRARSE";
            btn.disabled = false;
            let mensaje = "Error al procesar el registro.";
            if (error.errors) {
                mensaje = Object.values(error.errors).flat()[0];
            } else if (error.message) {
                mensaje = error.message;
            }
            errorDiv.innerText = mensaje;
            errorDiv.classList.remove('d-none');
            errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    });
</script>
</body>
</html>