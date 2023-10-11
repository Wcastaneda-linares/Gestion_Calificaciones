<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    // for activate Subject   	
    if (isset($_GET['acid'])) {
        $acid = intval($_GET['acid']);
        $status = 1;
        $sql = "update tblsubjectcombination set status=:status where id=:acid ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':acid', $acid, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $msg = " Materia activada Correctamente";
    }

    // for Deactivate Subject
    if (isset($_GET['did'])) {
        $did = intval($_GET['did']);
        $status = 0;
        $sql = "update tblsubjectcombination set status=:status where id=:did ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':did', $did, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $msg = " Materia Desactivada Correctamente";
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
                            <h2 class="title">Gestionar la Asignacion de Cursos</h2>

                        </div>

                        <!-- /.col-md-6 text-right -->
                    </div>
                    <!-- /.row -->
                    <div class="row breadcrumb-div">
                        <div class="col-md-6">
                            <ul class="breadcrumb">
                                <li><a href="dashboard.php"><i class="fa fa-home"></i> Inicio</a></li>
                                <li> Cursos</li>
                                <li class="active">Gestionar la Asignacion de Cursos</li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->

                <section class="section">
                    <div class="container-fluid">



                        <div class="row">
                            <div class="col-md-12">

                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5>Ver Información de Asignacion de Cursos</h5>
                                        </div>
                                    </div>
                                    <?php if ($msg) { ?>
                                        <div class="alert alert-success left-icon-alert" role="alert">
                                            <strong>Bien hecho!</strong><?php echo htmlentities($msg); ?>
                                        </div><?php } else if ($error) { ?>
                                        <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Hubo inconvenientes!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                    <?php } ?>
                                    <div class="panel-body p-20">

                                        <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th><strong>No.</strong></th>
                                                    <th><strong>Semestre y Sección</strong></th>
                                                    <th><strong>Curso</strong></th>
                                                    <th><strong>Estado</strong></th>
                                                    <th><strong>Editar</strong></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sql = "SELECT periodo_estudio.ClassName,periodo_estudio.Section,tblsubjects.SubjectName,tblsubjectcombination.id as scid,tblsubjectcombination.status from tblsubjectcombination join periodo_estudio on periodo_estudio.id=tblsubjectcombination.ClassId  join tblsubjects on tblsubjects.id=tblsubjectcombination.SubjectId";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {   ?>
                                                        <tr>
                                                            <td><?php echo htmlentities($cnt); ?></td>
                                                            <td><?php echo htmlentities($result->ClassName); ?> &nbsp; Sección-<?php echo htmlentities($result->Section); ?></td>
                                                            <td><?php echo htmlentities($result->SubjectName); ?></td>
                                                            <td><?php $stts = $result->status;
                                                                if ($stts == '0') {
                                                                    echo htmlentities('Inactivo');
                                                                } else {
                                                                    echo htmlentities('Activo');
                                                                }
                                                                ?></td>

                                                            <td>
                                                                <?php if ($stts == '0') { ?>
                                                                    <a href="administrar-asignacion.php?acid=<?php echo htmlentities($result->scid); ?>" onclick="confirm('Deseas Activar este Curso?');" class="btn btn-success"><i class="fa fa-check" title="Activar Curso"></i> </a><?php } else { ?>

                                                                    <a href="administrar-asignacion.php?did=<?php echo htmlentities($result->scid); ?>" class="btn btn-danger" onclick="confirm('Deseas Desactivar este Curso?');"><i class="fa fa-times" title="Desactivar Curso"></i> </a>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                <?php $cnt = $cnt + 1;
                                                    }
                                                } ?>


                                            </tbody>
                                        </table>


                                        <!-- /.col-md-12 -->
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-md-6 -->


                        </div>
                        <!-- /.col-md-12 -->
                    </div>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-md-6 -->

    </div>
    <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.section -->

    </div>
    <!-- /.main-page -->



    </div>
    <!-- /.content-container -->
    </div>
    <!-- /.content-wrapper -->
    <?php include('includes/footer.php'); ?>



<?php } ?>