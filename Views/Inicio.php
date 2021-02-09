<?php
    include('../database/DB_savelinks.php');

    if (isset($_POST['Btn_Inicio'])) {
        $User=$_POST['usuario'];
        $Password=$_POST['password'];

        $Catch=new Base_Datos();
        $ConsultaSQL="SELECT Usuario,Password FROM registro WHERE Usuario='$User'";
        $BuscarData=$Catch->BuscarDatos($ConsultaSQL);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/StyleIniciarSession.css">
    <title>Inico de sesion</title>
</head>
<body>
    <div class="Cnt_InicioSesion">
        <div class="Form">
            <form method="POST" id="Form">
                <h2>iniciar sesion</h2>
                <?php if(isset($_POST['Btn_Inicio'])) {?>
                   <?php if($BuscarData) {?>
                        <?php foreach($BuscarData as $Datos): ?>
                            <?php if($Password==$Datos['Password'] && $User==$Datos['Usuario']) {?>
                                <?php header("location:Index.php") ?>
                            <?php } 
                            else {?>
                                <p class="form_p--error" id='password_incorrecta'>Contraseña incorrecta</p>
                            <?php } ?>
                        <?php endforeach ?>
                   <?php } 
                   else { ?>
                        <p class="form_p--error" id="usuario_no--resgitrado">Este Usuario no existe</p>
                   <?php } ?>
                <?php  } ?>
                <div class="InputBox" id='form_group--usuario'>
                    <input type="text" placeholder="Usuario" id="EmailLG" name="usuario" class="loca" required>
                    <i class="Formulario_icono--estado fas fa-exclamation-circle" id="icon"></i>
                    <p class="Text-Error" id="Text-Error">El usuario debe de terner de 4 a 16 caracteres</p>
                </div>
                <div class="InputBox">
                    <input type="password" placeholder="Tu contraseña" id="PasswordLG" name="password" class="loca" required>
                    <i class="Formulario_icono--estado fas fa-exclamation-circle" id="ico"></i>
                    <p class="Text-Error" id="Text-Erro">La contraseña debe tener de 4 a 12 Caracteres</p>
                </div>
                <div class="InputBox">
                    <input type="submit" value="Iniciar" id="InicioseSion" name="Btn_Inicio">
                </div>
                <p class="Forget">Olvido la contraseña o usuario?<a href="RecuperarCuenta.php">Click!</a></p>
                <p class="Forget">No tiene una cuenta?<a href="Registro.php">Registrate!</a></p>
            </form>
        </div>
    </div>
    <footer>
        <script src="../Javascript/ScriptLogin.js"></script>
        <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    </footer>
</body>
</html>