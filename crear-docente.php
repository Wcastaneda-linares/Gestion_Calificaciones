<?php
session_start();
error_reporting(0);
include('includes/config.php');

$msg = ''; // Inicializar la variable $msg
$error = ''; // Inicializar la variable $error

if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Hashear la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO docente(FirstName, LastName, UserName, Password) VALUES(:nombre, :apellidos, :username, :password)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $query->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $hashed_password, PDO::PARAM_STR);

        try {
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();

            if ($lastInsertId) {
                $msg = "Usuario creado exitosamente";
            } else {
                $error = "Algo salió mal. Por favor, inténtalo de nuevo";
            }
        } catch (PDOException $e) {
            // Capturar la excepción de violación UNIQUE
            if ($e->getCode() == 23000) {
                $error = "El correo electrónico ya existe. Por favor, elige otro.";
            } else {
                $error = "Algo salió mal. Por favor, inténtalo de nuevo";
            }
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
                            <h2 class="title">Crear Nuevo Docente</h2>

                        </div>

                        <!-- /.col-md-6 text-right -->
                    </div>
                    <!-- /.row -->
                    <div class="row breadcrumb-div">
                        <div class="col-md-6">
                            <ul class="breadcrumb">
                                <li><a href="dashboard.php"><i class="fa fa-home"></i> Inicio</a></li>
                                <li> Docentes</li>
                                <li class="active">Crear Docente</li>
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
                                        <h5>Completa la Información del Docente</h5>
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
   

                                    <form method="post">
                                    <div class="form-group has-success">
                                            <label for="success" class="control-label">Nombres</label>
                                            <div class="">
                                                <input type="text" name="nombre" class="form-control" required="required" id="nombre" autocomplete="nombre">
                                            </div>
                                        </div>
                                        <div class="form-group has-success">
                                            <label for="success" class="control-label">Apellidos</label>
                                            <div class="">
                                                <input type="text" name="apellidos" class="form-control" required="required" id="apellidos" autocomplete="apellidos">
                                            </div>
                                        </div>
                                        <div class="form-group has-success">
                                            <label for="success" class="control-label">Correo Electrónico</label>
                                            <div class="">
                                                <input type="email" name="username" class="form-control" required="required" id="usernameField" autocomplete="username">
                                            </div>
                                        </div>
                                        <div class="form-group has-success">
                                            <label for="success" class="control-label">Contraseña</label>
                                            <div class="">
                                                <input type="password" name="password" required="required" class="form-control" id="success">
                                            </div>
                                        </div>
                                        <div class="form-group has-success">
                                            <div class="">
                                                <button type="submit" name="submit" class="btn btn-success">Crear Docente</button>
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


<?php ?>