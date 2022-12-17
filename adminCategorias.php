<?php
        require 'config/config.php';
        require 'funciones/autenticar.php';
        autenticar();
        include 'layout/header.php';
        include 'layout/nav.php';
        require 'funciones/conexion.php';
        require 'funciones/categorias.php';
        

        $categorias = listaCategorias();
?>

<main class="container">
        <h1>Panel de administración de Categorías</h1>

        <a href="admin.php" class="btn btn-outline-secondary btn-sm my-2">
            <i class="bi bi-chevron-left"></i>
            Volver a dashboard
        </a>

        <table class="table table-borderless table-striped table-hover">
            <thead>

                <tr>
                    <th>ID</th>
                    <th>Categoría</th>
                    <th colspan="2">
                        <a href="formAgregarCategoria.php" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-plus-square"> </i>
                            Agregar
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
<?php
    while( $categoria = mysqli_fetch_assoc( $categorias )) {
?>
                <tr>
                    <td><?= $categoria['idCategoria'] ?></td>
                    <td><?= $categoria['catNombre'] ?></td>
                    <td>
                        <a href="formModificarCategoria.php?idCategoria=<?= $categoria['idCategoria']?>" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-pencil-square"> </i>
                            Modificar
                        </a>
                    </td>
                    <td>
                        <a href="formEliminarCategoria.php?idCategoria=<?= $categoria['idCategoria']?>" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-dash-square"> </i>
                            Eliminar
                        </a>
                    </td>
                </tr>
<?php
        }
?>
            </tbody>
        </table>

        <a href="admin.php" class="btn btn-outline-secondary btn-sm my-2">
            <i class="bi bi-chevron-left"></i>
            Volver a dashboard
        </a>

    </main>

<?php  include 'layout/footer.php';  ?>