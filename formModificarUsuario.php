<?php
    require 'config/config.php';
    require 'funciones/usuarios.php';
    require 'funciones/conexion.php';
    include 'layout/header.php';
    include 'layout/nav.php';
    // $usuario = verUsuarioPorId($_GET['idUsuario']);
?>

    <main class="container">
        <h1>Modificación de perfil</h1>


        <div class='alert p-4 col-8 mx-auto shadow'>
            <form action="modificarUsuario.php" method="post">

                <div class='form-group mb-2'>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre"
                        value="<?= $_SESSION['nombre'] ?>"
                        class='form-control' id="nombre" required>
                </div>
                <div class='form-group mb-2'>
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido"
                        value="<?= $_SESSION['apellido'] ?>"
                        class='form-control' id="apellido" required>
                </div>
                <div class='form-group'>
                    <label for="email">Email</label>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text">@</div>
                        </div>
                        <input type="email" name="email"
                            value="<?= $_SESSION['email'] ?>"
                            class="form-control" id="email" required>
                    </div>
                </div>
                <input type="hidden" name="idUsuario" value="<?= $_SESSION['idUsuario'] ?>">

                <button class='btn btn-dark my-3 px-4'>Modificación usuario</button>
                <a href="adminUsuarios.php" class='btn btn-outline-secondary'>
                    Volver a panel de usuarios
                </a>
            </form>

        </div>

    </main>

<?php  include 'layout/footer.php';  ?>