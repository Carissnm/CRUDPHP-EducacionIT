<?php
    require 'config/config.php';
    require 'funciones/conexion.php';
    require 'funciones/marcas.php';
    require 'funciones/categorias.php';
    require 'funciones/autenticar.php';
    autenticar();
    $marcas = listarMarcas();
    $categorias = listaCategorias();
    include 'layout/header.php';
    include 'layout/nav.php';
?>

    <main class="container">
        <h1>Alta de un producto</h1>

        <div class="alert bg-light p-4 col-8 mx-auto shadow">
            <form action="agregarProducto.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="prdNombre">Nombre del producto</label>
                    <input type="text" name="prdNombre"
                            class="form-control" id="prdNombre" required><br>
                    <label for="idCategoria">Marca</label>
                    <select name="idMarca" id="idMarca">
                        <option value="">-------</option>
                    <?php 
                        while( $marca = mysqli_fetch_assoc( $marcas )) {
                    ?>
                        <option name="idMarca" value="<?= $marca['idMarca'] ?>"><?= $marca['mkNombre'] ?></option>
                    <?php
                        }
                    ?>
                    </select><br>
                    <label for="idCategoria">Categoría</label>
                    <select name="idCategoria" id="idCategoria">
                        <option value="">-------</option>
                    <?php 
                        while( $categoria = mysqli_fetch_assoc( $categorias )) {
                    ?>
                    <option name="idCategoria" value="<?= $categoria['idCategoria'] ?>"><?= $categoria['catNombre'] ?></option>
                    <?php
                        }
                    ?>
                    </select><br>
                    <label for="prdPrecio">Precio</label><br>
                    <input type="text" name="prdPrecio" class="form-control" id="prdPrecio"><br>
                    <div class="form-group mb-4">
                        <label for="prdDescripcion">Descripción del Producto</label>
                        <textarea name="prdDescripcion" class="form-control" id="prdDescripcion" required></textarea>
                    </div>
                    <label for="prdImagen">Imagen</label>
                    <input type="file" name="prdImagen" class="form-control" id="prdImagen"><br>
                </div>

                <button class="btn btn-dark my-3 px-4">Agregar Producto</button>
                <a href="adminProductos.php" class="btn btn-outline-secondary">
                    Volver a panel de productos
                </a>
            </form>
        </div>

    </main>

<?php  include 'layout/footer.php';  ?>