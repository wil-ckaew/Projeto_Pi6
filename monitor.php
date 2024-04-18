<?php
session_start();
// DB connection
include_once('includes/config.php');
error_reporting(0);
// Validating Session
if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
} else {
    // Code for record deletion
    if ($_GET['action'] == 'delete') {
        $pid = intval($_GET['pid']);
        $query = mysqli_query($con, "delete from esp32_table_dht11_leds_update where id='$pid'");
        echo '<script>alert("Record deleted")</script>';
        echo "<script>window.location.href='list_equipamentos.php'</script>";
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

        <title>MR Monitoramento Remoto</title>

        <!-- Custom fonts for this template -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

        <!-- Custom styles for this page -->
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    </head>
    
     <style>
        .text-green-dark {
            color: #006400; /* Verde escuro em formato hexadecimal */
        }
    </style>  
    

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <?php include_once('includes/sidebar.php'); ?>
            <!-- End of Sidebar -->

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
                        <h1 class="h3 mb-2 text-gray-800">Monitorar Equipamento</h1>

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-green-dark"><?php echo utf8_encode("Selecione o Equipamento"); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Placa</th>
                                                <th>Temperatura</th>
                                                <th>Umidade</th>
                                                <th>Umidade Solo</th>
                                                <th>Status Sensor</th>
                                                <th>Manual</th>
                                                <th><?php echo utf8_encode("Automático"); ?></th>
                                                <th><?php echo utf8_encode("Horário"); ?></th>
                                                <th>Data</th>
                                                <th><?php echo utf8_encode("Ação"); ?></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Placa</th>
                                                <th>Temperatura</th>
                                                <th>Umidade</th>
                                                <th>Umidade Solo</th>
                                                <th>Status Sensor</th>
                                                <th>Manual</th>
                                                <th><?php echo utf8_encode("Automático"); ?></th>
                                                <th><?php echo utf8_encode("Horário"); ?></th>
                                                <th>Data</th>
                                                <th><?php echo utf8_encode("Ação"); ?></th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $query = mysqli_query($con, "SELECT * FROM esp32_table_dht11_leds_update GROUP BY id");
                                            while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['board']; ?></td>
                                                    <td><?php echo $row['temperature']; ?></td>
                                                    <td><?php echo $row['humidity']; ?></td>
                                                    <td><?php echo $row['soil_humidity']; ?></td>
                                                    <td><?php echo $row['status_read_sensor_dht11']; ?></td>
                                                    <td><?php echo $row['LED_01']; ?></td>
                                                    <td><?php echo $row['LED_02']; ?></td>
                                                    <td><?php echo $row['time']; ?></td>
                                                    <td><?php echo $row['date']; ?></td>
                                                    <td>
                                                        <a href="monitoring.php?fmid=<?php echo $row['id']; ?>"><i class="fas fa-video" style="color:blue"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include_once('includes/footer.php'); ?>
                <!-- End of Footer -->

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

        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>
    </body>

    </html>
<?php } ?>
