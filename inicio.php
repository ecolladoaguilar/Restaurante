<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>inicio</title>
</head>

<body align="center">

    <h2>
        <font color="red">Inicio de sesion:</font>
    </h2>
    <p> Es necesario acceder a la cuenta para poder acceder a la aplicación </p>

    <form method="post">

        Nombre de usuario: <input type="text" name="n" minlength="5" maxlength="10" required><br>
        Contraseña: <input type="password" name="psswd" id="psswd" minlength="4" maxlength="16" required><br>

        <input type="submit" name="ok" value="Enviar">
        <br>
    </form>

    <a href='registro.php'>Registrarse</a>
    <br><br>

    <?php
session_start();

if (!isset($_REQUEST['ok'])) {
    die;
}

$bd = new PDO("mysql:dbname=t5;host=localhost", 'root', '');
$preparada = $bd->prepare("select nombre,contraseña,correo,codigo from usuarios");
$preparada->execute();

foreach ($preparada as $fila) {
    if ($fila['nombre'] == $_REQUEST['n'] and $fila['contraseña'] == $_REQUEST['psswd']) {
        $_SESSION['n'] = $_REQUEST['n'] ?? $_SESSION['n'];
        header("location:platos.php");
        echo "La sesion es $_SESSION[n]";
        die;
    } else {
        $bol = true;
    }
}

if (!empty($bol == true)) {
    echo "Pruebe a poner otra vez la contraseña";
}

?>

</body>

</html>