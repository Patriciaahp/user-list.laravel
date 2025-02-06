@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Listado de Usuarios</h1>

    <!-- Formulario de búsqueda -->
    <form id="search-form" class="mb-3">
        <div class="form-row">
            <div class="col-md-4">
                <input type="text" id="search" class="form-control" placeholder="Buscar usuario...">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>

    <!-- Botón de nuevo usuario -->
    <a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#createUserModal">
        Nuevo Usuario
    </a>

    <!-- Tabla de usuarios -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
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
                                    <button class="btn btn-warning btn-sm edit-user" data-id="{{ $user->id }}">Editar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="pagination-links">
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<!-- Modal para creación de usuario -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="create-user-form">
                    @csrf
                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input type="text" class="form-control" id="dni" name="dni" required maxlength="10">
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre Completo</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="birth_date">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono</label>
                        <input type="text" class="form-control" id="phone" name="phone" required maxlength="15">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para edición de usuario -->
<div class="modal fade" id="edit-user-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    function loadUsers(page = 1, search = '') {
        $.ajax({
            url: "{{ route('users.index') }}",
            type: "GET",
            data: { page: page, search: search },
            dataType: "json",
            success: function(response) {
                let usersTable = $('#users-table tbody');
                usersTable.html('');

                if (response.users.length === 0) {
                    usersTable.append('<tr><td colspan="6" class="text-center">No se encontraron usuarios.</td></tr>');
                    return;
                }

                $.each(response.users, function(index, user) {
                    usersTable.append(`
                        <tr>
                            <td>${user.dni}</td>
                            <td>${user.name}</td>
                            <td>${user.birth_date}</td>
                            <td>${user.phone}</td>
                            <td>${user.email}</td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-user" data-id="${user.id}">Editar</button>
                            </td>
                        </tr>
                    `);
                });

                $('#pagination-links').html(response.pagination);
            },
            error: function(xhr) {
                console.error("Error al cargar usuarios:", xhr.responseText);
            }
        });
    }

    loadUsers();

    $('#search-form').on('submit', function(e) {
        e.preventDefault();
        loadUsers(1, $('#search').val());
    });

    $(document).on('click', '.edit-user', function() {
        let userId = $(this).data('id');
        $.get(`/users/${userId}/edit`, function(response) {
            $('#edit-user-modal .modal-body').html(response);
            $('#edit-user-modal').modal('show');
        });
    });

    // Crear nuevo usuario
    $('#create-user-form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('users.store') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                alert("Usuario creado con éxito!");
                $('#createUserModal').modal('hide'); // Cierra el modal
                loadUsers(); // Recarga la lista de usuarios
            },
            error: function(xhr) {
                alert("Error al crear el usuario.");
                console.log(xhr.responseText);
            }
        });
    });
});
</script>
@endsection
