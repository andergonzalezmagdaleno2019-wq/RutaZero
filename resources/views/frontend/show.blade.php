<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $moto->modelo }} - Ficha Técnica | Power Moto</title>
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
            <a href="#" class="{{ request()->routeIs('especificaciones.show') ? 'active' : '' }}">ESPECIFICACIONES</a>
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


    <div class="main-container">
        {{-- Encabezado con estilo power --}}
        <div style="margin-bottom: 40px;">
            <div style="border-left: 5px solid #f1b317; padding-left: 25px;">
                <h1 class="form-title" style="border: none; padding-left: 0; margin-bottom: 5px;">{{ $moto->modelo }}</h1>
                <p style="color: #f1b317; font-size: 1.5rem; font-weight: 600; letter-spacing: 1px;">{{ $moto->marca->nombre ?? 'RutaZero' }}</p>
            </div>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 30px;">
            <div style="flex: 1 1 60%; min-width: 300px;">
                <div class="brand-card" style="padding: 0; overflow: hidden;">
                    <img src="{{ asset($moto->imagen) }}" 
                        style="width: 100%; height: auto; display: block;" 
                        alt="{{ $moto->modelo }}">
                </div>
                
                <div class="current-img-container" style="max-width: 100%; margin-top: 25px; border-style: solid; padding: 25px;">
                    <div>
                        <h5 style="color: #f1b317; text-transform: uppercase; margin-bottom: 15px; font-size: 0.9rem; letter-spacing: 2px;">Descripción del Modelo</h5>
                        <p style="color: #888; line-height: 1.8; font-size: 1.1rem; margin: 0;">
                            {{ $moto->especificacion->descripcion }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Ficha Técnica con estilo tabla power --}}
            <div style="flex: 1 1 35%; min-width: 300px;">
                <div class="crud-container" style="border-top: 4px solid #f1b317;">
                    <h3 style="color: #f1b317; text-transform: uppercase; font-size: 1.3rem; letter-spacing: 2px; margin-bottom: 30px;">
                        Especificaciones <span style="color: #fff;">Técnicas</span>
                    </h3>
                    
                    <table class="user-table" style="border-spacing: 0 5px;">
                        <tbody>
                            <tr>
                                <td style="background: transparent; color: #888; font-weight: 600; width: 40%; border-radius: 8px 0 0 8px;">MOTOR</td>
                                <td style="background: transparent; color: #fff; font-weight: 700; border-radius: 0 8px 8px 0;">{{ $moto->especificacion->motor }}</td>
                            </tr>
                            <tr>
                                <td style="background: transparent; color: #888; font-weight: 600;">CILINDRADA</td>
                                <td style="background: transparent; color: #fff; font-weight: 700;">{{ $moto->especificacion->cilindrada }}</td>
                            </tr>
                            <tr>
                                <td style="background: transparent; color: #888; font-weight: 600;">POTENCIA</td>
                                <td style="background: transparent; color: #f1b317; font-weight: 700;">{{ $moto->especificacion->potencia }}</td>
                            </tr>
                            <tr>
                                <td style="background: transparent; color: #888; font-weight: 600;">TRANSMISIÓN</td>
                                <td style="background: transparent; color: #fff; font-weight: 700;">{{ $moto->especificacion->transmision }}</td>
                            </tr>
                            <tr>
                                <td style="background: transparent; color: #888; font-weight: 600;">FRENOS</td>
                                <td style="background: transparent; color: #fff; font-weight: 700;">{{ $moto->especificacion->frenos }}</td>
                            </tr>
                            <tr>
                                <td style="background: transparent; color: #888; font-weight: 700; font-size: 1.2rem;">PRECIO</td>
                                <td style="background: transparent; color: #f1b317; font-weight: 800; font-size: 1.2rem;">${{ number_format($moto->precio, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div style="margin-top: 35px;">
                        <a href="{{ route('modelos.publico') }}" class="btn-cancel" style="width: 100%; text-align: center; padding: 16px;">
                            Volver al Catálogo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Mantener las filas de la tabla sin fondo para que resalten los datos */
        .user-table tr:hover td {
            background: transparent !important;
        }
        .user-table td {
            border: none;
            padding: 15px 10px;
        }
        .user-table tr td:first-child {
            border-left: none;
        }
        .user-table tr td:last-child {
            border-right: none;
        }
    </style>
</body>
</html>