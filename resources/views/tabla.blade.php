<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Estudiantes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Listado de Estudiantes</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Salón</th>
                    <th>Grado</th>
                    <th>DNI</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudiantes as $estudiante)
                    <tr>
                        <td>{{ $estudiante->nombre }}</td>
                        <td>{{ $estudiante->apellido }}</td>
                        <td>{{ $estudiante->salon }}</td>
                        <td>{{ $estudiante->grado }}</td>
                        <td>{{ $estudiante->dni }}</td>
                        <td>
                            <!-- Ver detalles -->
                            <button class="btn btn-info" data-toggle="modal" data-target="#viewModal" data-id="{{ $estudiante->_id }}" data-nombre="{{ $estudiante->nombre }}" data-apellido="{{ $estudiante->apellido }}" data-salon="{{ $estudiante->salon }}" data-grado="{{ $estudiante->grado }}" data-dni="{{ $estudiante->dni }}">Ver</button>

                            <!-- Editar -->
                            <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" data-id="{{ $estudiante->_id }}" data-nombre="{{ $estudiante->nombre }}" data-apellido="{{ $estudiante->apellido }}" data-salon="{{ $estudiante->salon }}" data-grado="{{ $estudiante->grado }}" data-dni="{{ $estudiante->dni }}">Editar</button>

                            <!-- Eliminar -->
                            <form action="{{ route('estudiantes.destroy', $estudiante->_id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este estudiante?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal para ver detalles -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!-- Contenido del modal -->
    </div>

    <!-- Modal para editar -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!-- Contenido del modal -->
    </div>

    <script>
        // Función para llenar el modal de ver detalles
        $('#viewModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Botón que activa el modal
            var id = button.data('id');
            var nombre = button.data('nombre');
            var apellido = button.data('apellido');
            var salon = button.data('salon');
            var grado = button.data('grado');
            var dni = button.data('dni');

            var modal = $(this);
            modal.find('.modal-title').text('Detalles del Estudiante');
            modal.find('.modal-body #id').text(id);
            modal.find('.modal-body #nombre').text(nombre);
            modal.find('.modal-body #apellido').text(apellido);
            modal.find('.modal-body #salon').text(salon);
            modal.find('.modal-body #grado').text(grado);
            modal.find('.modal-body #dni').text(dni);
        });

        // Función para llenar el modal de editar
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Botón que activa el modal
            var id = button.data('id');
            var nombre = button.data('nombre');
            var apellido = button.data('apellido');
            var salon = button.data('salon');
            var grado = button.data('grado');
            var dni = button.data('dni');

            var modal = $(this);
            modal.find('.modal-title').text('Editar Estudiante');
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #nombre').val(nombre);
            modal.find('.modal-body #apellido').val(apellido);
            modal.find('.modal-body #salon').val(salon);
            modal.find('.modal-body #grado').val(grado);
            modal.find('.modal-body #dni').val(dni);
        });
    </script>
</body>
</html>
