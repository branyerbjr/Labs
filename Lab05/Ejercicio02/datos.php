<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATOS</title>
</head>

<body>
    <?php
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];


    $descuento = $precio * $cantidad * 0.07;
    $nuevo_precio = $precio * 0.95;
    $importe = $nuevo_precio * $cantidad;
    $obsequio = $cantidad * 2;
    $importe_pagar = $importe - $descuento;

    echo "<p>Precio actual de la gaseosa: S/ $precio</p>";
    echo "<p>Nuevo precio de la gaseosa: S/ $nuevo_precio</p>";
    echo "<p>Cantidad de gaseosas adquiridas: $cantidad</p>";
    echo "<p>Importe de la compra: S/ $importe</p>";
    echo "<p>Descuento: S/ $descuento</p>";
    echo "<p>Importe a pagar: S/ $importe_pagar</p>";
    echo "<p>Obsequio: $obsequio caramelos</p>";
    ?>
</body>

</html>