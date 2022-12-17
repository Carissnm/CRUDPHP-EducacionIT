<?php

/*

Si al exportar la bd surge un error hay que reemplazar
mysqldump.exe en xampp -clase 16

DATOS FTP:
ftp = file transfer protocol
server: files.000webhost.com
user: tpphppettinaroli
password: 6c#rVswmw)$MhFcNZ7o) 

DATOS BD REMOTO:
db name: id20014637_catalogo
db username: id20014637_caris
db password: Ti+oJ@]il<<Rt2\4
*/

    require 'config/config.php';
    require 'funciones/autenticar.php';
    autenticar();
    include 'layout/header.php';
    include 'layout/nav.php';
?>

    <main class="container">
        <h1>Dashboard</h1>

        <div class="list-group">
            <a href="adminMarcas.php" class="list-group-item list-group-item-action">
                Panel de administración de marcas.
            </a>
            <a href="adminCategorias.php" class="list-group-item list-group-item-action">
                Panel de administración de categorías.
            </a>
            <a href="adminProductos.php" class="list-group-item list-group-item-action">
                Panel de administración de productos.
            </a>
            <a href="adminUsuarios.php" class="list-group-item list-group-item-action">
                Panel de administración de usuarios.
            </a>
        </div>

    </main>

<?php  include 'layout/footer.php';  ?>