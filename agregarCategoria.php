<?php
    require 'config/config.php';
    include 'layout/header.php';
    include 'layout/nav.php';
    require 'funciones/conexion.php';
    require 'funciones/categorias.php';


    $check = agregarCategoria();
?>

    <main class="container py-4">
        <h1>Alta de una Categoria</h1>
<?php
    if ($check) {
?>
        <div class="alert bg-light p-4 col-8 mx-auto shadow text-success">
            Categoría agregada correctamente.
            <a href="adminCategorias.php" class="btn btn-outline-secondary">
                Volver a panel de categorías
            </a>
        </div>
<?php
    } else {
?>
        <div class="alert bg-light p-4 col-8 mx-auto shadow text-danger">
            No se pudo agregar la categoría.
            <a href="adminCategorias.php" class="btn btn-outline-secondary">
                Volver a panel de categorías
            </a>

        </div>
<?php
    }
?>

    </main>

<?php
    include 'layout/footer.php';
?>