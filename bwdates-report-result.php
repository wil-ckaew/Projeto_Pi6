<?php session_start();
//DB conncetion
include_once('includes/config.php');
error_reporting(0);
//validating Session
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{


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
      
           <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel=" stylesheet">
    <!--Replace with your tailwind.css once created-->
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    <!--Totally optional :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js" integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>

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
<?php
$fdate = $_POST['fromdate'];
$dateTime = new DateTime($fdate);
$fdate1 = $dateTime->format('d/m/Y');

$tdate = $_POST['todate'];
$dateTime1 = new DateTime($tdate);
$tdate1 = $dateTime1->format('d/m/Y');

$board = $_POST['board'];

$uid = intval($_SESSION['aid']);

$dateOnly = $dateTime->format('d/m/Y');

$query = mysqli_query($con, "SELECT * FROM esp32_table_dht11_leds_record WHERE board='$board'");
$cnt = 1;
while ($row = mysqli_fetch_array($query)) {
  
    $id = $row['id'];
    $board = $row['board'];
    $temperature = $row['temperature'];
    $humidity = $row['humidity'];
    $soil_humidity = $row['soil_humidity'];
    $status_read_sensor_dht11 = $row['status_read_sensor_dht11'];
    $LED_01 = $row['LED_01'];
    $LED_02 = $row['LED_02'];
    $time = $row['time'];
    $date = $row['date'];
    
}
?>

<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-2 text-gray-800"><?php echo utf8_encode("Relatório referente a data de:") ?>
        <?php echo $fdate1; ?> <?php echo utf8_encode("até") ?> <?php echo $tdate1; ?></h1>

    <div class="ml-auto">
        <a href="#" class="btn btn-sm btn-danger shadow-sm mr-2" onclick="window.history.back();"><i class="fas fa-arrow-left fa-sm text-white-50"></i> <?php echo utf8_encode("Voltar"); ?></a>
    </div>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-green-dark"><?php echo utf8_encode("Resultados do relatório encontrado:") ?></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table border="1" class="table table-striped">
                <tr> 
                    <th><span style="color: darkgreen;">Equipamento:</span> <?php echo utf8_encode($board ); ?></th>
                </tr>
                <tr>
                    <th><span style="color: darkgreen;"><?php echo utf8_encode("Última Medição de Temperatura:") ?></span> <?php echo $temperature; ?></th>
                </tr>
                <tr>
                    <th><span style="color: darkgreen;"><?php echo utf8_encode("Última Medição de Umidade do Ar:") ?></span> <?php echo $humidity; ?></th>
                </tr>
                 <tr>
                    <th><span style="color: darkgreen;"><?php echo utf8_encode("Última Medição de Umidade do Solo:") ?></span> <?php echo $soil_humidity; ?></th>
                </tr>
              
            </table>
        </div>
    </div>
</div>

<?php
include_once 'includes/db.php';

$fromDate = $_POST['fromdate'];
$toDate = $_POST['todate'];
$board = $_POST['board'];

$query3 = "SELECT * FROM esp32_table_dht11_leds_record WHERE board = '$board' AND date BETWEEN '$fromDate' AND '$toDate'";
$runQuery3 = mysqli_query($conn, $query3);

$data_temperature = array();
$time = array();

while ($row = mysqli_fetch_array($runQuery3)) {
    // Adicionar dados aos arrays
    $data_temperature[] = $row['temperature'];
    $time[] = $row['time'];
}
?>

<!-- Seu HTML e configuração do gráfico -->
<div class="flex flex-row flex-wrap flex-grow mt-4">
    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
        <div class="bg-white border-transparent rounded-lg shadow-xl">
            <div class="bg-gradient-to-b from-gray-300 to-gray-600 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                <h5 class="font-bold uppercase text-white"><?php echo utf8_encode("Temp. do Ar:")?> <?php echo $fromDate; ?> <?php echo utf8_encode("até") ?> <?php echo $toDate; ?></h5>
            </div>
            <div class="p-5">
                <canvas id="chartjs-7" class="chartjs" width="undefined" height="undefined"></canvas>
                <script>
                    new Chart(document.getElementById("chartjs-7"), {
                        "type": "line",
                        "data": {
                            "labels": <?php echo json_encode($time); ?>,
                            "datasets": [{
                                "label": "Temperatura",
                                "data": <?php echo json_encode($data_temperature); ?>,
                                "borderColor": "rgb(255, 99, 132)",
                                "backgroundColor": "rgba(255, 99, 132, 0.2)"
                            }]
                        },
                        "options": {
                            "scales": {
                                "yAxes": [{
                                    "ticks": {
                                        "beginAtZero": true
                                    }
                                }]
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>



<?php
include_once 'includes/db.php';

$fromDate = $_POST['fromdate'];
$toDate = $_POST['todate'];
$board = $_POST['board'];

$query4 = "SELECT * FROM esp32_table_dht11_leds_record WHERE board = '$board' AND date BETWEEN '$fromDate' AND '$toDate'";
$runQuery4 = mysqli_query($conn, $query4);

$data_humidity = array();
$time = array();

while ($row = mysqli_fetch_array($runQuery4)) {
    // Adicionar dados aos arrays
    $data_humidity[] = $row['humidity'];
    $time[] = $row['time'];
}
?>
<div class="w-full md:w-1/2 xl:w-1/3 p-6">
    <!-- Graph Card -->
    <div class="bg-white border-transparent rounded-lg shadow-xl">
        <div class="bg-gradient-to-b from-gray-300 to-gray-600 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
            <h5 class="font-bold uppercase text-white"><?php echo utf8_encode("Umid. do Ar:")?> <?php echo $fromDate; ?> <?php echo utf8_encode("até") ?> <?php echo $toDate; ?></h5>
        </div>
        <div class="p-5">
            <canvas id="chartjs-0" class="chartjs" width="undefined" height="undefined"></canvas>
            <script>
                new Chart(document.getElementById("chartjs-0"), {
                    "type": "line",
                    "data": {
                        "labels": <?php echo json_encode($time); ?>,
                        "datasets": [{
                            "label": "Umidade do Ar",
                            "data": <?php echo json_encode($data_humidity); ?>,
                            "fill": false,
                            "borderColor": "rgb(75, 192, 192)",
                            "lineTension": 0.1
                        }]
                    },
                    "options": {}
                });
            </script>
        </div>
    </div>
</div>


                
                
<?php
include_once 'includes/db.php';

$fromDate = $_POST['fromdate'];
$toDate = $_POST['todate'];
$board = $_POST['board'];

$query5 = "SELECT * FROM esp32_table_dht11_leds_record WHERE board = '$board' AND date BETWEEN '$fromDate' AND '$toDate'";
$runQuery5 = mysqli_query($conn, $query5);

$datasoil_humidity = array();
$time = array();

while ($row = mysqli_fetch_array($runQuery5)) {
    // Adicionar dados aos arrays
    $datasoil_humidity[] = $row['soil_humidity'];
    $time[] = $row['time'];
}
?>       

<div class="w-full md:w-1/2 xl:w-1/3 p-6">
    <!-- Graph Card -->
    <div class="bg-white border-transparent rounded-lg shadow-xl">
        <div class="bg-gradient-to-b from-gray-300 to-gray-600 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
            <h5 class="font-bold uppercase text-white"><?php echo utf8_encode("Umid. Solo:")?> <?php echo $fromDate; ?> <?php echo utf8_encode("até") ?> <?php echo $toDate; ?></h5>
        </div>
        <div class="p-5">
            <canvas id="chartjs-1" class="chartjs" width="undefined" height="undefined"></canvas>
            <script>
                new Chart(document.getElementById("chartjs-1"), {
                    "type": "line",
                    "data": {
                        "labels": <?php echo json_encode($time); ?>,
                        "datasets": [{
                            "label": "Umid. Solo",
                            "data": <?php echo json_encode($datasoil_humidity); ?>,
                            "fill": false,
                            "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"],
                            "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"],
                            "borderWidth": 1
                        }]
                    },
                    "options": {
                        "scales": {
                            "yAxes": [{
                                "ticks": {
                                    "beginAtZero": true
                                }
                            }]
                        }
                    }
                });
            </script>
        </div>
    </div>
</div>



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
                                            <th><?php  echo utf8_encode("TEMPERATURA (°C)")?></th>
                                            <th>HUMIDADE AMBIENTE (%)</th>
                                            <th>HUMIDADE SOLO (%)</th>
                                            <th><?php echo utf8_encode("FUNC. MANUAL"); ?></th>
                                            <th><?php echo utf8_encode("FUNC. AUTOMÁTICO"); ?></th>
                                            <th><?php  echo utf8_encode("HORÁRIO")?></th>
                                            <th>DATA (dd-mm-yyyy)</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>NO</th>
                                             <th>ID</th>
                                            <th><?php  echo utf8_encode("TEMPERATURA (°C)")?></th>
                                            <th>HUMIDADE AMBIENTE (%)</th>
                                            <th>HUMIDADE SOLO (%)</th>
                                           <th><?php echo utf8_encode("FUNC. MANUAL"); ?></th>
                                            <th><?php echo utf8_encode("FUNC. AUTOMÁTICO"); ?></th>
                                            <th><?php  echo utf8_encode("HORÁRIO")?></th>
                                            <th>DATA (dd-mm-yyyy)</th>
                                            
                                        </tr>   
                                    </tfoot>
                                    <tbody>
<?php $uid=intval($_SESSION['aid']);
$num = 0;
$query = mysqli_query($con, "
    SELECT * from esp32_table_dht11_leds_record WHERE date BETWEEN '$fromDate' AND '$toDate' AND board = '$board' ORDER BY time DESC ");


while($row=mysqli_fetch_array($query)){
$date = date_create($row['date']);
            $dateFormat = date_format($date,"d-m-Y");
            $num++;
?>

                                        <tr>
                                          <td><?php echo $num ; ?></td>
                                          <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['temperature']; ?></td>
                                            <td><?php echo $row['humidity']; ?></td>
                                             <td><?php echo $row['soil_humidity']; ?></td>
                                            <td><?php echo $row['LED_01']; ?></td>
                                             <td><?php echo $row['LED_02']; ?></td>
                                             <td><?php echo $row['time']; ?></td>
                                              <td><?php echo $dateFormat  ?></td>
                                        </tr>
                               <?php } ?>
                                    </tbody>
                                </table>
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