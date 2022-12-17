<?php
    const SERVER = 'localhost';
    const USER = 'id20014637_caris'; //'root';
    const PASSWORD = 'Ti+oJ@]il<<Rt2\4'; // '';
    const BASE = 'id20014637_catalogo'; // 'catalogo2022'; 

/*   const USER = 'root';
    const PASSWORD = '';
    CONST BASE = 'catalogo2022';*/

    function connect() : mysqli | false {
        $link = mysqli_connect(
            hostname: SERVER,
            username: USER,
            password: PASSWORD,
            database: BASE
        );
        return $link;
    }