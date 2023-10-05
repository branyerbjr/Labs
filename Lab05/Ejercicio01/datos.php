<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de cálculo de sueldo vendedor</title>
</head>

<body>
    <h1>Resultado de cálculo de sueldo vendedor</h1>
    <?php

    $totalVendido = $_POST["totalVendido"];
    $hijosEscolar = $_POST["hijosEscolar"];
    $bonificacion = $hijosEscolar * 50;
    $comision = $totalVendido * 0.075;
    $sueldoBasico = 600;
    $sueldoBruto = $sueldoBasico + $comision + $bonificacion;
    $descuento = $sueldoBruto * 0.11;
    ?>
</body>

</html>