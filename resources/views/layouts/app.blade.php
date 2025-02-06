<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Proyecto</title>
    <!-- Agregar el CSS de SB Admin 2 -->
    <link href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar (opcional) -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Aquí puedes agregar los enlaces a tu sidebar -->
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Aquí puedes agregar la barra de navegación -->
                </nav>

                <div class="container-fluid">
                    @yield('content') <!-- Aquí se cargará el contenido de cada vista -->
                </div>
            </div>

        </div>
    </div>

    <!-- Agregar los scripts de SB Admin 2 -->
    <script src="https://cdn.jsdelivr.net/npm/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-easing/jquery.easing.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2/js/sb-admin-2.min.js"></script>
</body>

</html>
