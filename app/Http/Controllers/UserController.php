<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

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
        $validated = $request->validate([
            'dni' => 'required|string|max:10|unique:users,dni',
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'phone' => 'required|string|max:15|unique:users,phone',
            'email' => 'required|email|unique:users,email',
        ]);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'Usuario creado.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $validated = $request->validate([
            'dni' => 'required|string|max:10|unique:users,dni,' . $id,
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
    
        if (!$request->has('birth_date')) {
            $validated['birth_date'] = $user->birth_date;
        }
    
        $user->update($validated);
    
        return redirect()->route('users.index')->with('success', 'Usuario actualizado.');
    }

    public function create()
{
    return view('users.create');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('users.index')->with('success', 'Usuario eliminado.');
}
}
