<?php
    require 'config/config.php';
    include 'layout/header.php';
    include 'layout/nav.php';
    require 'funciones/conexion.php';
    require 'funciones/categorias.php';
    require 'funciones/autenticar.php';
    autenticar();
    $check = modificarCategoria();
    $mensaje = 'No se pudo modificar la marca';
    $css = 'danger';

    if ( $check ) {
        $mensaje = 'Categoría modificada correctamente';
        $css = 'success';
    }

?>

<main class="container py-4">
        <h1>Modificación de una categoría</h1>

        <div class="alert bg-light p-4 col-8 mx-auto shadow text-<?= $css ?>">
            <?= $mensaje ?>
            <a href="adminCategorias.php" class="btn btn-outline-secondary">
                Volver a panel de categorías
            </a>
        </div>

    </main>

<?php
    include 'layout/footer.php';
?>