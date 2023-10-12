<?php include 'template/header.php' ?>

<?php
if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include_once 'model/conexion.php';
$codigo = $_GET['codigo'];
$mensaje = '';

// Verificar si se ha enviado el formulario
if (isset($_POST['oculto'])) {
    $descripcion = $_POST['txtDescripcion'];
    $fechaInicio = $_POST['txtFechaInicio'];
    $fechaFin = $_POST['txtFechaFin'];

    if (empty($descripcion) || empty($fechaInicio) || empty($fechaFin)) {
        $mensaje = 'Todos los campos son requeridos.';
    } else {
        // Comprobar si es una operación de creación o actualización
        if (isset($_POST['id_promocion'])) {
            // Actualización de la promoción
            $id_promocion = $_POST['id_promocion'];
            $query = "UPDATE promocion SET descripcion = ?, fecha_inicio = ?, fecha_fin = ? WHERE id_promocion = ?";
            $stmt = $bd->prepare($query);
            $stmt->execute([$descripcion, $fechaInicio, $fechaFin, $id_promocion]);
            $mensaje = 'Promoción actualizada con éxito.';
        } else {
            // Inserción de la nueva promoción
            $query = "INSERT INTO promocion (descripcion, fecha_inicio, fecha_fin, id_user) VALUES (?, ?, ?, ?)";
            $stmt = $bd->prepare($query);
            $stmt->execute([$descripcion, $fechaInicio, $fechaFin, $codigo]);

            // Redirige al usuario después de registrar una promoción
            header('Location: promociones.php?mensaje=registrado');
            exit();
        }
    }
}

// Obtener la lista de promociones del usuario
$sentencia = $bd->prepare("SELECT * FROM promocion WHERE id_user = ?;");
$sentencia->execute([$codigo]);
$promociones = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <!-- inicio alerta -->
            <?php
            if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta') {
            ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Rellena todos los campos.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            ?>


            <?php
            if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado') {
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Registrado!</strong> Se agregaron los datos.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            ?>


            <?php
            if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'error') {
            ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Vuelve a intentar.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            ?>



            <?php
            if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado') {
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Cambiado!</strong> Los datos fueron actualizados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            ?>


            <?php
            if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado') {
            ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Eliminado!</strong> Los datos fueron borrados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            ?>

            <!-- fin alerta -->
            <!-- Mostrar la lista de promociones del usuario -->
            <div class="col-md-auto">
                <div class="card">
                    <div class="card-header">
                        TUS PROMOCIONES: 
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Descripción</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Fin</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($promociones as $promocion) : ?>
                                <tr>
                                    <td><?php echo $promocion->descripcion; ?></td>
                                    <td><?php echo $promocion->fecha_inicio; ?></td>
                                    <td><?php echo $promocion->fecha_fin; ?></td>
                                    <td>
                                        <a href="?codigo=<?php echo $codigo; ?>&editar=<?php echo $promocion->id_promocion; ?>">Editar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Mostrar el mensaje de éxito o error -->
        <div class="col-md-auto">
            <div class="card">
                <div class="card-header">
                    INGRESAR PROMOCION:
                </div>
                <form class="p-4" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Descripcion: </label>
                        <input type="text" class="form-control" name="txtDescripcion" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de Inicio: </label>
                        <input type="date" class="form-control" name="txtFechaInicio" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de Fin: </label>
                        <input type="date" class="form-control" name="txtFechaFin" required>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary" value="Registrar">
                    </div>
                </form>
                <p><?php echo $mensaje; ?></p>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>