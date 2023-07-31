<?php

if(empty($_REQUEST)){
    header("location:carrito.php");
    die;}

session_start();
//quitar sesiones
unset($_REQUEST['añadir']);


$clv=array_keys($_REQUEST);
$val=array_values($_REQUEST);

for($i=0;$i<count($clv);$i++){
    if(!empty($val[$i])){
        $clave="Plato ".$clv[$i];
        if(isset($_SESSION[$clave])){
            $_SESSION[$clave]+=$val[$i];}
        else{
            $_SESSION[$clave]=$val[$i];}}}
    
header("location:carrito.php");