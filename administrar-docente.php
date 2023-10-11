<?php
session_start();
error_reporting(0);
include('includes/config.php');

$msg = '';
$error = '';

if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    // Activar docente
    if (isset($_GET['activate'])) {
        $adminId = intval($_GET['activate']);
        $status = 1;
        $sql = "UPDATE docente SET status=:status WHERE id=:adminId";
        $query = $dbh->prepare($sql);
        $query->bindParam(':adminId', $adminId, PDO::PARAM_INT);
        $query->bindParam(':status', $status, PDO::PARAM_INT);
        $query->execute();
        $msg = "Docente Activado Correctamente";
    }

    // Desactivar docente
    if (isset($_GET['deactivate'])) {
        $adminId = intval($_GET['deactivate']);
        $status = 0;
        $sql = "UPDATE docente SET status=:status WHERE id=:adminId";
        $query = $dbh->prepare($sql);
        $query->bindParam(':adminId', $adminId, PDO::PARAM_INT);
        $query->bindParam(':status', $status, PDO::PARAM_INT);
        $query->execute();
        $msg = "Docente Desactivado Correctamente";
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
                            <h2 class="title">Gestión de Docentes</h2>

                        </div>

                        <!-- /.col-md-6 text-right -->
                    </div>
                    <!-- /.row -->
                    <div class="row breadcrumb-div">
                        <div class="col-md-6">
                            <ul class="breadcrumb">
                                <li><a href="dashboard.php"><i class="fa fa-home"></i> Inicio</a></li>
                                <li> Docentes</li>
                                <li class="active">Gestión de Docentes</li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->


                <section class="section">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h5>Ver listado de Docentes</h5>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <?php if ($msg) { ?>
                                        <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>Proceso correcto! </strong><?php echo htmlentities($msg); ?>
                                        </div>
                                    <?php } else if ($error) { ?>
                                        <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Hubo un inconveniente! </strong> <?php echo htmlentities($error); ?>
                                        </div>
                                    <?php } ?>
   
                                    <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th><strong>No.</strong></th>
                                                <th><strong>Nombres</strong></th>
                                                <th><strong>Apellidos</strong></th>
                                                <th><strong>Correo</strong></th>
                                                <th><strong>Estado</strong></th>
                                                <th><strong>Editar</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT id, FirstName, LastName, UserName, status FROM docente";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) { ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($cnt); ?></td>
                                                        <td><?php echo htmlentities($result->FirstName); ?></td>
                                                        <td><?php echo htmlentities($result->LastName); ?></td>
                                                        <td><?php echo htmlentities($result->UserName); ?></td>
                                                        <td>
                                                            <?php 
                                                                $adminStatus = $result->status;
                                                                echo ($adminStatus == 1) ? 'Activo' : 'Inactivo';
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href="actualizar-docente.php?docenteid=<?php echo htmlentities($result->id); ?>" class="btn btn-info"><i class="fa fa-edit" title="Editar Docente"></i> </a>
                                                        </td>
                                                    </tr>
                                            <?php $cnt = $cnt + 1;
                                                }
                                            } ?>
                                        </tbody>
                                    </table>



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