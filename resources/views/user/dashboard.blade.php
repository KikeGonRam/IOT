<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Usuario - NovaTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        :root {
            --color-primary: #2563eb;
            --color-secondary: #3b82f6;
            --color-accent: #60a5fa;
            --color-background: #000000; /* Fondo negro */
            --color-text: #e2e8f0;
            --neon-red: #ff4444;
            --neon-yellow: #ffdd44;
            --neon-green: #44ff44;
            --neon-blue: #3b82f6;
            --neon-purple: #bf40bf;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: var(--color-text);
            background: var(--color-background);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Fondo con imagen y partículas */
        body::before {
            content: '';
            position: fixed; /* Fondo fijo */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://th.bing.com/th/id/OIP.WwGNGMWSIyaAs0joqhNAPgHaEK?rs=1&pid=ImgDetMain') no-repeat center center/cover;
            opacity: 0.2;
            z-index: -1;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1rem;
            position: sticky;
            top: 0;
            z-index: 100;
            animation: slideDown 0.5s ease;
            border-bottom: 2px solid var(--neon-blue);
            box-shadow: 0 0 30px var(--neon-blue);
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--color-accent) !important;
            transition: color 0.3s ease;
        }

        .nav-link {
            color: var(--color-text) !important;
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem !important;
            margin: 0 0.25rem;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--color-primary) !important;
            background-color: rgba(37, 99, 235, 0.1);
        }

        .logout-btn {
            background-color: var(--neon-red);
            border: none;
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .logout-btn:hover {
            background-color: #dc2626;
            transform: translateY(-1px);
        }

        /* Contenedor principal */
        .dashboard-container {
            margin-top: 2rem;
            padding: 2rem;
        }

        /* Tarjeta de bienvenida */
        .welcome-card {
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            color: white;
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            animation: fadeIn 1s ease;
        }

        .welcome-card h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .welcome-card p {
            font-size: 1.2rem;
            margin-bottom: 0;
        }

        /* Actividades */
        .activities {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .activity-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 1rem;
            padding: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 2px solid transparent;
            animation: slideUp 0.5s ease;
        }

        .activity-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 20px var(--neon-blue);
            border-color: var(--neon-blue);
        }

        .activity-card i {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--neon-blue);
        }

        .activity-card h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .activity-card p {
            font-size: 1rem;
            color: var(--color-text);
        }

        /* Animaciones */
        @keyframes slideDown {
            from { transform: translateY(-100%); }
            to { transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Estilos adicionales para las tarjetas de estadísticas */
        .card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 2px solid transparent;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 20px var(--neon-blue);
            border-color: var(--neon-blue);
        }

        .card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--neon-blue);
        }

        .semaforo-status {
            display: flex;
            justify-content: space-around;
            margin: 1rem 0;
        }

        .semaforo-light {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #ccc;
        }

        .semaforo-light.verde.active {
            background-color: var(--neon-green);
        }

        .semaforo-light.amarillo.active {
            background-color: var(--neon-yellow);
        }

        .semaforo-light.rojo.active {
            background-color: var(--neon-red);
        }

        .text-success {
            color: var(--neon-green);
        }

        .text-warning {
            color: var(--neon-yellow);
        }

        .text-danger {
            color: var(--neon-red);
        }

        .table-container {
            margin-top: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 1rem;
            overflow: hidden;
        }

        th, td {
            padding: 1rem;
            text-align: left;
        }

        th {
            background-color: rgba(255, 255, 255, 0.1);
        }

        tr:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-badge.verde {
            background-color: var(--neon-green);
            color: #000;
        }

        .status-badge.amarillo {
            background-color: var(--neon-yellow);
            color: #000;
        }

        .status-badge.rojo {
            background-color: var(--neon-red);
            color: #000;
        }

    .semaforo-list {
        list-style-type: none; /* Elimina los puntos de las viñetas */
        padding-left: 0; /* Elimina el padding por defecto de la lista */
    }

    .semaforo-list li {
        position: relative; /* Permite posicionar el semáforo */
        padding-left: 1.5em; /* Espacio para el semáforo */
        margin-bottom: 0.5rem; /* Espaciado entre elementos */
    }

    .semaforo-list li::before {
        content: "🚦"; /* Agrega el semáforo como viñeta */
        position: absolute;
        left: 0; /* Alinea el semáforo a la izquierda */
    }

    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="fas fa-traffic-light me-2"></i>
            NovaTech
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        <i class="fas fa-home me-2"></i>Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('user.pagina2') }}">
                        <i></i>Acerca del Sistema
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <div class="me-3 text-end">
                    <small class="text-muted d-block">Bienvenido</small>
                    <span class="fw-bold">Usuario</span>
                </div>
                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="dashboard-container">
    <div class="welcome-card">
        <h1>Bienvenido al Dashboard de NovaTech</h1>
        <p>Gestión y monitoreo de tráfico vehicular en tiempo real.</p>
    </div>

    <div class="dashboard-grid">
        <div class="card">
            <h3>Semáforos Activos</h3>
            <div class="stats-number">48</div>
            <div class="semaforo-status">
                <div class="semaforo-light verde active"></div>
                <div class="semaforo-light amarillo"></div>
                <div class="semaforo-light rojo"></div>
            </div>
            <small>98% operatividad</small>
        </div>

        <div class="card">
            <h3>Flujo Vehicular</h3>
            <div class="stats-number">12,450</div>
            <div class="text-success">↓ 5% pico máximo</div>
        </div>
    </div>

    <div class="dashboard-grid">
      <div class="card">
        <h3>Importancia de los Semáforos</h3>
        <p>Los semáforos son esenciales para la gestión del tráfico, ya que ayudan a:</p>
        <ul class="semaforo-list">
            <li>Reducir los accidentes de tráfico.</li>
            <li>Optimizar el flujo vehicular.</li>
            <li>Minimizar los tiempos de espera en intersecciones.</li>
            <li>Mejorar la seguridad de peatones y ciclistas.</li>
        </ul>
      </div>

        <div class="card">
            <h3>Estadísticas de Tráfico</h3>
            <p>El tráfico vehicular a fuera de la Universidad Tecnologica del Valle de Toluca a mostrado una tendencia a la baja en las horas pico, lo que indica una mejora en la gestión del tráfico y una reducción en los tiempos donde existe mas trafico normalmente.</p>
            <div class="text-warning">↓ 10% en horas pico</div>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Última Actividad</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>USR-001</td>
                    <td>Sebastian Rojas Nuñez</td>
                    <td>Administrador</td>
                    <td><span class="status-badge verde active">Activo</span></td>
                    <td>Hace 2 horas</td>
                </tr>
                <tr>
                    <td>USR-002</td>
                    <td>Rubi Plata Alvarez</td>
                    <td>Administradora</td>
                    <td><span class="status-badge amarillo active">Activa</span></td>
                    <td>Hace 1 hora</td>
                </tr>
                <tr>
                    <td>USR-003</td>
                    <td>Luis Enrique Gonzales Ramirez</td>
                    <td>Administrador</td>
                    <td><span class="status-badge amarillo active">Activo</span></td>
                    <td>Hace 30 minutos</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>