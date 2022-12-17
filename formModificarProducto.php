<?php
    require 'config/config.php';
    require 'funciones/conexion.php';
    require 'funciones/marcas.php';
    require 'funciones/categorias.php';
    require 'funciones/productos.php';
    require 'funciones/autenticar.php';
    autenticar();
    $marcas = listarMarcas();
    $categorias = listaCategorias();
    $producto = verProductoPorId($_GET['idProducto']);
    include 'layout/header.php';
    include 'layout/nav.php';
?>

    <main class="container">
        <h1>Modificación de un producto</h1>

        <div class="alert bg-light p-4 col-8 mx-auto shadow">
            <form action="modificarProducto.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="prdNombre">Nombre del producto</label>
                    <input type="text" name="prdNombre" value="<?= $producto['prdNombre']?>" 
                            class="form-control" id="prdNombre" required><br>
                    <label for="idCategoria">Marca</label>
                    <select name="idMarca" id="idMarca" required>
                        <option value="">-------</option>
                    <?php 
                        while( $marca = mysqli_fetch_assoc( $marcas )) {
                            $selected = '';
                            if ( $marca['idMarca'] == $producto['idProducto'] ) { $selected = 'selected';}
                    ?>
                        <option <?= $selected ?> name="idMarca" value="<?= $marca['idMarca'] ?>"><?= $marca['mkNombre'] ?></option>
                    <?php
                        }
                    ?>
                    </select><br>
                    <label for="idCategoria">Categoría</label>
                    <select name="idCategoria" id="idCategoria" required>
                        <option value="">-------</option>
                    <?php 
                        while( $categoria = mysqli_fetch_assoc( $categorias )) {
                    ?>
                    <option <?= ( $categoria['idCategoria'] == $producto['idCategoria']) ? 'selected' : '' ?> name="idCategoria" value="<?= $categoria['idCategoria'] ?>"><?= $categoria['catNombre'] ?></option>
                    <?php
                        }
                    ?>
                    </select><br>
                    <label for="prdPrecio">Precio</label><br>
                    <input type="text" name="prdPrecio" class="form-control" id="prdPrecio" value="<?= $producto['prdPrecio']?>"><br>
                    <div class="form-group mb-4">
                        <label for="prdDescripcion">Descripción del Producto</label>
                        <textarea name="prdDescripcion" class="form-control" id="prdDescripcion" 
                        required><?= 
                                $producto['prdDescripcion']
                                ?></textarea>
                    </div>
                    <div class="form-group mb-3">
                    <label for="imgActual">Imagen actual:</label>
                    <img src="productos/<?= $producto['prdImagen'] ?>" class="img-thumbnail" id="img-actual ">
                    </div>
                    <div class="custom-file mt-1 mb-4">
                    Modificar imagen (opcional):
                    <input type="file" name="prdImagen"  class="custom-file-input" id="customFileLang" lang="es">
                    <label class="custom-file-label" for="customFileLang" data-browse="Buscar en disco">Seleccionar Archivo: </label>
                    </div>
                </div>
                <input type="hidden" name="imgActual" value="<?= $producto['prdImagen'] ?>">
                <input type="hidden" name="idProducto" value="<?= $producto['idProducto']?>">
                <button class="btn btn-dark my-3 px-4">Modificar Producto</button>
                <a href="adminProductos.php" class="btn btn-outline-secondary">
                    Volver a panel de productos
                </a>
            </form>
        </div>

    </main>

<?php  include 'layout/footer.php';  ?>