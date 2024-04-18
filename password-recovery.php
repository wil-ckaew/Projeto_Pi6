<!DOCTYPE html>
<html lang="Pt_br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GreenTech</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .bg-gradient-primary {
            background-color: #20cc8c; /* Cor do botão "success" */
            background-image: linear-gradient(180deg, #20cc8c 10%, #20cc8c 100%);
            background-size: cover;
        }

        .btn-primary {
            background-color: #20cc8c;
            border-color: #20cc8c;
        }

        .btn-primary:hover {
            background-color: #20cc8c;
            border-color: #20cc8c;
        }
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <h3 align="center" style="margin-top:4%;color:#fff">GreenTech</h3>
                <div class="card o-hidden border-0 shadow-lg my-5">

                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <form name="login" method="post" name="changepassword" onsubmit="return checkpass();">
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Recuperar Senha</h1>
                                        </div>
                                        <form class="user">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="emailid" id="emailid" placeholder="Enter Email id" required="true">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="contactno" placeholder="Contato Numero" autocomplete="off" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="newpassword" id="newpassword" placeholder="Nova Senha" autocomplete="off" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirmar Senha" autocomplete="off" class="form-control">
                                            </div>

                                            <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Submit">
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="login.php" style="font-weight:bold; color: darkgreen;"></i>Logar</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="index.php" style="font-weight:bold; color: darkgreen;"><i class="fa fa-home" aria-hidden="true"></i> Home Page</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
