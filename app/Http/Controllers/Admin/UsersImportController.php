<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UsersImportController extends Controller
{
    public function show()
    {
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
}