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
	$sueldoNeto = $sueldoBruto - $descuento;

	echo "<p>Bonificación S/50.00 por hijo:         S/. " . $bonificacion . "</p>";
	echo "<p>Comisión (7.5%):                       S/. " . $comision . "</p>";
	echo "<p>Sueldo bruto Suel. Básico + Comisión:  S/. " . $sueldoBruto . "</p>";
	echo "<p>Descuento por Ley (11%):               S/. " . $descuento . "</p>";
    ?>
</body>

</html>