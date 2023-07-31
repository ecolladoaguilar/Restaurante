<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>platos</title>
</head>

<body align="center">
    <h1>
        <font color="green">RESTAURANTE</font>
    </h1>
        Categoría de platos:<br>

            <?php
            session_start();
            $base = 't5';
            $tabla = 'platos';
            $bd = new PDO("mysql:dbname=$base;host=localhost", 'root', '');

            //comprobar que se ha iniciado sesión
            if (!isset($_SESSION['n'])) {
                header("location:inicio.php");
            }

            //agrupar por categorías
            $preparada = $bd->prepare("select distinct categoria from platos");
            $preparada->execute();

            foreach($preparada as $fila){
            echo "<font color='purple'><h2>$fila[categoria]<br></h2></font>";
            $eleccion = $fila['categoria'];

            //seleccionar nombre, descripcion y precio de la categoria
            $preparada2 = $bd->prepare("select nombre, descripcion, precio, codigo from platos where categoria=?");
            $preparada2->execute(array($eleccion));
            $cnt = 0;

            echo '<form method="post" action="actualizar_carrito.php">';
            foreach ($preparada2 as $fila) {
                echo "$fila[nombre]: $fila[descripcion]: $fila[precio] €";
                //echo '<input type="hidden" name="codigo" value="'.$fila['codigo'].'">';
                echo '<input type="" name="'.$fila['nombre'].'">';
                echo '<input type="hidden" name="'.$cnt.'" min="0"><br>';
                $cnt++;
            }
        }
            echo '<input type="submit" name="añadir" value="Añadir">';
            echo '</form>';
            ?>
        </select>
</body>
</html>