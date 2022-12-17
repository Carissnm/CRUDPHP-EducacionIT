<?php

    function listarRoles()
    {
        $link = connect();
        $sql = "SELECT idrol, rol
                    FROM roles";
        try{
            $resultado = mysqli_query($link, $sql);
            return $resultado;
        }
        catch ( Exception $e ){
            echo $e->getMessage();
            return false;
        }
    }

