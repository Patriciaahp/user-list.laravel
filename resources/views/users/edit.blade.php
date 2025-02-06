@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Editar Usuario</h1>

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card shadow mb-4">
                <div class="card-body">

                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input type="text" name="dni" class="form-control" value="{{ old('dni', $user->dni) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Nombre Completo</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="birth_date">Fecha de Nacimiento</label>
                        <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $user->birth_date) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Teléfono</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>

                </div>
            </div>
        </form>

        <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver al listado</a>
    </div>
@endsection
