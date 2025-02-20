<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use MongoDB;
$estudiantes = Estudiante::all();

class tablaController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::all();
        return view('tabla', compact('estudiantes'));
    }

    public function create()
    {
        return view('crear');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'salon' => 'required|string|max:255',
            'grado' => 'required|string|max:255',
            'dni' => 'required|string|max:255|unique:estudiantes,dni',
        ]);

        Estudiante::create($request->all());

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante registrado correctamente.');
    }

    public function edit($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        return view('editar', compact('estudiante'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'salon' => 'required|string|max:255',
            'grado' => 'required|string|max:255',
            'dni' => 'required|string|max:255|unique:estudiantes,dni,'.$id,
        ]);

        $estudiante = Estudiante::findOrFail($id);
        $estudiante->update($request->all());

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado correctamente.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $estudiante = Estudiante::where('nombre', $request->nombre)->first();

        if ($estudiante) {
            $estudiante->delete();
            return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado correctamente.');
        } else {
            return redirect()->route('estudiantes.index')->with('error', 'No se encontró ningún estudiante con ese nombre.');
        }
    }
}
