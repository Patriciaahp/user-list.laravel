@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Usuarios</h1>

    <!-- Formulario de búsqueda -->
    <form method="GET" action="{{ route('users.index') }}" class="mb-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar usuario...">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <!-- Tabla -->
    <table class="table">
        <thead>
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->dni }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No se encontraron usuarios.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $users->links('pagination::bootstrap-4') }}
</div>
@endsection
