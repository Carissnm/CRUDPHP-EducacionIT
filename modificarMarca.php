<?php
    require 'config/config.php';
    include 'layout/header.php';
    include 'layout/nav.php';
    require 'funciones/conexion.php';
    require 'funciones/marcas.php';
    require 'funciones/autenticar.php';
    autenticar();
    $check = modificarMarca();
    $mensaje = 'No se pudo modificar la marca';
    $css = 'danger';

    if ( $check ) {
        $mensaje = 'Marca modificada correctamente';
        $css = 'success';
    }

?>

<main class="container py-4">
        <h1>Modificación de una marca</h1>

        <div class="alert bg-light p-4 col-8 mx-auto shadow text-<?= $css ?>">
            <?= $mensaje ?>
            <a href="adminMarcas.php" class="btn btn-outline-secondary">
                Volver a panel de marcas
            </a>
        </div>

    </main>

<?php
    include 'layout/footer.php';
?>