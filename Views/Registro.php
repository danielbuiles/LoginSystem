<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../modules/PHPMailer-master/src/Exception.php';
	require '../modules/PHPMailer-master/src/PHPMailer.php';
	require '../modules/PHPMailer-master/src/SMTP.php';

    include("../database/DB_savelinks.php");

    if (isset($_POST["Btn_Registrar"])) 
    {
       $User=$_POST['usuario'];
	   $Nombre=$_POST['nombre'];
	   $Password=$_POST['password'];
	   $Email=$_POST['correo'];
       $Telefono=$_POST['telefono'];
	   $Hash=password_hash($Password,PASSWORD_DEFAULT);

		$Catch=new Base_Datos();
		$Consulta_User_Existente="SELECT Usuario,Email FROM registro WHERE Usuario='$User'";
		$Consulta_Email_Existente="SELECT Usuario,Email FROM registro WHERE Email='$Email'";
		$Buscar_User_Existente=$Catch->BuscarDatos($Consulta_User_Existente);
		$Buscar_Email_Existente=$Catch->BuscarDatos($Consulta_Email_Existente);

		if ($Buscar_User_Existente || $Buscar_Email_Existente) 
		{
			//Si el usuario existe blc pagina
		}
		else 
		{
			$ConsultaSQL="INSERT INTO registro(Usuario,Nombre,Password,Password_Cript,Email,Telefono) VALUES ('$User','$Nombre','$Password','$Hash','$Email','$Telefono')";
			$InsertDatos=$Catch->RegistrarUsuarioDB($ConsultaSQL);

			$mail = new PHPMailer(true);
			date_default_timezone_set('America/Bogota');
			try 
			{  
				//Server settings
				$mail->isSMTP();                                            // Send using SMTP
				$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                // Enable SMTP authentication
				$mail->Username   = 'danielbgar@gmail.com';                     // SMTP username
				$mail->Password   = 'onKRTZ7d9G';                               // SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS` encouraged
				$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

				//Recipients
				$mail->setFrom('danielbgar@gmail.com', 'Daniel');
				$mail->addAddress($Email);     // Add a recipient
				date_default_timezone_set('America/Bogota');
				
				// Content
				$mail->isHTML(true);                                 // Set email format to HTML
				$mail->Subject = 'Registrado con Exito!!';
				$mail->Body    = '<h2>Usted se ha registrado con exito en mi Web el '.date('d').'/'.date('m').'/'.date('o').'</h2>'.'</br>'.
				'<h2>'.'Su Clave Encriptada es:'.$Hash.'</h2>'.'</br>'.
				'<h3>usted esta seguro con sus credenciales en mi pagina ;D</h3>';
				$mail->send();
				echo '';
			} catch (Exception $e) 
			{
				echo "error al enviar mensaje: {$mail->ErrorInfo}";
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Daniel Web</title>
	<link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="../css/StyleRegistros.css">
</head>
<body>
	<main>
		<form method="POST" class="formulario" id="formulario">
			<!-- Grupo: Usuario -->
			<div class="formulario__grupo" id="grupo__usuario">
				<label for="usuario" class="formulario__label">Usuario</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="usuario" id="usuario" placeholder="john123" required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<?php if(isset($_POST['Btn_Registrar'])) {?>
					<?php if($Buscar_User_Existente) {?>
						<p class="User-Mail_Exist">Usuario Existente!</p>
					<?php } ?>
				<?php } ?>
				<p class="formulario__input-error">El usuario tiene que ser de 4 a 16 dígitos y solo puede contener numeros, letras y guion bajo.</p>
			</div>

			<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__nombre">
				<label for="nombre" class="formulario__label">Nombre</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="John Doe" required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El usuario tiene que ser de 4 a 16 dígitos y solo puede contener numeros, letras y guion bajo.</p>
			</div>

			<!-- Grupo: Contraseña -->
			<div class="formulario__grupo" id="grupo__password">
				<label for="password" class="formulario__label">Contraseña</label>
				<div class="formulario__grupo-input">
					<input type="password" class="formulario__input" name="password" id="password" required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 dígitos.</p>
			</div>

			<!-- Grupo: Contraseña 2 -->
			<div class="formulario__grupo" id="grupo__password2">
				<label for="password2" class="formulario__label">Repetir Contraseña</label>
				<div class="formulario__grupo-input">
					<input type="password" class="formulario__input" name="password2" id="password2" required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
			</div>

			<!-- Grupo: Correo Electronico -->
			<div class="formulario__grupo" id="grupo__correo">
				<label for="correo" class="formulario__label">Correo Electrónico</label>
				<div class="formulario__grupo-input">
					<input type="email" class="formulario__input" name="correo" id="correo" placeholder="correo@correo.com" required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<?php if(isset($_POST['Btn_Registrar'])) {?>
					<?php if($Buscar_Email_Existente) {?>
						<p class="User-Mail_Exist">Email Existente!</p>
					<?php } ?>
				<?php } ?>
				<p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos, guiones y guion bajo.</p>
			</div>

			<!-- Grupo: Teléfono -->
			<div class="formulario__grupo" id="grupo__telefono">
				<label for="telefono" class="formulario__label">Teléfono</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="telefono" id="telefono" placeholder="4491234567" required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El telefono solo puede contener numeros y el maximo son 14 dígitos.</p>
			</div>

			<!-- Grupo: Terminos y Condiciones -->
			<div class="formulario__grupo" id="grupo__terminos">
				<label class="formulario__label">
					<input class="formulario__checkbox" type="checkbox" name="terminos" id="terminos" required>
					Acepto los Terminos y Condiciones
				</label>
			</div>

			<div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
			</div>

			<div class="formulario__grupo formulario__grupo-btn-enviar">
				<input type="submit" class="formulario__btn" name="Btn_Registrar">
				<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Registrado exitosamente!</p>
            </div>
            <p class="Forget">tiene una cuenta?<a href="inicio.php">Ingresa!</a></p>
		</form>
	</main>

	<script src="../Javascript/ScriptRegistro.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</body>
</html>