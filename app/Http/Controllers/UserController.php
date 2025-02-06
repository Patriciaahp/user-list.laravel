<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function index(Request $request)
   {
       $query = User::query();

       if ($request->has('search')) {
           $search = $request->input('search');
           $query->where('name', 'like', '%' . $search . '%')
                 ->orWhere('dni', 'like', '%' . $search . '%')
                 ->orWhere('email', 'like', '%' . $search . '%');
       }

       $users = $query->paginate(10);

       return view('users.index', compact('users'));
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
           'dni' => 'required|unique,dni,' . $id,
           'name' => 'required|string|max:255',
           'birth_date' => 'required|date',
           'phone' => 'required|string|max:15',
           'email' => 'required|email|unique:users,email,' . $id,
       ]);

       $user->update($validated);

       return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito.');
   }
}