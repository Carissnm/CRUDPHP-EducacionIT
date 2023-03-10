<?php
    require 'config/config.php';
    require 'funciones/conexion.php';
    require 'funciones/roles.php';
    include 'layout/header.php';
    include 'layout/nav.php';
?>

    <main class="container">
        <h1>Alta de un usuario</h1>


        <div class="alert bg-light p-4 col-8 mx-auto shadow">
            <form action="agregarUsuario.php" method="post">

                <div class='form-group mb-2'>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre"
                        class='form-control' id="nombre" required>
                </div>
                <div class='form-group mb-2'>
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido"
                        class='form-control' id="apellido" required>
                </div>
                <div class='form-group'>
                    <label for="email">Email</label>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text">@</div>
                        </div>
                        <input type="email" name="email"
                            class="form-control" id="email" required>
                    </div>
                </div>

                <div class='form-group'>
                    <label for="clave">Contraseña</label>
                    <input type="password" name="clave"
                        class='form-control' id="clave" required>
                </div>

<?php
        if( isset($_SESSION['idrol']) && $_SESSION['idrol'] == 1 ){
            $roles = listarRoles();
?>
                <div class="form-group mb-4">
                    <label for="idrol">Rol</label>
                    <select class="form-select" name="idrol" id="idrol" required>
                        <option value="">Seleccione un rol</option>
        <?php
                while( $rol = mysqli_fetch_assoc( $roles ) ){
        ?>
                        <option value="<?= $rol['idrol'] ?>"><?= $rol['rol'] ?></option>
        <?php
                }
        ?>
                    </select>
                </div>
<?php
        }
?>


                <button class='btn btn-dark my-3 px-4'>Agregar usuario</button>
                <a href="adminUsuarios.php" class='btn btn-outline-secondary'>
                    Volver a panel de usuarios
                </a>
            </form>

        </div>

    </main>

<?php  include 'layout/footer.php';  ?>