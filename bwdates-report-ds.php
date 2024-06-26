<?php
session_start();
// DB connection
include_once('includes/config.php');
error_reporting(0);

// Validating Session
if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        // Getting post values
        $fromDate = $_POST['fromdate'];
        $toDate = $_POST['todate'];
        $board = $_POST['board'];

        // Store form data in session
        $_SESSION['fromdate'] = $fromDate;
        $_SESSION['todate'] = $toDate;
        $_SESSION['board'] = $board;

        // Redirect to the result page
        header("Location: bwdates-report-result.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="Pt_Br">

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
    <style type="text/css">
        label {
            font-size: 16px;
            font-weight: bold;
            color: #000;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include_once('includes/sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include_once('includes/topbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Datas de Monitoramento</h1>

                    <form method="post" action="bwdates-report-result.php">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Data Inicio</label>
                                            <input type="date" class="form-control" id="fromdate" name="fromdate" required="true">
                                        </div>
                                        <div class="form-group">
                                            <label>Data Final</label>
                                            <input type="date" class="form-control" id="todate" name="todate" required="true">
                                        </div>
                                        <div class="form-group">
                                            <label>Selecione o Equipamento</label>
                                            <select class="form-control" id="board" name="board" required="true">
                                                <option value="">Selecione</option>
                                                <?php
                                                $query = mysqli_query($con, "SELECT * FROM esp32_table_dht11_leds_update");
                                                $cnt = 1;
                                                while ($row = mysqli_fetch_array($query)) {
                                                ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo utf8_encode($row['id']); ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success btn-user btn-block" name="submit" value="Buscar">
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

            <?php include_once('includes/footer.php'); ?>

        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php include_once('includes/footer2.php'); ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
