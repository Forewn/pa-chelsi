<?php

session_start();

if (isset($_SESSION['codigo_usuario'])) {
    header("location: admin/home.php");
}

?>
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logoprees.png">
    <title>Login</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark" style="background-image: url('assets/images/tres.jpeg');background-image: no-repeat;
background-image: fixed;
background-image: center;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;">
            <div class="auth-box bg-dark border-top border-secondary" style="background-color: blue;">
                <div id="loginform" >
                    <div class="text-center p-t-20 p-b-20">
                        <span class="db"><img src="assets/images/logoprees.png" alt="logo"  style="
    width: 180px;"/></span>
                    </div>


                    <form action="" method="post" class="form-horizontal m-t-20">
                        <?php
                        include 'php/login.php';
                        ?>
                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input id="" type="text" class="validate form-control form-control-lg" name="usuario">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input id="" type="password" class="validate form-control form-control-lg" name="contraseña">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-info btn-lg" name="btningresar" type="submit" value="Iniciar Sesion">Iniciar Sesion&nbsp;<i class="zmdi zmdi-mail-send"></i></button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        $('#to-login').click(function() {

            $("#recoverform").hide();
            $("#loginform").fadeIn();
        });
    </script>

</body>

</html>