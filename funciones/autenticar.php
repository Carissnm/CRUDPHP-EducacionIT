<?php

    /* Rutinas de autenticación */
    function login()
    {
        $email = $_POST['email'];
        $clave = $_POST['clave'];//sin encriptar
        $link = connect();
        $sql = "SELECT idUsuario, nombre, apellido, 
                        email, clave, idrol
                    FROM usuarios 
                    WHERE email = '".$email."'";
        try {
            $resultado = mysqli_query( $link, $sql );
            $cantidad = mysqli_num_rows($resultado);
        }catch ( Exception $e ){
            return false;
        }
        /*
         *  ## si cantidad == 0  -> no existe usuario
         *  ## si cantidad == 1  -> usuario ok (existe)
         * */
        if( $cantidad == 0 ){
            //redirección a formLogin.php
            header('location: formLogin.php?error=1'); // la función header redirecciona.
            // se le aclara location y dónde lo voy a mandar.
            return false;
        }


        /*
         * ## Rutina de autenticación
         *    sesiones
         * */

        $datosUsuario = mysqli_fetch_assoc($resultado);
        // verifico primero que la clave coincida con la hasheada (password_verify usa com parámetros primero la clave ingresada y luego la hasheada)
        if( password_verify( $clave , $datosUsuario['clave'] ) ) {
            $_SESSION['login'] = 1; // token
            $_SESSION['idUsuario'] = $datosUsuario['idUsuario'];
            $_SESSION['nombre'] = $datosUsuario['nombre'];
            $_SESSION['apellido'] = $datosUsuario['apellido'];
            $_SESSION['email'] = $datosUsuario['email'];
            $_SESSION['idrol'] = $datosUsuario['idrol'];
            //redirección a admin
            header('location: admin.php');
            return true; // hago un corte. tmb podría poner un else.
        }

        // si llega hasta acá puso mal la password
        header('location: formLogin.php?error=1');

        

    }

    function logout()
    {   
        session_unset();
        session_destroy();
        
    }

    function autenticar()
    {
        if( !isset($_SESSION['login']) ) {
            // redireccion a formLogin
            header('location: formLogin.php?error=2');
        }
    }

    function noAdmin() : void
    {
        if( $_SESSION['idrol'] != 1 ){
            //redirección a noAdmin.php
            header('location: noAdmin.php');
        }
    }