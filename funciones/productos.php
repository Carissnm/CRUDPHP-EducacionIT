<?php

    /*
     * 1.- nos conectamos a mysql
     * 2.- creamos consulta SQL
     * 3.- ejecutamos SQL
     * 4.- muestreo de datos
     */

#############################################
#### CRUD de productos ############################

function listarProductos() : mysqli_result | false {
    $link = connect();
    $sql = "SELECT idProducto, prdNombre, prdPrecio, prdDescripcion, prdImagen, mkNombre, catNombre
                FROM productos
                INNER JOIN marcas ON productos.idMarca = marcas.idMarca
                INNER JOIN categorias ON productos.idCategoria = categorias.idCategoria";
    
    try {
        $resultado = mysqli_query( $link,$sql );
        return $resultado;
    } 
    catch ( Exception $e ) {
        echo $e -> getMessage();
        return false;
    }
}

function verProductoPorId($idProducto) : array | false {
    $link = connect();
    $sql = "SELECT prdImagen,
                productos.idMarca,
                productos.idCategoria,
                mkNombre,
                catNombre, 
                idProducto, 
                prdPrecio, prdNombre, prdDescripcion FROM productos
                INNER JOIN marcas ON marcas.idMarca = productos.idMarca
                INNER JOIN categorias ON categorias.idCategoria = productos.idCategoria
                WHERE idProducto = ".$idProducto;

    try {
        $resultado = mysqli_query( $link, $sql ); // devuelve un mysql_result
        $producto = mysqli_fetch_assoc( $resultado ); // transformo el mysql_result en un array asociativo
        return $producto; 
    }
    catch ( Exception $e ) {
        return false;   
    }
}

function modificarProducto() : bool {
    $idProducto = $_POST['idProducto'];
    $prdNombre = $_POST['prdNombre'];
    $prdPrecio = $_POST['prdPrecio'];
    $idMarca = $_POST['idMarca'];
    $idCategoria = $_POST['idCategoria'];
    $prdDescripcion = $_POST['prdDescripcion'];
    $prdImagen = subirImagen();
    $link = connect();
    $sql = "UPDATE productos
                SET prdNombre = '".$prdNombre."',
                prdPrecio = ".$prdPrecio.",
                idCategoria = ".$idCategoria.",
                idMarca = ".$idMarca.",
                prdImagen = '".$prdImagen."',
                prdDescripcion = '".$prdDescripcion."'
                WHERE idProducto = ".$idProducto;
    
    try {
        
        $resultado = mysqli_query( $link, $sql );
        return $resultado;
    }
    catch ( Exception $e ) {
        return false;
    }
}

function eliminarProducto() : bool {
    $idProducto = $_POST['idProducto'];
    $link = connect();
    $sql = "DELETE FROM productos
                WHERE idProducto = ".$idProducto;
    try {
        $resultado = mysqli_query( $link, $sql );
        return $resultado;
    } 
    catch ( Exception $e ) {
        echo $e->getMessage();
        return false;
    }
    
}

function subirImagen() : string {
    //si no enviaron archivo al agregar producto
    $prdImagen = 'noDisponible.png';

    // si no enviaron para modificar
    if ( isset( $_POST['imgActual'])) {
        $prdImagen = $_POST['imgActual'];
    }
    //si enviaron archivo
    if ( $_FILES['prdImagen']['error'] == 0 ) {
        // primero renombramos : 12354306.ext
        //unix timestamp => tiempo actual expresado en milisegundos desde 01/01/1970
        $time = time();
        // ahora necesito la extensión de la imagen
        $ext = pathinfo(
            $_FILES['prdImagen']['name'],
            PATHINFO_EXTENSION
        );
        $prdImagen = $time.'.'.$ext;

        // ahora subo el archivo:
        
        move_uploaded_file( 
            $_FILES['prdImagen']['tmp_name'],
            'productos/'.$prdImagen
        ); // toma el nombre temporal en el primer parámetro, y la dirección donde quiero que ingreseel archivo. Si pongo barra me va a tirar error porque no existe el directorio.
    }

    return $prdImagen;
}

function agregarProducto() : bool {
    $prdNombre = $_POST['prdNombre'];
    $idMarca = $_POST['idMarca'];
    $idCategoria = $_POST['idCategoria'];
    $prdImagen = subirImagen();
    $prdPrecio = $_POST['prdPrecio'];
    $prdDescripcion = $_POST['prdDescripcion'];

    $link = connect();
    $sql = "INSERT INTO productos
                (prdNombre, idMarca, idCategoria, prdImagen, prdPrecio, prdDescripcion, prdActivo)
                VALUES
                ('".$prdNombre."',
                ".$idMarca.",
                '".$idCategoria."',
                '".$prdImagen."',
                ".$prdPrecio.",
                '".$prdDescripcion."',
                true)";
    try {
        $resultado = mysqli_query( $link, $sql );
        return $resultado;
    } 
    catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}