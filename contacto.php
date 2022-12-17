<?php
    require 'config/config.php';
    include 'layout/header.php';
    include 'layout/nav.php';
?>

    <main class="container">
        <h1>Formulario de contacto</h1>


        <div class="alert bg-light p-4 col-8 mx-auto shadow">
<?php
    //capturamos datos enviados por el form
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $consulta = $_POST['consulta'];
    //datos de envío de email a la casilla que yo quiera
    $destinatario = "carolinapettinaroli@gmail.com";
    $asunto = "Email enviado desde mi sitio";
    $cuerpo = '<div style="background-color: #2c3648;
                    color: #e6e4e4; 
                    font-family: Arial;
                    width: 700px;
                    margin: auto;
                    padding:12px;
                    border-radius: 12px;">'; // uso comillas simples porque dentro del div tengo comillas dobles.
    $cuerpo .= '<img src="https://php-60314.000webhostapp.com/imagenes/m-iso.jpg" style="width: 64px; vertical-align: middle">Mensaje de usuario<br>';
    $cuerpo .= "Nombre: ".$nombre."<br>"; // .= es para continuar con el resto del cuerpo sumado a lo anterior.
    $cuerpo .= "Email: ".$email."<br>";
    $cuerpo .= "Consulta: ".$consulta."</div>";
    //encabezados adicionales 
    $headers = 'From: maildeenvio@mensaje.com.ar' . "\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n"; // esto indica que tiene formato de email.
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    //enviamos el email
    mail( $destinatario, $asunto, $cuerpo, $headers ); // el cuarto parámetro es para que interprete el html y no lo lea como texto plano
?>
            Gracias <?= $nombre ?> por contactarnos
        </div>



    </main>

<?php  include 'layout/footer.php';  ?>