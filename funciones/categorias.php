<?php
    /*
     * 1.- nos conectamos a mysql
     * 2.- creamos consulta SQL
     * 3.- ejecutamos SQL
     * 4.- muestreo de datos
     */

#############################################
#### CRUD de marcas ############################

function listaCategorias() : mysqli_result | false {
    $link = connect();
    $sql = "SELECT idCategoria, catNombre
                FROM categorias";
    try {
        $resultado = mysqli_query( $link, $sql );
        return $resultado;
    } 
    catch ( Exception $e ) {
        echo $e -> getMessage();
        return false;
    }
}

function agregarCategoria() : bool {
    $catNombre = $_POST['catNombre'];
    $link = connect();
    $sql = "INSERT INTO categorias (catNombre)
                VALUE
                ('".$catNombre."')";
    try {
        $resultado = mysqli_query( $link, $sql );
        return $resultado;
    }
    catch ( Exception $e ) {
        echo $e -> getMessage();
        return false;
    }
}

function modificarCategoria() : mysqli_result | bool {
    $idCategoria = $_POST['idCategoria'];
    $catNombre = $_POST['catNombre'];
    $link = connect();
    $sql = "UPDATE categorias
                SET catNombre = '".$catNombre."'WHERE idCategoria = ".$idCategoria;
    
    try {
        $resultado = mysqli_query( $link, $sql );
        return $resultado;
    }
    catch ( Exception $e ) {
        echo $e->getMessage();
        return false;
    }
}


function verCategoriaPorId($idCategoria) : array | false {
    $link = connect();
    $sql = "SELECT catNombre, idCategoria FROM categorias
                WHERE idCategoria = ".$idCategoria;

    try {
        $resultado = mysqli_query( $link, $sql );
        $categoria = mysqli_fetch_assoc( $resultado );
        return $categoria;
    }
    catch ( Exception $e ) {
        return false;   
    }
}

//DELETE
//Primero chequeo que no haya productos dentro de esa categoría:

function checkProductoPorCategoria() : int {
    $idCategoria = $_GET['idCategoria'];
    $link = connect();
    $sql = "SELECT 1
                FROM productos 
                WHERE idCategoria = ".$idCategoria;

    /*$sql2 = "SELECT COUNT(idProducto) as n 
                FROM productos
                WHERE idCategoria = ".$idCategoria;*/
    try {
        $resultado = mysqli_query( $link, $sql );
        $cantidad = mysqli_num_rows( $resultado ); 
    /*$resultado = mysqli_query( $link, $sql2 );
    $cantidad = mysqli_fetch_assoc( $resultado );*/
    }
    catch ( Exception $e ) {
        echo $e->getMessage(); // en realidad debería hacerse un log o bbdd de errores en producción
    }
    
    return $cantidad;

}

function eliminarCategoria() : bool {
    $idCategoria = $_POST['idCategoria'];
    $link = connect();
    $sql = "DELETE FROM categorias
                WHERE idCategoria = ".$idCategoria;
    try {
        $resultado = mysqli_query( $link, $sql );
        return $resultado;
    } 
    catch ( Exception $e ) {
        echo $e->getMessage();
        return false;
    }
    
}