<?php
    require 'config/config.php';
    include 'layout/header.php';
    include 'layout/nav.php';
    require 'funciones/conexion.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    autenticar();
    $check = modificarProducto();
    $mensaje = 'No se pudo modificar el producto';
    $css = 'danger';

    if ( $check ) {
        $mensaje = 'Producto modificado correctamente';
        $css = 'success';
    }

?>

<main class="container py-4">
        <h1>Modificación de un producto</h1>

        <div class="alert bg-light p-4 col-8 mx-auto shadow text-<?= $css ?>">
            <?= $mensaje ?>
            <a href="adminProductos.php" class="btn btn-outline-secondary">
                Volver a panel de productos
            </a>
        </div>

    </main>

<?php
    include 'layout/footer.php';
?>