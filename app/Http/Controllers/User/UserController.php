<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // Vista para el formulario de registro
    public function registerForm(){
        return view('user.register');
    }

    // Procesamiento del formulario de registro
    public function register(Request $request){
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required',
            'app' => 'required',
            'apm' => 'required',
            'fn' => 'required|date',
            'telefono' => 'required',
            'email' => 'required|email', // Asegurar que el email sea único
            'password' => 'required|min:8', // Confirmar la contraseña
        ]);

        // Crear el usuario
        $user = User::create([
            'nombre' => $request->nombre,
            'app' => $request->app,
            'apm' => $request->apm,
            'fn' => $request->fn,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Autenticar al usuario después del registro
        Auth::login($user);

        // Redirigir al dashboard con un mensaje de éxito
        return redirect()->route('user.dashboard')->with('success', '¡Te has registrado correctamente!');
    }

    // Vista para el formulario de login
    public function loginForm(){
        return view('user.login');
    }

    // Procesamiento del login
   /* public function login(Request $request){
        // Validar las credenciales
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            return redirect()->route('user.dashboard');
        }

        // Si la autenticación falla, redirigir con un mensaje de error
        return back()->withErrors([
            'email' => 'Credenciales incorrectas',
        ])->onlyInput('email');
    }*/
    
    public function login(Request $request)
    {
        // Validar las credenciales
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Clave para limitar intentos por usuario
        $throttleKey = 'login-attempts:' . $request->email;
    
        // Número máximo de intentos antes del bloqueo
        $maxAttempts = 3;
        $decayMinutes = 5;
    
        // Verificar si el usuario está bloqueado
        if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
            $timeRemaining = RateLimiter::availableIn($throttleKey);
    
            return back()->withErrors([
                'email' => "Demasiados intentos fallidos. Inténtalo nuevamente en $timeRemaining segundos.",
            ])->onlyInput('email');
        }
    
        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Si inicia sesión correctamente, limpiar los intentos fallidos
            RateLimiter::clear($throttleKey);
            return redirect()->route('user.dashboard');
        }
    
        // Registrar el intento fallido
        RateLimiter::hit($throttleKey, $decayMinutes * 60);
    
        // Obtener intentos restantes antes del bloqueo
        $attemptsLeft = $maxAttempts - RateLimiter::attempts($throttleKey);
    
        return back()->withErrors([
            'email' => "Credenciales incorrectas. Te quedan $attemptsLeft intentos.",
        ])->onlyInput('email');
    }
    
    // Vista para el dashboard
    public function dashboard(){
        return view('user.dashboard');
    }

    // Cierre de sesión
    public function logout(){
        Auth::logout();
        return redirect()->route('user.login');
    }
}
