<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>

<body align="center">

    <h2>
        <font color="red">Registro:</font>
    </h2>

    <form method="post">

        Nombre de usuario: <input type="text" name="n" minlength="5" maxlength="10" required><br>
        Contraseña: <input type="password" name="psswd" id="psswd" minlength="4" maxlength="16" required><br>
        Repite contraseña: <input type="password" name="psswd2" id="psswd2" minlength="4" maxlength="16" required><br>
        Correo: <input type="text" name="c" required><br>

        <input type="submit" name="ok" value="Enviar">

    </form>
    <a href='inicio.php'>Inicio de sesión.</a>
    <br><br>

    <?php
$bd = new PDO("mysql:dbname=t5;host=localhost", 'root', '');

if (!isset($_REQUEST['ok'])) {
    die;
}

//nombre de usuario
$nombre = $_REQUEST['n'];
if (!preg_match('/^(?=\w*[A-Z])(?=\w*[a-z])(?=\w*[0-9])(?=\w*\d)^/', $_REQUEST['n'])) {
    $nom = true;
} else {
    echo "El nombre no puede ser ese<br>";
}

//contraseña
if (!preg_match('/^(?=\w*[A-Z])(?=\w*[a-z])(?=\w*[0-9])(?=\w*\d)^/', $_REQUEST['psswd'])) {
    $con = true;
} else {
    echo "Pruebe otra contraseña<br>";
}

//repeticion contraseña
$contra1 = $_REQUEST['psswd'];
$contra2 = $_REQUEST['psswd2'];

if ($contra1 != $contra2) {
    echo "Las contraseñas no coinciden";
} else {
    $con2 = true;
}

//correo
if (!preg_match('/^(?=\w*[@])^/', $_REQUEST['c'])) {
    echo "No contiene la @";
} else {
    $cor = true;
}

$preparada = $bd->prepare("insert into usuarios(nombre,contraseña,correo) values(?,?,?)");
$preparada->execute(array($_REQUEST['n'], $_REQUEST['psswd'], $_REQUEST['c']));

echo "Se ha creado su usuario";
?>
</body>

</html>