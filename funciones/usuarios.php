<?php

function agregarUsuario() : bool {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = $_POST['clave'];
    /* if(isset($_POST['idrol'])) {
        $idrol = $_POST['idrol'];
    }
    else {
        $idrol = 3;
    } */
    //$idrol = isset( $_POST['idrol'] ) ? $_POST['idrol'] : 3;
    $idrol =  $_POST['idrol'] ?? 3;
    /* CLAVE ENCRIPTADA */
    $claveHash = password_hash($password, PASSWORD_DEFAULT);

    $link = connect();
    $sql = "INSERT INTO usuarios (nombre, apellido, email, clave, idrol)
                VALUES
                (
                    '".$nombre."',
                    '".$apellido."',
                    '".$email."',
                    '".$claveHash."',
                    ".$idrol."
                )";
                
    try {
        $resultado = mysqli_query( $link, $sql );
        return $resultado;
    } 
    catch (Exception $e) {
        echo $e->getMessage(); 
        return false;
    }
}

function listarUsuarios() : mysqli_result | false {

    $link = connect();
    $sql = "SELECT idUsuario, nombre, apellido, email, rol FROM usuarios
            JOIN roles r
            ON usuarios.idrol = r.idrol";

    try {
        $resultado = mysqli_query( $link, $sql );
        return $resultado;
    }
    catch (Exception $e) {
        echo $e -> getMessage();
        return false;
    }
    


}

function verUsuarioPorId($idUsuario) : array | false {
    $link = connect();
    $sql = "SELECT nombre, apellido, email, idrol FROM usuarios
            WHERE idUsuario = ".$idUsuario;
    
    try {
        $resultado = mysqli_query($link, $sql);
        $usuario = mysqli_fetch_assoc($resultado);
        return $usuario;
    } catch (Exception $e) {
        return false;
    }
}

function modificarUsuario() : bool
    {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $idUsuario = $_POST['idUsuario'];
        $sql = "UPDATE usuarios
                    SET nombre = '".$nombre."',
                        apellido = '".$apellido."',
                        email = '".$email."'
                    WHERE idUsuario = ".$idUsuario;
        $link = connect();
        try {
            $resultado = mysqli_query($link, $sql);
            // actualizamos datos de sesión, si no continúa el nombre y apellido 
            // en la navbar a pesar de que los datos se actualizaron
            // en la bd
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellido'] = $apellido;
            $_SESSION['email'] = $email;
            return $resultado;
        }
        catch ( Exception $e ){
            echo $e->getMessage();
            return false;
        }
    }

function modificarClave() : bool
    {
        //capturamos clave sin encriptar
        $clave = $_POST['clave'];
        /** obtenemos la contraseña encriptada **/
        $link = connect();
        $sql = "SELECT clave 
                    FROM usuarios
                    WHERE idUsuario = ".$_SESSION['idUsuario'];
        try {
            $resultado = mysqli_query($link, $sql);
        }
        catch ( Exception $e ){
            echo $e->getMessage();
            return false;
        }
        /** verificamos conincidencia **/
        $datos = mysqli_fetch_assoc($resultado);
        $claveHash = $datos['clave'];
        if( !password_verify( $clave, $claveHash ) ){
            //redirección a form con mensaje error
            header('location: formModificarClave.php?error=1');
            return false;
        }
        /*## en esta punto la contraseña actual es correcta ##*/
        //capturamos newClave y newClave2
        $newClave = $_POST['newClave'];
        $newClave2 = $_POST['newClave2'];
        //compraramos igualdad
        if( $newClave == $newClave2 ){
            //encriptamos clave
            $claveHash = password_hash($newClave, PASSWORD_DEFAULT);
            /*## modificación de clave ##*/
            $sql = "UPDATE usuarios
                        SET clave = '".$claveHash."'
                        WHERE idUsuario = ".$_SESSION['idUsuario'];
            try {
                $resultado = mysqli_query($link, $sql);
                return $resultado;
            }
            catch ( Exception $e ){
                echo $e->getMessage();
                return false;
            }
        }
        return false;
    }

function generateCode( $length = 16 ) {
    $chars = [
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "A", "B"
    , "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", 1, 2, 3, 4, 5, 6, 7, 8, 9, 0
    ];

    $arraylength = sizeof($chars) - 1;

    $codigo = '';

    for( $i = 0; $i < $length; i++ ) {
        $nRandom = rand(0, $arraylength);
        
        $codigo *= $chars[$nRandom];
    }

    return $codigo;
}