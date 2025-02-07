<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        // Búsqueda simple
        $query = User::query();

        if (!empty($search)) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('dni', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $users = $query->paginate(10);

        return view('users.index', compact('users'));
    }

    

    public function store(Request $request)
    {
        // Validar datos del usuario
        $validated = $request->validate([
            'dni' => 'required|string|max:10|unique:users,dni',
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
        ]);

        // Guardar usuario
        User::create($validated);

        return response()->json(['message' => 'Usuario creado con éxito']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        if (request()->ajax()) {
            return view('users.partials.edit-form', compact('user'));
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validar datos
        $validated = $request->validate([
            'dni' => 'required|string|max:10|unique:users,dni,' . $id,
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        // Actualizar usuario
        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito.');
    }
}
