<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario - Novatech</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }
        .form-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            width: 100%;
            max-width: 800px;
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .form-container h2 {
            color: #007bff;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: 600;
        }
        .form-container input {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px 15px 12px 45px;
            width: 100%;
            font-size: 1rem;
            color: #333;
            transition: all 0.3s ease;
            outline: none;
        }
        .form-container input:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
            background: #fff;
        }
        .form-container .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .form-container .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #007bff;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }
        .form-container button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #007bff;
            color: #fff;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
            font-weight: 500;
        }
        .form-container button:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }
        .form-container button:active {
            transform: translateY(0);
        }
        .form-container button i {
            margin-right: 8px;
        }
        .form-container .row {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
        }
        .form-container .col {
            flex: 1;
            min-width: 250px;
        }
        /* Indicador de validación */
        .validation-indicator {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            color: #ccc;
            transition: color 0.3s ease;
        }
        .valid .validation-indicator {
            color: #28a745;
        }
        .invalid .validation-indicator {
            color: #dc3545;
        }
        /* Efecto de sombra al pasar el cursor sobre el formulario */
        .form-container:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }
                /* Enlaces */
                .login-links {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .login-links a {
            color: #007bff;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
            margin-bottom: 0.5rem;
        }

        .login-links a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Registro de Usuario</h2>
        <form method="POST" action="{{ route('user.register.submit') }}">
            @csrf
            <div class="row">
                <!-- Columna Izquierda -->
                <div class="col">
                    <!-- Nombre -->
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="nombre" placeholder="Nombre" required>
                        <i class="fas fa-check validation-indicator"></i>
                    </div>
                    <!-- Apellido Paterno -->
                    <div class="input-group">
                        <i class="fas fa-id-card"></i>
                        <input type="text" name="app" placeholder="Apellido Paterno" required>
                        <i class="fas fa-check validation-indicator"></i>
                    </div>
                    <!-- Apellido Materno -->
                    <div class="input-group">
                        <i class="fas fa-id-card"></i>
                        <input type="text" name="apm" placeholder="Apellido Materno" required>
                        <i class="fas fa-check validation-indicator"></i>
                    </div>
                    <!-- Fecha de Nacimiento -->
                    <div class="input-group">
                        <i class="fas fa-calendar-alt"></i>
                        <input type="date" name="fn" required>
                        <i class="fas fa-check validation-indicator"></i>
                    </div>
                </div>
                <!-- Columna Derecha -->
                <div class="col">
                    <!-- Teléfono -->
                    <div class="input-group">
                        <i class="fas fa-phone"></i>
                        <input type="text" name="telefono" placeholder="Teléfono" required>
                        <i class="fas fa-check validation-indicator"></i>
                    </div>
                    <!-- Correo Electrónico -->
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Correo Electrónico" required>
                        <i class="fas fa-check validation-indicator"></i>
                    </div>
                    <!-- Contraseña -->
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Contraseña" required>
                        <i class="fas fa-check validation-indicator"></i>
                    </div>
                    <!-- Confirmar Contraseña -->
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña" required>
                        <i class="fas fa-check validation-indicator"></i>
                    </div>
                </div>
            </div>
            <!-- Botón de Registro -->
            <button type="submit">
                <i class="fas fa-user-plus"></i> Registrarse
            </button>

            <!-- Enlaces adicionales -->
            <div class="login-links">
                <p>¿Ya tienes una cuenta? <a href="{{ route('user.login') }}" class="login-link">Iniciar sesión</a></p>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS (opcional, si necesitas componentes interactivos) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const password = document.querySelector('input[name="password"]');
        const passwordConfirmation = document.querySelector('input[name="password_confirmation"]');

        document.querySelector('form').addEventListener('submit', (e) => {
            if (password.value !== passwordConfirmation.value) {
                e.preventDefault();
                alert("Las contraseñas no coinciden.");
            }
        });

        // Validación visual con indicadores de semáforo
        document.querySelectorAll('.input-group input').forEach(input => {
            input.addEventListener('input', () => {
                const group = input.parentElement;
                if (input.checkValidity()) {
                    group.classList.add('valid');
                    group.classList.remove('invalid');
                } else {
                    group.classList.add('invalid');
                    group.classList.remove('valid');
                }
            });
        });
    </script>
</body>
</html>
