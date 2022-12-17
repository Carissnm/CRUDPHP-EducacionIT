<?php
    require 'config/config.php';
    include 'layout/header.php';
    include 'layout/nav.php';
?>

    <main class="container">
        <h1>Alta de una categoría</h1>

        <div class="alert bg-light p-4 col-8 mx-auto shadow">
            <form action="agregarCategoria.php" method="post">
                <div class="form-group">
                    <label for="catNombre">Nombre de la Categoría</label>
                    <input type="text" name="catNombre"
                            class="form-control" id="catNombre" required>
                </div>

                <button class="btn btn-dark my-3 px-4">Agregar categoría</button>
                <a href="adminCategorias.php" class="btn btn-outline-secondary">
                    Volver a panel de categorías
                </a>
            </form>
        </div>

    </main>

<?php  include 'layout/footer.php';  ?>