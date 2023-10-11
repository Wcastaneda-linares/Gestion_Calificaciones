<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['update'])) {
        $classname = $_POST['classname'];
        $classnamenumeric = $_POST['classnamenumeric'];
        $section = $_POST['section'];
        $cid = intval($_GET['classid']);
        $sql = "update  periodo_estudio set ClassName=:classname,ClassNameNumeric=:classnamenumeric,Section=:section where id=:cid ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':classname', $classname, PDO::PARAM_STR);
        $query->bindParam(':classnamenumeric', $classnamenumeric, PDO::PARAM_STR);
        $query->bindParam(':section', $section, PDO::PARAM_STR);
        $query->bindParam(':cid', $cid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Información de año fue actualizada correctamente";
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
                            <h2 class="title">Actualizar Información del Semestre o Sección</h2>

                        </div>

                        <!-- /.col-md-6 text-right -->
                    </div>
                    <!-- /.row -->
                    <div class="row breadcrumb-div">
                        <div class="col-md-6">
                            <ul class="breadcrumb">
                                <li><a href="dashboard.php"><i class="fa fa-home"></i> Inicio</a></li>
                                <li> Semestre y Sección</li>
                                <li class="active">Actualizar Semestre o Sección</li>
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
                                        <h5>Actualiza la Información del Semestre o Sección</h5>
                                    </div>
                                </div>
                                <div class="panel-body">
                                <?php if ($msg || $error) { ?>
                                    <div class="alert <?php echo $msg ? 'alert-success' : 'alert-danger'; ?> left-icon-alert" role="alert">
                                        <strong><?php echo $msg ? 'Proceso correcto!' : 'Hubo un inconveniente!'; ?></strong> <?php echo htmlentities($msg ? $msg : $error); ?>
                                    </div>

                                    <script>
                                        setTimeout(function () {
                                            window.location.href = "administrar-clasSes.php";
                                        }, 5000); // Redirige después de 2000 milisegundos (2 segundos)
                                    </script>
                                <?php } ?>
   
                                <form method="post">
                                        <?php
                                        $cid = intval($_GET['classid']);
                                        $sql = "SELECT * from periodo_estudio where id=:cid";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':cid', $cid, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {   ?>

                                                <div class="form-group has-success">
                                                    <label for="success" class="control-label">Nombre del Semestre o Sección</label>
                                                    <div class="">
                                                        <input type="text" name="classname" value="<?php echo htmlentities($result->ClassName); ?>" required="required" class="form-control" id="success">
                                                        <span class="help-block">Ejemplo: Primer Semestre, Segundo Semestre...</span>
                                                    </div>
                                                </div>
                                                <div class="form-group has-success">
                                                    <label for="success" class="control-label">Año en Número</label>
                                                    <div class="">
                                                        <input type="number" name="classnamenumeric" value="<?php echo htmlentities($result->ClassNameNumeric); ?>" required="required" class="form-control" id="success">
                                                        <span class="help-block">Ejemplo: 2024, 2024...</span>
                                                    </div>
                                                </div>
                                                <div class="form-group has-success">
                                                    <label for="success" class="control-label">Sección</label>
                                                    <div class="">
                                                        <input type="text" name="section" value="<?php echo htmlentities($result->Section); ?>" class="form-control" required="required" id="success">
                                                        <span class="help-block">Ejemplo: A,B,C...</span>
                                                    </div>
                                                </div>
                                        <?php }
                                        } ?>
                                        <div class="form-group has-success">

                                            <div class="">
                                                <button type="submit" name="update" class="btn btn-success btn-labeled">Actualizar<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
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