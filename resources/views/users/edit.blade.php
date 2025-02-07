@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Editar Usuario</h1>

        @include('users._edit')

        <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Volver al listado</a>
    </div>
@endsection
