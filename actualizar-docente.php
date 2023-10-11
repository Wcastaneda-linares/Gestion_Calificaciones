<?php
session_start();
error_reporting(0);
include('includes/config.php');

$msg = '';
$error = '';

if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    // Obtener información del docente
    $docenteId = intval($_GET['docenteid']);
    $sql = "SELECT * FROM docente WHERE id = :docenteId";
    $query = $dbh->prepare($sql);
    $query->bindParam(':docenteId', $docenteId, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);


    var_dump($result); // Muestra el contenido de $result para depurar

    // Actualizar información del docente
    if (isset($_POST['submit'])) {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $correo = $_POST['correo'];
        $status = $_POST['status'];

        $sql = "UPDATE docente SET FirstName=:nombre, LastName=:apellidos, UserName=:correo, Status=:status WHERE id=:docenteId";
        $query = $dbh->prepare($sql);
        $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $query->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
        $query->bindParam(':correo', $correo, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_INT);
        $query->bindParam(':docenteId', $docenteId, PDO::PARAM_INT);
        $query->execute();
        $msg = " Información de Docente Actualizada Correctamente";
    }
?>



<link rel="stylesheet" type="text/css" href="assets/js/DataTables/datatables.min.css" />
    <!-- ========== TOP NAVBAR ========== -->
    <?php include('includes/topbar.php'); ?>
    <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
    <div class="content-wrapper">
        <div class="content-container">
            <?php include('includes/leftbar.php'); ?>

            <div class="main-page">
                <div class="container-fluid">
                    <div class="row page-title-div">
                        <div class="col-md-6">
                            <h2 class="title">Actualizar Información del Docente</h2>

                        </div>

                        <!-- /.col-md-6 text-right -->
                    </div>
                    <!-- /.row -->
                    <div class="row breadcrumb-div">
                        <div class="col-md-6">
                            <ul class="breadcrumb">
                                <li><a href="dashboard.php"><i class="fa fa-home"></i> Inicio</a></li>
                                <li> Docentes</li>
                                <li class="active">Actualizar Docente</li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->


                <section class="section">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h5>Actualiza la Información del Docente</h5>
                                    </div>
                                </div>
                                <div class="panel-body">
                                <?php if ($msg || $error) { ?>
                                    <div class="alert <?php echo $msg ? 'alert-success' : 'alert-danger'; ?> left-icon-alert" role="alert">
                                        <strong><?php echo $msg ? 'Proceso correcto!' : 'Hubo un inconveniente!'; ?></strong> <?php echo htmlentities($msg ? $msg : $error); ?>
                                    </div>

                                    <script>
                                        setTimeout(function () {
                                            window.location.href = "administrar-docente.php";
                                        }, 5000); // Redirige después de 2000 milisegundos (2 segundos)
                                    </script>
                                <?php } ?>
   
                                    <form class="form-horizontal" method="post">
                                    <div class="form-group">
                                        <label for="nombre" class="col-sm-2 control-label">Nombres</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nombre" class="form-control" id="nombre" value="<?php echo htmlentities($result['FirstName']); ?>" required="required" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="apellidos" class="col-sm-2 control-label">Apellidos</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="apellidos" class="form-control" id="apellidos" value="<?php echo htmlentities($result['LastName']); ?>" required="required" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="correo" class="col-sm-2 control-label">Correo</label>
                                        <div class="col-sm-10">
                                            <input type="email" name="correo" class="form-control" id="correo" value="<?php echo htmlentities($result['UserName']); ?>" required="required" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Estado</label>
                                        <div class="col-sm-10">
                                            <?php
                                            $stats = isset($result['status']) ? $result['status'] : "";

                                            $activoChecked = ($stats == "1") ? "checked" : "";
                                            $inactivoChecked = ($stats == "0") ? "checked" : "";
                                            ?>
                                            <input type="radio" name="status" value="1" required="required" <?php echo $activoChecked; ?>> Activo
                                            <input type="radio" name="status" value="0" required="required" <?php echo $inactivoChecked; ?>> Inactivo
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" name="submit" class="btn btn-primary" >Actualizar</button>
                                        </div>
                                    </div>
                                </form>



                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-12 -->
                    </div>
                </section>


                    <!-- /.section -->
                </div>
                    <!-- /.container-fluid -->

            </div>
            <!-- /.main-page -->



        </div>
        <!-- /.content-container -->
    </div>
    <!-- /.content-wrapper -->
    <?php include('includes/footer.php'); ?>


<?php } ?>