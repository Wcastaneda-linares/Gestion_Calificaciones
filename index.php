<?php
error_reporting(0);
include('includes/config.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Sistema de Calificaciones NoteMaster</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Free HTML Templates" name="keywords">
  <meta content="Free HTML Templates" name="description">

  <!-- Favicon -->
  <link href="./assets/images/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="./assets/css/style.css" rel="stylesheet">
</head>

<body>
  <!-- Topbar Start -->
  <div class="container-fluid bg-dark">
    <div class="row py-2 px-lg-5">
      <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
        <div class="d-inline-flex align-items-center text-white">
          <small><i class="fa fa-phone-alt mr-2"></i>317 243 00 81</small>
          <small class="px-3">|</small>
          <small><i class="fa fa-envelope mr-2"></i>hola@NoteMaster.com</small>
        </div>
      </div>
      <div class="col-lg-6 text-center text-lg-right">
        <div class="d-inline-flex align-items-center">
          <a class="text-white px-2" href="">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a class="text-white px-2" href="">
            <i class="fab fa-twitter"></i>
          </a>
          <a class="text-white px-2" href="">
            <i class="fab fa-linkedin-in"></i>
          </a>
          <a class="text-white px-2" href="">
            <i class="fab fa-instagram"></i>
          </a>
          <a class="text-white pl-2" href="">
            <i class="fab fa-youtube"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Topbar End -->


  <!-- Navbar Start -->
  <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
      <a href="https://www.NoteMaster.com/" class="navbar-brand ml-lg-3">
        <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>NoteMaster</h1>
      </a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
        <div class="navbar-nav mx-auto py-0">
          <a href="index.php" class="nav-item nav-link active">Inicio</a>
          <a href="#" class="nav-item nav-link">Nosotros</a>
          <a href="#" class="nav-item nav-link">Cursos</a>
          <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Páginas</a>
            <div class="dropdown-menu m-0">
              <a href="https://supergas.online/" target="_blank" class="dropdown-item">Distribuidora SuperGas</a>
              <a href="https://biometricattendance.online/" target="_blank" class="dropdown-item">Lector Biometrico</a>
            </div>
          </div>
        </div>
        <a href="find-result.php" class="btn btn-primary py-2 px-4 d-none d-lg-block">Alumnos</a>
        <a href="docente-login.php" class="btn btn-primary py-2 px-4 d-none d-lg-block">Docentes</a>
      </div>
    </nav>
  </div>
  <!-- Navbar End -->


  <!-- Header Start -->
  <div class="jumbotron jumbotron-fluid position-relative overlay-bottom" style="margin-bottom: 90px;">
    <div class="container text-center my-5 py-5">
      <h1 class="text-white mt-4 mb-4">Aprende desde Casa</h1>
      <h1 class="text-white display-1 mb-5">Cursos</h1>
      <div class="mx-auto mb-5" style="width: 100%; max-width: 600px;">
        <div class="input-group">
          <div class="input-group-prepend">
            <button class="btn btn-outline-light bg-white text-body px-4 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cursos</button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Curso 1</a>
              <a class="dropdown-item" href="#">Curso 2</a>
              <a class="dropdown-item" href="#">Curso 3</a>
            </div>
          </div>
          <input type="text" class="form-control border-light" style="padding: 30px 25px;" placeholder="Palabra Clave">
          <div class="input-group-append">
            <button class="btn btn-secondary px-4 px-lg-5">Búsqueda</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Header End -->


  <!-- Footer Start -->
  <div class="container-fluid bg-dark text-white-50 border-top py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center text-md-center mb-3 mb-md-0">
          <p class="m-0"><a class="text-white" href="https://www.NoteMaster.com/46-aplicaciones-gratuitas-en-php-python-y-javascript/#Aplicaciones-gratuitas-en-PHP,-Python-y-Javascript">© 2023 NoteMaster - Todos los derechos reservados.</a>
          </p>
          <div class="d-flex justify-content-end mt-10">
            <a class="text-white mr-4" href="#"><i class="fab fa-2x fa-twitter"></i></a>
            <a class="text-white mr-4" href="#"><i class="fab fa-2x fa-facebook-f"></i></a>
            <a class="text-white mr-4" href="#"><i class="fab fa-2x fa-linkedin-in"></i></a>
            <a class="text-white" href="#"><i class="fab fa-2x fa-instagram"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer End -->


  <!-- Back to Top -->
  <a href="#" class="btn btn-lg btn-primary rounded-0 btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>

  <!-- Template Javascript -->
  <script src="./assets/js/main.js"></script>
</body>

</html>