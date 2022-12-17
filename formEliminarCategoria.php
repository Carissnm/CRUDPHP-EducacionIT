<?php
    require 'config/config.php';
    require 'funciones/conexion.php';
    require 'funciones/categorias.php';
    require 'funciones/autenticar.php';
    autenticar();
    $cantidad = checkProductoPorCategoria();
    include 'layout/header.php';
    include 'layout/nav.php';
?>

    <main class="container py-4">
        <h1>Baja de la categoría</h1>
<?php
    if ( $cantidad ) {
?>
        <div class="alert alert-danger col-6 mx-auto">
            <i class="bi bi-exclamation-triangle"></i>
            No se puede eliminar la categoría ya que tiene productos relacionados
            <br>
            <a href="adminCategorias.php" class="btn btn-light mt-3">
                Volver a panel de categorías
            </a>
        </div>
<?php
    } else {
        $categoria = verCategoriaPorId( $_GET['idCategoria'] );
?>

        <div class="alert bg-light p-4 col-6 mx-auto shadow text-danger">
            Se eliminará la categoría: <span class="lead"><?= $categoria['catNombre'] ?></span>
            <form action="eliminarCategoria.php" method="post">
                <input type="hidden" name="idCategoria"
                        value="<?= $categoria['idCategoria'] ?>">
                <button class="btn btn-danger my-3 px-4">Confirmar baja</button>
                <a href="adminCategorias.php" class="btn btn-outline-secondary">
                    Volver a panel de categorias
                </a>
            </form>
        </div>
<?php
    }
?>


    </main>

<?php  include 'layout/footer.php';  ?>