<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../modules/PHPMailer-master/src/Exception.php';
    require '../modules/PHPMailer-master/src/PHPMailer.php';
    require '../modules/PHPMailer-master/src/SMTP.php';

    include('../database/DB_savelinks.php');

    if (isset($_POST['btn_Recuperar']))
    {
        $Emaail=$_POST['email'];

        $Catch=new Base_Datos();
        $ConsultaSQL="SELECT Usuario,Password,Email FROM registro WHERE Email='$Emaail'";
        $DatosObtenidos=$Catch->BuscarDatos($ConsultaSQL);

        if ($DatosObtenidos) 
        {
            foreach ($DatosObtenidos as $Datos) {
                $mail = new PHPMailer(true);
                try 
                {                                                                    
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                // Enable SMTP authentication
                    $mail->Username   = 'danielbgar@gmail.com';                     // SMTP username
                    $mail->Password   = 'onKRTZ7d9G';                               // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 587;                                       // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients
                    $mail->setFrom('danielbgar@gmail.com','Daniel');
                    $mail->addAddress($Emaail);     // Add a recipient
                    date_default_timezone_set('America/Bogota');

                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Recuperar Datos Perdidos';
                    $mail->Body    = '<h2>Estas son sus credenciales:</h2></br>'.
                    '<h3>Usuario:'.$Datos['Usuario'].'</h3></br>'.
                    '<h3>Password:'.$Datos['Password'].'</h3></br></br></br>'.
                    '<h6>Pagina 100% segura</h6>';
                    $mail->AltBody = 'Gracias por usar mi pagina';
                    $mail->send();

                    echo '';

                }
                catch (Exception $e) 
                {
                    echo "Error al enviar mensaje: {$mail->ErrorInfo}";
                }
            }

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/StyleRecuperarCounts.css">
    <title>Recuperar cuenta!</title>
</head>
<body>
    <form method="POST">
        <?php if(isset($_POST['btn_Recuperar'])) { ?>
            <?php if($DatosObtenidos) { ?>
                <p class="Datos_Encontrados">Revise Su Correo</p>
                <script>
                    var clase = document.getElementById('RecuperaDatos');
                </script>
            <?php }
            else { ?>
            <p class="Datos_Perdidos">Email No Registrado</p>
            <script>
                var clase = document.getElementById('RecuperaDatos');
            </script>
            <?php } ?>
        <?php } ?>
        <a class="Btn" onclick="popupToggle()" id="RecuperaDatos">Recuperar Datos!</a>
        <div id="popup">
            <div class="content">
                <img src="../Img/mail.png">
                <h2>Recuperar Cuenta!</h2>
                <p>Si ha perodido el usuario o contraseña de su cuenta no
                    se preocup,e mi web hecha con php tiene sus credenciales.</p>
                    <div class="inputbox">
                        <input type="email" placeholder="Escribe tu Email." name="email">
                    </div>
                    <div class="inputbox">
                        <input type="submit" value="Enviar!" class="Btn" name="btn_Recuperar">
                    </div>
            </div>
            <a href="" class="close"><img src="../Img/cancel.png"></a>
        </div>
        <br><br>
            <a href="inicio.php" class=""><p><<<<</p></a>
        <script>
            function popupToggle(){
                const popup = document.getElementById('popup');
                popup.classList.toggle('active');
            }
        </script>
    </form>
    <footer>
    <!-- JavaScript Bundle with Popper -->
    </footer>
</body>
</html>
