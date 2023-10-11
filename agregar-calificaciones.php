<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == "") {
    header("Location: index.php");
} else {
    if (isset($_POST['submit'])) {
        $marks = array();
        $class = $_POST['class'];
        $studentid = $_POST['studentid'];
        $mark = $_POST['marks'];

        $stmt = $dbh->prepare("SELECT tblsubjects.SubjectName,tblsubjects.id FROM tblsubjectcombination join  tblsubjects on  tblsubjects.id=tblsubjectcombination.SubjectId WHERE tblsubjectcombination.ClassId=:cid order by tblsubjects.SubjectName");
        $stmt->execute(array(':cid' => $class));
        $sid1 = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            array_push($sid1, $row['id']);
        }

        for ($i = 0; $i < count($mark); $i++) {
            $mar = $mark[$i];
            $sid = $sid1[$i];
            $sql = "INSERT INTO  tblresult(StudentId,ClassId,SubjectId,marks) VALUES(:studentid,:class,:sid,:marks)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
            $query->bindParam(':class', $class, PDO::PARAM_STR);
            $query->bindParam(':sid', $sid, PDO::PARAM_STR);
            $query->bindParam(':marks', $mar, PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
            if ($lastInsertId) {
                $msg = "Calificaciones Agregadas Correctamente";
            } else {
                $error = "Calificaciones No Asignadas";
            }
        }
    }
?>

    <script>
        function getStudent(val) {
            $.ajax({
                type: "POST",
                url: "get_student.php",
                data: 'classid=' + val,
                success: function(data) {
                    $("#studentid").html(data);

                }
            });
            $.ajax({
                type: "POST",
                url: "get_student.php",
                data: 'classid1=' + val,
                success: function(data) {
                    $("#subject").html(data);

                }
            });
        }
    </script>
    <script>
        function getresult(val, clid) {

            var clid = $(".clid").val();
            var val = $(".stid").val();;
            var abh = clid + '$' + val;
            //alert(abh);
            $.ajax({
                type: "POST",
                url: "get_student.php",
                data: 'studclass=' + abh,
                success: function(data) {
                    $("#reslt").html(data);

                }
            });
        }
    </script>


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
                            <h2 class="title">Agregar Calificaciones al Alumno</h2>

                        </div>

                        <!-- /.col-md-6 text-right -->
                    </div>
                    <!-- /.row -->
                    <div class="row breadcrumb-div">
                        <div class="col-md-6">
                            <ul class="breadcrumb">
                                <li><a href="dashboard.php"><i class="fa fa-home"></i> Inicio</a></li>
                                <li> Calificaciones</li>
                                <li class="active">Agregar Calificaciones</li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->



                <section class="section">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel">
                                <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5>Asignar Resultados Finales al Estudiante</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <?php if ($msg) { ?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                                <strong>Proceso Correcto! </strong><?php echo htmlentities($msg); ?>
                                            </div><?php } else if ($error) { ?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <strong>Algo salió mal! </strong> <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php } ?>
                                        <form class="" method="post">

                                            <div class="form-group">
                                                <label for="default" class="control-label">Año y Sección</label>
                                                <select name="class" class="form-control clid" id="classid" onChange="getStudent(this.value);" required="required">
                                                    <option value="">Selecciona Año y Sección</option>
                                                    <?php $sql = "SELECT * from periodo_estudio";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    if ($query->rowCount() > 0) {
                                                        foreach ($results as $result) {   ?>
                                                            <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->ClassName); ?>&nbsp; Sección-<?php echo htmlentities($result->Section); ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="date" class=" control-label ">Nombre del Estudiante</label>
                                                <select name="studentid" class="form-control stid" id="studentid" required="required" onChange="getresult(this.value);">
                                                <option value="">Selecciona el Estuciante</option>
                                            </select>
                                            </div>

                                            <div class="form-group" style="color: black;">

                                                <div id="reslt" style="color: black;">
                                                </div>
                                            </div>

                                            <div class="form-group" style="color: black;">
                                                <label for="date" class="control-label">Cursos</label>
                                                <div id="subject" style="color: black;">
                                                <style>
                                                    p{
                                                        color: black;
                                                    }
                                                </style>
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <button type="submit" name="submit" id="submit" class="btn btn-success">Subir Calificaciones</button>

                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <!-- /.col-md-12 -->
                        </div>
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