<?php

namespace App\Http\Controllers\Admin;

<<<<<<< HEAD
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
=======
use Shuchkin\SimpleXLSX;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
>>>>>>> 468d358 (semafos2)

class UsersImportController extends Controller
{
    public function show()
    {
<<<<<<< HEAD
        return view('admin.users.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'archivo' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        try {
            // Verifica si ZipArchive está disponible
            if (!class_exists('ZipArchive')) {
                throw new \Exception('La extensión ZipArchive no está disponible en el servidor.');
            }

            Excel::import(new UsersImport, $request->file('archivo'));
            return redirect()->back()->with('success', 'Usuarios importados correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al importar: ' . $e->getMessage());
        }
    }
=======
        // Obtener todos los usuarios para mostrarlos en la tabla
        $users = User::all();
        return view('admin.users.import', compact('users'));
    }

    public function import(Request $request)
 {
    $request->validate([
        'archivo' => 'required|mimes:xlsx,xls|max:2048',
    ]);

    try {
        // Iniciar una transacción
        DB::beginTransaction();

        // Cargar el archivo usando SimpleXLSX
        if ($xlsx = SimpleXLSX::parse($request->file('archivo')->getPathname())) {
            $rows = $xlsx->rows();

            // Ignorar la primera fila si contiene encabezados
            $header = array_shift($rows);

            foreach ($rows as $row) {
                // Validar que la fila tenga suficientes columnas
                if (count($row) < 6) {
                    continue; // Saltar filas incompletas
                }

                // Validar que el correo no esté duplicado
                if (User::where('email', $row[5])->exists()) {
                    continue; // Saltar si el correo ya existe
                }

                // Convertir la fecha al formato YYYY-MM-DD
                try {
                    $fechaNacimiento = Carbon::createFromFormat('d/m/Y', $row[3])->format('Y-m-d');
                } catch (\Exception $e) {
                    // Si la fecha no es válida, asignar un valor por defecto o saltar la fila
                    $fechaNacimiento = '1970-01-01'; // Fecha por defecto
                }

                // Crear el usuario
                User::create([
                    'nombre' => $row[0],
                    'app' => $row[1],
                    'apm' => $row[2],
                    'fn' => $fechaNacimiento, // Fecha formateada
                    'telefono' => $row[4],
                    'email' => $row[5],
                    'password' => bcrypt($row[6]), // Usar la contraseña del archivo Excel
                ]);
            }
        } else {
            throw new \Exception('Error al leer el archivo Excel.');
        }

        // Confirmar la transacción
        DB::commit();

        // Redirigir a la vista con un mensaje de éxito
        return redirect()->route('admin.users.index')->with('success', 'Usuarios importados correctamente.');
    } catch (\Illuminate\Database\QueryException $e) {
        // Revertir la transacción en caso de error
        DB::rollBack();
        return redirect()->route('admin.users.index')->with('error', 'Error en la base de datos: ' . $e->getMessage());
    } catch (\Exception $e) {
        // Revertir la transacción en caso de error
        DB::rollBack();
        return redirect()->route('admin.users.index')->with('error', 'Error al importar: ' . $e->getMessage());
    }
}
>>>>>>> 468d358 (semafos2)
}