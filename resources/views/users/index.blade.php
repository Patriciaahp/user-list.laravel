@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Listado de Usuarios</h1>

        <!-- Formulario de búsqueda -->
        <form action="{{ route('users.index') }}" method="GET" class="mb-3">
            <div class="form-row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Buscar usuario..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>

        <!-- Botón de nuevo usuario -->
        <a href="{{ route('users.create') }}" class="btn btn-success mb-3">
            Nuevo Usuario
        </a>

        <!-- Tabla de usuarios -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>DNI</th>
                                <th>Nombre Completo</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->dni }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->birth_date }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Paginación -->
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
