<?php
    require 'config/config.php';
    include 'layout/header.php';
    include 'layout/nav.php';
    require 'funciones/conexion.php';
    require 'funciones/marcas.php';

    $check = eliminarMarca();
    $mensaje = 'No se pudo eliminar la marca';
    $css = 'danger';

    if ( $check ) {
        $mensaje = 'Marca eliminada exitosamente';
        $css = 'success';
    }
?>

    <main class="container py-4">
        <h1>Baja de una marca</h1>

        <div class="alert bg-light p-4 col-8 mx-auto shadow text-<?= $css ?>">
            <?= $mensaje ?><br>
            <a href="adminMarcas.php" class="btn btn-outline-secondary">
                Volver a panel de marcas
            </a>
        </div>

    </main>

<?php
    include 'layout/footer.php';
?>