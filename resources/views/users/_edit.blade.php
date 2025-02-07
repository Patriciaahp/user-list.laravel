<form id="edit-user-form" action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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
        <input type="date" name="birth_date" class="form-control"
       value="{{ old('birth_date', optional($user->birth_date)->format('Y-m-d')) }}" required>
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
</form>
