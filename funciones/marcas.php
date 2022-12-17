<?php
/*
     * 1.- nos conectamos a mysql
     * 2.- creamos consulta SQL
     * 3.- ejecutamos SQL
     * 4.- muestreo de datos
     */

#############################################
#### CRUD de marcas ############################

function listarMarcas() : mysqli_result | false {
    $link = connect();
    $sql = "SELECT idMarca, mkNombre
                FROM marcas";
    try {
        $resultado = mysqli_query( $link, $sql );
        return $resultado;
    }
    catch ( Exception $e ) {
        echo $e -> getMessage();
        return false;
    }
    
}

function agregarMarca() : bool {
    $mkNombre = $_POST['mkNombre'];
    $link = connect();
    $sql = "INSERT INTO marcas
                (mkNombre)
                VALUE
                ('".$mkNombre."')";
    try {
        $resultado = mysqli_query( $link, $sql );
        return $resultado;
    } 
    catch (Exception $e) {
        return false;
    }
}
// mysqli_result sólo se retorna en consultas de tipo select
function modificarMarca() : bool {
    $idMarca = $_POST['idMarca'];
    $mkNombre = $_POST['mkNombre'];
    $link = connect();
    $sql = "UPDATE marcas
                SET mkNombre = '".$mkNombre."'
                WHERE idMarca = ".$idMarca;
    
    try {
        $resultado = mysqli_query( $link, $sql );
        return $resultado;
    }
    catch ( Exception $e ) {
        return false;
    }
}


function verMarcaPorId($idMarca) : array | false {
    $link = connect();
    $sql = "SELECT mkNombre, idMarca FROM marcas
                WHERE idMarca = ".$idMarca;

    try {
        $resultado = mysqli_query( $link, $sql );
        $marca = mysqli_fetch_assoc( $resultado );
        return $marca;
    }
    catch ( Exception $e ) {
        return false;   
    }
}

function checkProductoPorMarca() : int {
    $idMarca = $_GET['idMarca'];
    $link = connect();
    $sql = "SELECT 1
                FROM productos 
                WHERE idMarca = ".$idMarca;

    /*$sql2 = "SELECT COUNT(idProducto) as n 
                FROM productos
                WHERE idMarca = ".$idMarca;*/
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

function eliminarMarca() : bool {
    $idMarca = $_POST['idMarca'];
    $link = connect();
    $sql = "DELETE FROM marcas
                WHERE idMarca = ".$idMarca;
    try {
        $resultado = mysqli_query( $link, $sql );
        return $resultado;
    } 
    catch ( Exception $e ) {
        echo $e->getMessage();
        return false;
    }
    
}