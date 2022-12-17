<?php
    require 'config/config.php';
    include 'layout/header.php';
    include 'layout/nav.php';
    require 'funciones/conexion.php';
    require 'funciones/categorias.php';

    $check = eliminarCategoria();
    $mensaje = 'No se pudo eliminar la categoría';
    $css = 'danger';

    if ( $check ) {
        $mensaje = 'Categoría eliminada exitosamente';
        $css = 'success';
    }
?>

    <main class="container py-4">
        <h1>Baja de una categoría</h1>

        <div class="alert bg-light p-4 col-8 mx-auto shadow text-<?= $css ?>">
            <?= $mensaje ?><br>
            <a href="adminCategorias.php" class="btn btn-outline-secondary">
                Volver a panel de categorías
            </a>
        </div>

    </main>

<?php
    include 'layout/footer.php';
?>