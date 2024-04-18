<?php
session_start();
include_once('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{

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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

          
       <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel=" stylesheet">
    <!--Replace with your tailwind.css once created-->
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    <!--Totally optional :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js" integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>
      
        
        
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <hr />
                        <a href="bwdates-report-ds.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
    class="fas fa-download fa-sm text-white-50"></i> Relatorios</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

<?php $uid=$_SESSION['aid'];
//Listed Family Members
$query=mysqli_query($con,"select * from esp32_table_dht11_leds_update ");
$fmembers=mysqli_num_rows($query);
//BP Records
$query1=mysqli_query($con,"select * from esp32_table_dht11_leds_record ");
$bprecords=mysqli_num_rows($query1);

?>


                        <!-- Total Tests-->
                       <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2"> <!-- Alterei para border-left-success -->
        <a href="list_equipamentos.php">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> <!-- Alterei para text-success -->
                            Total de Equipamentos
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $fmembers;?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-cogs fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

 


                        


                        

            <!-- Total Registered Phlebotomist-->
           
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                        <a href="monitor.php">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                   
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                              Dados Monitorados</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $bprecords;?></div>
                                        </div>

                                        <div class="col-auto"> 
                                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                                        </div> 
                                    </div>
                                </div>
                                 </a>
                            </div>
                        </div>
                 
                    </div>

                    <!-- Content Row -->

              <?php



/* Database connection settings */
include_once 'includes/db.php';
$dataspo2 = array(); // Initialize as an array for temperature
$databpm = array();    // Initialize as an array for humidity
$times = array();           // Initialize as an array for timestamps

$query = "SELECT * FROM esp32_table_dht11_leds_record ORDER BY date DESC LIMIT 20 ";
$runQuery = mysqli_query($conn, $query);

while ($row = mysqli_fetch_array($runQuery)) {
    // Add data to arrays
  
    $dataspo2[] = $row['temperature'];
    $databpm[] = $row['humidity'];
    $times[] = $row['time'];
    $paciente_id[] = $row['id'];
}
?>

<!-- Your HTML and chart setup -->
<div class="flex flex-row flex-wrap flex-grow mt-4">
    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
        <div class="bg-white border-transparent rounded-lg shadow-xl">
            <div class="bg-green-500 uppercase text-white border-b-2 border-green-600 rounded-tl-lg rounded-tr-lg p-2">
                <h5 class="font-bold uppercase"><?php echo utf8_encode("Gr�fico Temperatura do Ambiente")?></h5>
            </div>
            <div class="p-5">
                <canvas id="chartjs-7" class="chartjs" width="undefined" height="undefined"></canvas>
                <script>
                    new Chart(document.getElementById("chartjs-7"), {
                        "type": "line",
                        "data": {
                            "labels": <?php echo json_encode($times); ?>,
                            "datasets": [{
                                "label": "<?php echo utf8_encode("�C")?>",
                                "data": <?php echo json_encode($dataspo2); ?>,
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
                    <!--/Graph Card-->
                </div>

<?php

/* Database connection settings */
include_once 'includes/db.php';
$dataspo2 = array(); // Initialize as an array for temperature
$databpm = array();    // Initialize as an array for humidity
$times = array();           // Initialize as an array for timestamps

$query = "SELECT * FROM esp32_table_dht11_leds_record ORDER BY date DESC LIMIT 20 ";
$runQuery = mysqli_query($conn, $query);

while ($row = mysqli_fetch_array($runQuery)) {
    // Add data to arrays
  
    $dataspo2[] = $row['temperature'];
    $databpm[] = $row['humidity'];
    $times[] = $row['time'];
    $paciente_id[] = $row['id'];
}
?>
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
    <!--Graph Card-->
    <div class="bg-white border-transparent rounded-lg shadow-xl">
        <div class="bg-green-500 uppercase text-white border-b-2 border-green-600 rounded-tl-lg rounded-tr-lg p-2">
            <h5 class="font-bold uppercase"><?php echo utf8_encode("Gr�fico Umidade Relativa do Ar")?></h5>
        </div>
        <div class="p-5">
                            <canvas id="chartjs-0" class="chartjs" width="undefined" height="undefined"></canvas>
                            <script>
                                new Chart(document.getElementById("chartjs-0"), {
                                    "type": "line",
                                    "data": {
                                        "labels":  <?php echo json_encode($times); ?>,
                                        "datasets": [{
                                            "label": "Hr",
                                            "data": <?php echo json_encode($databpm); ?>,
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
                    <!--/Graph Card-->
                </div>

   <?php

/* Database connection settings */
include_once 'includes/db.php';
$Temperature = array(); // Initialize as an array for temperature
$times1 = array();           // Initialize as an array for timestamps

$query = "SELECT * FROM esp32_table_dht11_leds_record ORDER BY date DESC LIMIT 20 ";
$runQuery = mysqli_query($conn, $query);

while ($row = mysqli_fetch_array($runQuery)) {
    // Add data to arrays
  $Temperature[] = $row['soil_humidity'];
    $times1[] = $row['time'];
    $paciente_id[] = $row['id'];
}
?>             
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
    <!-- Graph Card -->
    <div class="bg-white border-transparent rounded-lg shadow-xl">
        <div class="bg-green-500 uppercase text-white border-b-2 border-green-600 rounded-tl-lg rounded-tr-lg p-2">
            <h5 class="font-bold uppercase"><?php echo utf8_encode("Gr�fico Umidade do Solo")?></h5>
        </div>
        <div class="p-5">
                            <canvas id="chartjs-1" class="chartjs" width="undefined" height="undefined"></canvas>
                            <script>
                                new Chart(document.getElementById("chartjs-1"), {
                                    "type": "bar",
                                    "data": {
                                        "labels": <?php echo json_encode($times1); ?>,
                                        "datasets": [{
                                            "label": "Hs",
                                            "data":  <?php echo json_encode( $Temperature); ?>,
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
                    <!--/Graph Card-->
                </div>

             </div>

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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
<?php } ?>