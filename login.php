<?php 
session_start();
error_reporting(0);
//DB conncetion
include_once('includes/config.php');




if(isset($_POST['login']))
  {
$email=$_POST['emailid'];
$userpassword=$_POST['userpassword'];
    $query=mysqli_query($con,"select id from tbluser where  emailid='$email' && loginPassword='$userpassword' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['aid']=$ret['id'];
     echo "<script>window.location.href='dashboard.php';</script>";
    }
    else{
    echo "<script>alert('Senha ou Usuario Invalido.');</script>";  
    echo "<script>window.location.href='login.php'</script>";           
    }
  }
?>

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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
<style type="text/css">
label{
    font-size:16px;
    font-weight:bold;
    color:#000;
}

</style>

   <style>
        .text-green-dark {
            color: #006400; /* Verde escuro em formato hexadecimal */
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

<?php include_once('includes/sidebar.php');?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
          <?php include_once('includes/topbar.php');?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?php echo utf8_encode("GreenTech - Tecnologia automatizada para uma agricultura sustentável.")?></h1>
<form name="newtesting" method="post">
  <div class="row">

                        <div class="col-lg-6">

                            <!-- Basic Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-green-dark"><?php echo utf8_encode("Usário Login"); ?></h6>
                                </div>
                                <div class="card-body">
  

                                        <div class="form-group">
                                             <label>Email</label>
                                            <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Email" required="true">
                                        </div>

                                                <div class="form-group">
                                             <label>Senha</label>
                                            <input type="password" class="form-control" id="userpassword" name="userpassword" placeholder="Senha" required="true">
                                            <a class="m-0 font-weight-bold text-green-dark" href="password-recovery.php">Esqueceu sua senha</a>
                                        </div>
           
      <div class="form-group">
    <input type="submit" class="btn btn-success btn-user btn-block" name="login" id="submit">                           
</div>

                                </div>
                            </div>

                        </div>


                    </div>
</form>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           <?php include_once('includes/footer.php');?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>