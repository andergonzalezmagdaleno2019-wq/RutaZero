/**
 * Proyecto: Gestión API JSON - RutaZero
 * Módulos: Usuarios, Equipos, Motos, Contacto [cite: 2026-01-11]
 */

const API_BASE = '/api';
const app = document.getElementById('app-container');

document.addEventListener('DOMContentLoaded', () => {
    console.log("Sistema RutaZero Iniciado");
    router();
});

// --- ENRUTADOR (SPA) ---
function navegar(url) {
    window.history.pushState({}, '', url);
    router();
}

function router() {
    const path = window.location.pathname;
    
    if (path === '/' || path === '/login') {
        renderLogin();
    } else if (path === '/registro') {
        renderRegistro();
    } else if (path.startsWith('/admin')) {
        verificarSesion();
        if (path === '/admin/dashboard' || path === '/admin/usuarios') renderUsuarios();
        if (path === '/admin/equipos') renderEquipo();
        if (path === '/admin/motos') renderMotos();
    }
}

// --- MÓDULO 1: USUARIOS (AUTH) [cite: 2026-01-09] ---
function renderLogin() {
    app.innerHTML = `
        <div class="row justify-content-center">
            <div class="col-md-4 card p-4 shadow-sm">
                <h3 class="text-center">Iniciar Sesión</h3>
                <form id="form-login">
                    <div class="mb-3"><label>Correo</label><input type="email" name="email" class="form-control" required></div>
                    <div class="mb-3"><label>Clave</label><input type="password" name="password" class="form-control" required></div>
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>
                <p class="mt-3 text-center small">¿No tienes cuenta? <a href="javascript:navegar('/registro')">Regístrate</a></p>
            </div>
        </div>`;
    configurarAuthForm('login');
}

function renderRegistro() {
    app.innerHTML = `
        <div class="row justify-content-center">
            <div class="col-md-5 card p-4 shadow-sm">
                <h3 class="text-center">Registro de Usuario</h3>
                <form id="form-registro">
                    <div class="mb-3"><label>Nombre Completo</label><input type="text" name="name" class="form-control" required></div>
                    <div class="mb-3"><label>Correo Electrónico</label><input type="email" name="email" class="form-control" required></div>
                    <div class="mb-3"><label>Contraseña</label><input type="password" name="password" class="form-control" required></div>
                    <div class="mb-3"><label>Confirmar Contraseña</label><input type="password" name="password_confirmation" class="form-control" required></div>
                    <button type="submit" class="btn btn-success w-100">Registrarme</button>
                </form>
                <p class="mt-3 text-center small">¿Ya tienes cuenta? <a href="javascript:navegar('/login')">Loguéate</a></p>
            </div>
        </div>`;
    configurarAuthForm('registro');
}

function configurarAuthForm(tipo) {
    const form = document.getElementById(`form-${tipo}`);
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const data = Object.fromEntries(new FormData(form));
        const endpoint = tipo === 'login' ? '/login' : '/registro';

        try {
            const resp = await fetch(`${API_BASE}${endpoint}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify(data)
            });
            const res = await resp.json();
            if (res.status === 'success') {
                localStorage.setItem('token_user', 'active'); 
                navegar('/admin/dashboard');
                document.getElementById('nav-principal').classList.remove('d-none');
            } else {
                alert(res.message || "Error en los datos");
            }
        } catch (err) { console.error("Error Auth:", err); }
    });
}

// --- MÓDULO 2 & 3: EQUIPOS Y MOTOS [cite: 2026-01-11] ---
async function renderMotos() {
    app.innerHTML = '<h3>Gestión de Modelos (Motos)</h3><div id="motos-list" class="row">Cargando...</div>';
    try {
        const resp = await fetch(`${API_BASE}/motos`);
        const json = await resp.json();
        document.getElementById('motos-list').innerHTML = json.data.map(m => `
            <div class="col-md-4 mb-3">
                <div class="card p-2 border-primary">
                    <h6>${m.marca} - ${m.modelo}</h6>
                    <p class="mb-0 text-muted">$${m.precio}</p>
                </div>
            </div>`).join('');
    } catch (e) { console.error(e); }
}

async function renderEquipo() {
    app.innerHTML = '<h3>Gestión de Equipo</h3><div id="equipo-list" class="row">Cargando...</div>';
    try {
        const resp = await fetch(`${API_BASE}/equipos`);
        const json = await resp.json();
        document.getElementById('equipo-list').innerHTML = json.data.map(e => `
            <div class="col-md-3 text-center mb-3">
                <img src="${e.imagen_full_url}" class="img-fluid rounded-circle" style="width:100px">
                <p class="fw-bold">${e.nombre}</p>
            </div>`).join('');
    } catch (err) { console.error(err); }
}

// --- UTILIDADES ---
function verificarSesion() {
    if (!localStorage.getItem('token_user')) navegar('/login');
}

async function cerrarSesion() {
    await fetch(`${API_BASE}/logout`, { method: 'POST' });
    localStorage.clear();
    document.getElementById('nav-principal').classList.add('d-none');
    navegar('/login');
}

// --- MÓDULO Usuarios (Dentro del Dashboard) ---
async function renderUsuarios() {
    app.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Gestión de Usuarios</h3>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="usuarios-list">
                    <tr><td colspan="4" class="text-center">Cargando usuarios...</td></tr>
                </tbody>
            </table>
        </div>`;

    try {
        const resp = await fetch(`${API_BASE}/usuarios`);
        const json = await resp.json();
        
        const tbody = document.getElementById('usuarios-list');
        
        if (json.status === 'success' && json.data.length > 0) {
            tbody.innerHTML = json.data.map(u => `
                <tr>
                    <td>${u.id}</td>
                    <td>${u.name}</td>
                    <td>${u.email}</td>
                    <td>
                        <button class="btn btn-sm btn-danger" onclick="eliminarUsuario(${u.id})">Eliminar</button>
                    </td>
                </tr>
            `).join('');
        } else {
            tbody.innerHTML = '<tr><td colspan="4" class="text-center">No hay usuarios registrados.</td></tr>';
        }
    } catch (err) { 
        console.error("Error cargando usuarios:", err);
        document.getElementById('usuarios-list').innerHTML = '<tr><td colspan="4" class="text-center text-danger">Error al conectar con la API</td></tr>';
    }
}