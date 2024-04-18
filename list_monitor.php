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
        $pid = intval($_GET['bid']);
        $query = mysqli_query($con, "delete from esp32_table_dht11_leds_update where id='$pid'");
        echo '<script>alert("Record deleted")</script>';
        echo "<script>window.location.href='list_monitor.php'</script>";
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

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

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
  <?php include_once('includes/sidebar.php');?>
        <!-- End of Sidebar -->

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
                    
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gerenciar Registros<?php echo utf8_encode($row['id']); ?></h1>
        <div>
                    
          <a href="#" class="btn btn-sm btn-danger shadow-sm mr-2" onclick="window.history.back();"><i class="fas fa-arrow-left fa-sm text-white-50"></i> <?php echo utf8_encode("Voltar"); ?></a>
            <a href="bwdates-report-ds.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> <?php echo utf8_encode("Relatórios"); ?></a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row"> 

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-green-dark"><?php echo utf8_encode("Informações do Equipamento"); ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>ID</th>
                                            <th>BOARD</th>
                                            <th><?php  echo utf8_encode("TEMPERATURA (°C)")?></th>
                                            <th>HUMIDADE AMBIENTE (%)</th>
                                            <th>HUMIDADE SOLO (%)</th>
                                            <th><?php  echo utf8_encode("SITUAÇÃO DO SENSOR DHT11")?></th>
                                            <th><?php echo utf8_encode("MANUAL"); ?></th>
                                            <th><?php echo utf8_encode("AUTOMÁTICO"); ?></th>
                                            <th><?php  echo utf8_encode("HORÁRIO")?></th>
                                            <th>DATA (dd-mm-yyyy)</th>
                                            <th><?php echo utf8_encode("Ação"); ?></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>NO</th>
                                            <th>ID</th>
                                            <th>BOARD</th>
                                            <th><?php  echo utf8_encode("TEMPERATURA (°C)")?></th>
                                            <th>HUMIDADE AMBIENTE (%)</th>
                                            <th>HUMIDADE SOLO (%)</th>
                                            <th><?php  echo utf8_encode("SITUAÇÃO DO SENSOR DHT11")?></th>
                                            <th><?php echo utf8_encode("MANUAL"); ?></th>
                                            <th><?php echo utf8_encode("AUTOMÁTICO"); ?></th>
                                            <th><?php  echo utf8_encode("HORÁRIO")?></th>
                                            <th>DATA (dd-mm-yyyy)</th>
                                            <th><?php echo utf8_encode("Ação"); ?></th>
                                        </tr>   
                                    </tfoot>
                                    <tbody>
<?php $uid=intval($_SESSION['aid']);
$num = 0;
$query = mysqli_query($con, "
    SELECT * from esp32_table_dht11_leds_record ORDER BY time DESC ");


while($row=mysqli_fetch_array($query)){
$date = date_create($row['date']);
            $dateFormat = date_format($date,"d-m-Y");
            $num++;
?>

                                        <tr>
                                          <td><?php echo $num ; ?></td>
                                          <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['board']; ?></td>
                                                    <td><?php echo $row['temperature']; ?></td>
                                                    <td><?php echo $row['humidity']; ?></td>
                                                    <td><?php echo $row['soil_humidity']; ?></td>
                                                    <td><?php echo $row['status_read_sensor_dht11']; ?></td>
                                                    <td><?php echo $row['LED_01']; ?></td>
                                                    <td><?php echo $row['LED_02']; ?></td>
                                                    <td><?php echo $row['time']; ?></td>
                                                    <td><?php echo $dateFormat  ?></td>
                                            <td>

    

                                <a href="list_monitor.php?bpid=<?php echo $row['id'];?>&&action=delete" onclick="return confirm('Gostaria de excluir mesmo este registro?');"><i class="fa fa-trash" aria-hidden="true" style="color:red" title="Delete this record"></i></a></td>
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
    <?php include_once('includes/footer.php');?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php include_once('includes/footer2.php');?>

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