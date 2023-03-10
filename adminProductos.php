<?php

    require 'config/config.php';
    require 'funciones/conexion.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    autenticar();
	include 'layout/header.php';
	include 'layout/nav.php';

    $productos = listarProductos();
?>

    <main class="container">
        <h1>Panel de administración de productos</h1>

        <a href="admin.php" class="btn btn-outline-secondary my-2">
            Volver a dashboard
        </a>
        <table class="table table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Marca</th>
                    <th>Categoria</th>
                    <th colspan="2">
                        <a href="formAgregarProducto.php" class="btn btn-outline-secondary">
                            Agregar
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
<?php
    while ( $producto = mysqli_fetch_assoc( $productos )) {
?>            
                <tr>
                    <td><img class="imagen_producto" src="productos/<?= $producto['prdImagen']?>"></td>
                    <td><?= $producto['prdNombre']?></td>
                    <td>$<?= $producto['prdPrecio']?></td>
                    <td><?= $producto['mkNombre']?></td>
                    <td><?= $producto['catNombre']?></td>
                    <td>
                        <a href="formModificarProducto.php?idProducto=<?= $producto['idProducto'] ?>" class="btn btn-outline-secondary">
                            Modificar
                        </a>
                    </td>
                    <td>
                        <a href="formEliminarProducto.php?idProducto=<?= $producto['idProducto'] ?>" class="btn btn-outline-secondary">
                            Eliminar
                        </a>
                    </td>
                </tr>
<?php
    }
?>
            </tbody>
        </table>

        <a href="admin.php" class="btn btn-outline-secondary my-2">
            Volver a dashboard
        </a>

    </main>

<?php  include 'layout/footer.php';  ?>