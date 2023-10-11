<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {
        $current_password = $_POST['password'];
        $new_password = $_POST['newpassword'];
        $confirm_password = $_POST['confirmpassword'];
        
        $username = $_SESSION['alogin'];

        // Verificar la contraseña actual
        $sql = "SELECT Password FROM docente WHERE UserName=:username";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($current_password, $result['Password'])) {
            // Hashear la nueva contraseña
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Actualizar la contraseña
            $update_sql = "UPDATE docente SET Password=:new_password WHERE UserName=:username";
            $update_query = $dbh->prepare($update_sql);
            $update_query->bindParam(':new_password', $hashed_new_password, PDO::PARAM_STR);
            $update_query->bindParam(':username', $username, PDO::PARAM_STR);
            $update_query->execute();

            $msg = "Tu contraseña ha sido cambiada correctamente";
        } else {
            $error = "Tu contraseña actual no es correcta";
        }
    }
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
                            <h2 class="title">Cambiar tu Contraseña</h2>

                        </div>

                        <!-- /.col-md-6 text-right -->
                    </div>
                    <!-- /.row -->
                    <div class="row breadcrumb-div">
                        <div class="col-md-6">
                            <ul class="breadcrumb">
                                <li><a href="dashboard.php"><i class="fa fa-home"></i> Inicio</a></li>
                                <li class="active">Cambiar Contraseña</li>
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
                                        <h5>Completa los Campos para Actualizar tu Contraseña</h5>
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
   
                                    <form name="chngpwd" method="post" \ onSubmit="return valid();">
                                            <div class="form-group has-success">
                                                <label for="success" class="control-label">Contraseña actual</label>
                                                <div class="">
                                                    <input type="password" name="password" class="form-control" required="required" id="success">

                                                </div>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="success" class="control-label">Nueva Contraseña</label>
                                                <div class="">
                                                    <input type="password" name="newpassword" required="required" class="form-control" id="success">
                                                </div>
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="success" class="control-label">Confirmar Contraseña</label>
                                                <div class="">
                                                    <input type="password" name="confirmpassword" class="form-control" required="required" id="success">
                                                </div>
                                            </div>
                                            <div class="form-group has-success">

                                                <div class="">
                                                    <button type="submit" name="submit" class="btn btn-success">Actualizar Constraseña</button>
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


<?php  ?>