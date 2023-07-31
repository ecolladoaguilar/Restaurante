<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
</head>

<body align="center">

<a href = "platos.php">volver a la página</a>

<section>

<?php

session_start();

//si carro está vacío
if(empty($_SESSION)){
    echo 'Tu carrito está vacío.<br>';}
else{
    echo 'Los siguientes platos han sido añadidos al carrito: <br>';}

//quitamos la variable de sesión
if($_SESSION['n'] = $_REQUEST['n'] ?? $_SESSION['n']){
    $nombre = $_SESSION['n'];
    unset($_SESSION['n']);
}

//abrir documento para generar ticket y guardar la ruta
$file = fopen('ticket.txt','a');
$dir = __DIR__ . '/' . $file;

//pedidos
$clv=array_keys($_SESSION);
$val=array_values($_SESSION);

$pedidos = array();

$base = 't5';
$bd = new PDO("mysql:dbname=$base;host=localhost", 'root', '');

for($i=0;$i<count($_SESSION);$i++){
    $plato=$clv[$i];
    $cantidad=$val[$i];
    echo "$plato: $cantidad unidades.";

        //añadir información al ticket
        fputs($file,"nombre $nombre");
        fputs($file,"\n");
        fputs($file,"pedido: $plato");
        fputs($file, " cantidad: $cantidad");
        fputs($file,"\n");

    array_push($pedidos, $nombre, $plato, $cantidad, $dir);
}

//var_dump($pedidos);
$cuenta=count($pedidos);
//echo $cuenta;

//registrarlo en la base de datos
$tabla1 = 'pedidos';

if($cuenta === 8){
$pedido = $bd->prepare("insert into $tabla1(nombre,plato,cantidad,ticket,fecha)
            values (?,?,?,?, NOW()), (?,?,?,?, NOW())");
$pedido->execute($pedidos);
}
if($cuenta === 4){
    $pedido = $bd->prepare("insert into $tabla1(nombre,plato,cantidad,ticket,fecha)
                values (?,?,?,?, NOW())");
    $pedido->execute($pedidos);
}

session_destroy();

?>

</section>

</body>
</html>