<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - RutaZero</title>
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
                <h1>ACCESO <span>RUTAZERO</span></h1>
            </div>

            <div class="form_container">
                <form id="login-form" autocomplete="off">
                    <div id="login-error" class="alert alert-danger d-none"></div>

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Correo" required>
                    </div>

                    <div class="input-group mb-4">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" id="password" autocomplete="new-password" name="password" class="form-control" placeholder="Contraseña" required>
                    </div>
                    
                    <div class="welcome_actions">
                        <button type="submit" id="btn-login" class="btn-welcome btn-gold-fill">
                            ENTRAR
                        </button>
                    </div>
                </form>
            </div>
    
            <div class="mt-4">
                <div class="d-flex justify-content-center links">
                    ¿No tienes cuenta? <a href="{{ route('register') }}" class="ml-2">Regístrate</a>
                </div>
            </div>

            <div class="footer_text_welcome">
                © 2026 RutaZero Team
            </div>
        </div>
    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const btn = document.querySelector('button[type="submit"]');
            const errorDiv = document.getElementById('login-error');
            
            btn.innerText = "ENTRANDO...";
            btn.disabled = true;
            if(errorDiv) errorDiv.classList.add('d-none');

            const formData = new FormData(this);

            fetch("{{ route('login.manual') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(async response => {
                const contentType = response.headers.get("content-type");
                
                if (contentType && contentType.indexOf("application/json") !== -1) {
                    const data = await response.json();
                    if (!response.ok) throw data;
                    return data;
                } else {
                    const textError = await response.text();
                    console.error("Respuesta no JSON recibida:", textError);
                    throw { message: "Error crítico del servidor (500)." };
                }
            })
            .then(data => {
                const user = data.user;
                if (user && user.is_admin == 1) {
                    window.location.href = "{{ route('admin.dashboard') }}";
                } else {
                    window.location.href = "/home"; 
                }
            })
            .catch(error => {
                btn.innerText = "ENTRAR";
                btn.disabled = false;
                
                if(errorDiv) {
                    errorDiv.innerText = error.message || "Credenciales incorrectas";
                    errorDiv.classList.remove('d-none');
                }
            });
        });
    </script>
</body>
</html>