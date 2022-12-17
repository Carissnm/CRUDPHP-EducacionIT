<?php
    require 'config/config.php';
    include 'layout/header.php';
    include 'layout/nav.php';
    require 'funciones/conexion.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    autenticar();

    $check = agregarProducto();
?>

    <main class="container py-4">
        <h1>Alta de un Producto</h1>
<?php
    if ($check) {
?>
        <div class="alert bg-light p-4 col-8 mx-auto shadow text-success">
            Producto agregado correctamente.
            <a href="adminProductos.php" class="btn btn-outline-secondary">
                Volver a panel de productos
            </a>
        </div>
<?php
    } else {
?>
        <div class="alert bg-light p-4 col-8 mx-auto shadow text-danger">
            No se pudo agregar el producto.
            <a href="adminProductos.php" class="btn btn-outline-secondary">
                Volver a panel de productos
            </a>

        </div>
<?php
    }
?>

    </main>

<?php
    include 'layout/footer.php';
?>