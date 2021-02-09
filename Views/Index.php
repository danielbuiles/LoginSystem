<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/Style.css">
    <title>Login</title>
</head>
<body>
    <header>
    </header>
        <div class="Container">
            <a href="Inicio.php"  class="aInicio"><button id="InicioUsuario">Iniciar sesión</button></a>
            <a class="aRegistro" href="Registro.php"><button id="RegistroUsuario">Registrarse</button></a>
        </div>
    <footer>
        <Script>
            var Nom=document.getElementById("InicioUsuario");
            Nom.addEventListener('click',Click)
            function Click() {
                alert("Hola que tal! siempre es un gusto volover a verte!");
            }
        </Script>
    </footer>
</body>
</html>