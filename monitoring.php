<?php
session_start();
include_once('includes/config.php');
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{

?>


<style>

.heart-rate {
max-width: 180px;
height: 100px;
position: relative;
margin:5px;
top:10px;
overflow:hidden;
    
}

.fade-in {
  position: absolute;
  width: 100%;
  height:100%;
  background-color: white;
  top: 0;
  right: 0;
  animation: heartRateIn 4.5s linear infinite;

 /* Gia na katalavw ti ginetai des auto
    border:1px solid red;
    */

}

.fade-out {
  position: absolute;
  width: 120%;
  height: 100%;
  top: 0;
  left: -120%;
  animation: heartRateOut 4.5s linear infinite;
  background: rgba(255, 255, 255, 1);
  background: -moz-linear-gradient(left, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(255, 255, 255, 0) 100%);
  background: -webkit-linear-gradient(left, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(255, 255, 255, 0) 100%);
  background: -o-linear-gradient(left, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(255, 255, 255, 0) 100%);
  background: -ms-linear-gradient(left, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(255, 255, 255, 0) 100%);
  background: linear-gradient(to right, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 1) 80%, rgba(255, 255, 255, 0) 100%);
}

@keyframes heartRateIn {
  0% {
    width: 100%;
  }
  50% {
    width: 0%;
  }
  100% {
    width: 0;
  }
}

@keyframes heartRateOut {
  0% {
    left: -120%;
  }
  30% {
    left: -120%;
  }
  100% {
    left: 0;
  }
}

</style>




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


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="icon" href="data:,">
    <style>
      html {font-family: Arial; display: inline-block; text-align: center;}
      p {font-size: 1.2rem;}
      h4 {font-size: 0.8rem;}
      body {margin: 0;}
      .topnav {overflow: hidden; background-color: #0c6980; color: white; font-size: 1.2rem;}
      .content {padding: 5px; }
      .card {background-color: white; box-shadow: 0px 0px 10px 1px rgba(140,140,140,.5); border: 1px solid #0c6980; border-radius: 15px;}
      .card.header {background-color: #0c6980; color: white; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; border-top-right-radius: 12px; border-top-left-radius: 12px;}
      .cards {max-width: 700px; margin: 0 auto; display: grid; grid-gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));}
      .reading {font-size: 1.3rem;}
      .packet {color: #bebebe;}
      .temperatureColor {color: #fd7e14;}
      .humidityColor {color: #1b78e2;}
      .humidityColor1 {color:#52d519;}
      .statusreadColor {color: #702963; font-size:12px;}
      .LEDColor {color: #183153;}
      
      /* ----------------------------------- Toggle Switch */
      .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
      }

      .switch input {display:none;}

      .sliderTS {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #D3D3D3;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 34px;
      }

      .sliderTS:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 4px;
        background-color: #f7f7f7;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 50%;
      }

      input:checked + .sliderTS {
        background-color: #00878F;
      }

      input:focus + .sliderTS {
        box-shadow: 0 0 1px #2196F3;
      }

      input:checked + .sliderTS:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
      }

      .sliderTS:after {
        content:'OFF';
        color: white;
        display: block;
        position: absolute;
        transform: translate(-50%,-50%);
        top: 50%;
        left: 70%;
        font-size: 10px;
        font-family: Verdana, sans-serif;
      }

      input:checked + .sliderTS:after {  
        left: 25%;
        content:'ON';
      }

      input:disabled + .sliderTS {  
        opacity: 0.3;
        cursor: not-allowed;
        pointer-events: none;
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

<?php
include_once 'includes/db.php';

// Verifica se o parâmetro 'fmid' foi fornecido na URL
if(isset($_GET['fmid'])) {
    // Obtém o valor do parâmetro 'fmid' da URL
    $fmid = $_GET['fmid'];

    // Verifica se o ID é igual a "esp32_01"
    if($fmid === "esp32_01") {
        // Se for "esp32_01", exibe a mensagem "Placa não monitorada"
        $sql = "SELECT * FROM esp32_table_dht11_leds_update WHERE id='$fmid'";

        // Executa a consulta SQL
        $result = mysqli_query($conn, $sql);

        // Verifica se a consulta foi bem-sucedida
        if($result) {
            // Verifica se há pelo menos um registro retornado pela consulta
            if(mysqli_num_rows($result) > 0) {
                // Loop através dos resultados e exibe cada registro
                while($row = mysqli_fetch_assoc($result)) {
                    ?>
                <!-- Begin Page Content -->
              <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Monitoramento: <?php echo utf8_encode($row['id']); ?></h1>
        <div>
            <a href="#" class="btn btn-sm btn-danger shadow-sm mr-2" onclick="window.history.back();"><i class="fas fa-arrow-left fa-sm text-white-50"></i> <?php echo utf8_encode("Voltar"); ?></a>
            <a href="bwdates-report-ds.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> <?php echo utf8_encode("Relatórios"); ?></a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row"> 






    <script>
        /*Toggle dropdown list*/
        function toggleDD(myDropMenu) {
            document.getElementById(myDropMenu).classList.toggle("invisible");
        }
        /*Filter dropdown options*/
        function filterDD(myDropMenu, myDropMenuSearch) {
            var input, filter, ul, li, a, i;
            input = document.getElementById(myDropMenuSearch);
            filter = input.value.toUpperCase();
            div = document.getElementById(myDropMenu);
            a = div.getElementsByTagName("a");
            for (i = 0; i < a.length; i++) {
                if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                    a[i].style.display = "";
                } else {
                    a[i].style.display = "none";
                }
            }
        }
        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.drop-button') && !event.target.matches('.drop-search')) {
                var dropdowns = document.getElementsByClassName("dropdownlist");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (!openDropdown.classList.contains('invisible')) {
                        openDropdown.classList.add('invisible');
                    }
                }
            }
        }
    </script>



   <?php include_once('includes/topbar.php'); ?>
                    <!-- End of Topbar -->

                      <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2"> <!-- Alterei para border-left-success -->
       
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> <!-- Alterei para text-success -->
                            <i class="fas fa-lightbulb"></i> <?php  echo utf8_encode("CONTROLE MANUAL DE IRRIGAÇÃO")?>:
                        </div></br>
                        <label class="switch" >
                        <input type="checkbox" id="ESP32_01_TogLED_01" onclick="GetTogBtnLEDState('ESP32_01_TogLED_01', 'ESP32_01_TogLED_02')">
                        <div class="sliderTS"></div>
                      </label>
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
                       
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                   
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                             <i class="fas fa-lightbulb"></i> <?php  echo utf8_encode("CONTROLE AUTOMATICO DE IRRIGAÇÃO")?>:</div></br>
                                             <label class="switch">
                                             <input type="checkbox" id="ESP32_01_TogLED_02" onclick="GetTogBtnLEDState('ESP32_01_TogLED_02', 'ESP32_01_TogLED_01')">
                                             <div class="sliderTS"></div>
                                           </label>
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
                       
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                   
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                             <i class="fas fa-chart-line"></i> <?php  echo utf8_encode("DADOS RECEBIDOS DA ÚLTIMA VEZ DO ESP32")?> [ <span id="ESP32_01_LTRD"></span> ]</div></br>
                                            
                                              <a class="h5 mb-0 font-weight-bold text-gray-800" href="list_monitor.php">Abrir Tabela de Registro</a>

                                             </div>
                                       
                                        <div class="col-auto"> 
                                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                                        </div> 
                                    </div>
                                </div>
                                 </a>
                            </div>
                        </div>
                 
                    
                    
   
<!-- Your HTML and chart setup -->

    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
        <div class="bg-white border-transparent rounded-lg shadow-xl">
          
            <div class="bg-green-500 uppercase text-white border-b-2 border-green-600 rounded-tl-lg rounded-tr-lg p-2">
                <h5 class="font-bold uppercase text-white text-center"><?php  echo utf8_encode("Umidade do Solo")?></h5>
            </div>
       
        <div class="text-center">
                <h4 class="humidityColor1 text-4xl mt-4 mb-2"><i class="fas fa-tint"></i> UMIDADE DO</h4>
                <h4 class="humidityColor1 text-4xl mb-2"></i> SOLO</h4>
                <p class="humidityColor1 text-4xl"><span class="reading"><span id="ESP32_01_Soil_Humd"></span> &percnt;</span></p>
            </div>
          
          <p class="statusreadColor text-center mb-4"><span><?php echo utf8_encode("Status do Sensor") ?>: </span><span id="ESP32_01_Status_Read_DHT11"></span></p>
           </br>
        </div> 
   </div>
   
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <div class="bg-white border-transparent rounded-lg shadow-xl">
                        <div class="bg-green-500 uppercase text-white border-b-2 border-green-600 rounded-tl-lg rounded-tr-lg p-2">
                            <h5 class="font-bold uppercase text-white text-center"><?php  echo utf8_encode("Umidade do Ar")?></h5>
                        </div>
       
	  
          <div class="text-center">
                <h4 class="humidityColor text-4xl mt-4 mb-2"><i class="fas fa-tint"></i> UMIDADE RELATIVA</h4>
                <h4 class="humidityColor text-4xl mb-2"></i>DO AR</h4>
          <p class="humidityColor text-4xl"><span class="reading"><span id="ESP32_01_Humd"></span> &deg;C</span></p>
           </div>
          <p class="statusreadColor text-center mb-4"><?php  echo utf8_encode("Status do Sensor")?>: </span><span id="sensor1"></span></p>
         </br>
        </div>
      </div>
  
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <div class="bg-white border-transparent rounded-lg shadow-xl">
                        <div class="bg-green-500 uppercase text-white border-b-2 border-green-600 rounded-tl-lg rounded-tr-lg p-2">
                            <h5 class="font-bold uppercase text-white text-center"><?php  echo utf8_encode("Temperatura Ambiente")?></h5>
                        </div>
           <div class="text-center">
          <h4 class="temperatureColor text-4xl mt-4 mb-2"><i class="fas fa-thermometer-half"></i> TEMPERATURA</h4>
         <h4 class="temperatureColor text-4xl mb-2"></i>AMBIENTE</h4>
           <p class="temperatureColor text-4xl"><span class="reading"><span id="ESP32_01_Temp"></span> &deg;C</span></p>
         
          
         <p class="statusreadColor text-center mb-4"><?php  echo utf8_encode("Status do Sensor")?>: </span><span id="sensor2"></span></p>
         </br>
        </div>
         </div>
</div>
    
    <!-- Your HTML and chart setup -->
<?php
// Consulta SQL para recuperar os últimos 30 registros de umidade do solo
$sql = "SELECT * FROM esp32_table_dht11_leds_record ORDER BY date DESC, time DESC LIMIT 30";

// Execute a consulta SQL
$result = mysqli_query($conn, $sql);

// Inicialize uma matriz para armazenar os dados de umidade do solo
$soilHumidityData = array();

// Verifica se a consulta foi bem-sucedida e se há pelo menos um registro retornado
if ($result && mysqli_num_rows($result) > 0) {
    // Loop através dos resultados e armazena os dados de umidade do solo na matriz
    while ($row = mysqli_fetch_assoc($result)) {
        $soilHumidityData[] = $row;
    }
}

// Converta a matriz $soilHumidityData em JSON para que possa ser usada no JavaScript
$soilHumidityDataJSON = json_encode($soilHumidityData);
?>

<div class="w-full md:w-1/2 xl:w-1/3 p-6">
    <div class="bg-white border-transparent rounded-lg shadow-xl">
        <div class="bg-green-500 uppercase text-white border-b-2 border-green-600 rounded-tl-lg rounded-tr-lg p-2">
            <h5 class="font-bold uppercase text-white text-center"><?php echo utf8_encode("Gráfico Umidade do Solo") ?></h5>
        </div>
        <div class="text-center">
            <h4 class="humidityColor1 text-4xl mt-4 mb-2"><i class="fas fa-tint"></i> UMIDADE DO</h4>
            <h4 class="humidityColor1 text-4xl mb-2">SOLO</h4>
            <!-- Canvas for the soil humidity chart -->
            <canvas id="soilHumidityChart" width="400" height="200"></canvas>
        </div>
        <!-- Script to populate and render the soil humidity chart -->
        <script>
            // Recupere os dados JSON da variável PHP
            var soilHumidityData = <?php echo $soilHumidityDataJSON; ?>;

            // Extrair rótulos de tempo e valores de umidade do solo dos dados
            var labels = soilHumidityData.map(function(entry) {
                return entry.time;
            });
            var soilHumidityValues = soilHumidityData.map(function(entry) {
                return entry.soil_humidity;
            });

            // Obtenha o elemento canvas
            var ctx = document.getElementById('soilHumidityChart').getContext('2d');

            // Crie o gráfico de umidade do solo
            var soilHumidityChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Umidade do Solo',
                        data: soilHumidityValues,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Cor de fundo para a linha
                        borderColor: 'rgba(75, 192, 192, 1)', // Cor da linha
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
</div>

   
   
   
   
       <?php
// Consulta SQL para recuperar os últimos 30 registros de umidade do ar

$sql = "SELECT * FROM esp32_table_dht11_leds_record ORDER BY date DESC, time DESC LIMIT 30";
// Execute a consulta SQL
$result = mysqli_query($conn, $sql);

// Inicialize uma matriz para armazenar os dados de umidade do ar
$humidityData = array();

// Verifica se a consulta foi bem-sucedida e se há pelo menos um registro retornado
if ($result && mysqli_num_rows($result) > 0) {
    // Loop através dos resultados e armazena os dados de umidade do ar na matriz
    while ($row = mysqli_fetch_assoc($result)) {
        $humidityData[] = $row;
    }
}

// Converta a matriz $humidityData em JSON para que possa ser usada no JavaScript
$humidityDataJSON = json_encode($humidityData);
?>

<div class="w-full md:w-1/2 xl:w-1/3 p-6">
    <div class="bg-white border-transparent rounded-lg shadow-xl">
        <div class="bg-green-500 uppercase text-white border-b-2 border-green-600 rounded-tl-lg rounded-tr-lg p-2">
            <h5 class="font-bold uppercase text-white text-center"><?php echo utf8_encode("Gráfico Umidade Relativa do Ar") ?></h5>
        </div>
        <div class="text-center">
            <h4 class="humidityColor text-4xl mt-4 mb-2"><i class="fas fa-tint"></i> UMIDADE RELATIVA</h4>
            <h4 class="humidityColor text-4xl mb-2">DO AR</h4>
            <!-- Canvas for the humidity chart -->
            <canvas id="humidityChart" width="400" height="200"></canvas>
        </div>
        <!-- Script to populate and render the humidity chart -->
        <script>
            // Recupere os dados JSON da variável PHP
            var humidityData = <?php echo $humidityDataJSON; ?>;

            // Extrair rótulos de tempo e valores de umidade do ar dos dados
            var labels = humidityData.map(function(entry) {
                return entry.time;
            });
            var humidityValues = humidityData.map(function(entry) {
                return entry.humidity;
            });

            // Obtenha o elemento canvas
            var ctx = document.getElementById('humidityChart').getContext('2d');

            // Crie o gráfico de umidade do ar
            var humidityChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Umidade do Ar',
                        data: humidityValues,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Cor de fundo para a linha
                        borderColor: 'rgba(54, 162, 235, 1)', // Cor da linha
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
</div>
     
                    
                    
                    
                    
                    
<?php
// Consulta SQL para recuperar os últimos 30 registros de temperatura

$sql = "SELECT time, temperature FROM esp32_table_dht11_leds_record ORDER BY date DESC, time DESC LIMIT 30";

// Execute a consulta SQL
$result = mysqli_query($conn, $sql);

// Inicialize uma matriz para armazenar os dados de temperatura
$temperatureData = array();

// Verifica se a consulta foi bem-sucedida e se há pelo menos um registro retornado
if ($result && mysqli_num_rows($result) > 0) {
    // Loop através dos resultados e armazena os dados de temperatura na matriz
    while ($row = mysqli_fetch_assoc($result)) {
        $temperatureData[] = $row;
    }
}

// Converta a matriz $temperatureData em JSON para que possa ser usada no JavaScript
$temperatureDataJSON = json_encode($temperatureData);
?>

<div class="w-full md:w-1/2 xl:w-1/3 p-6">
    <div class="bg-white border-transparent rounded-lg shadow-xl">
        <div class="bg-green-500 uppercase text-white border-b-2 border-green-600 rounded-tl-lg rounded-tr-lg p-2">
            <h5 class="font-bold uppercase text-white text-center"><?php echo utf8_encode("Gráfico Temperatura Ambiente") ?></h5>
        </div>
        <div class="text-center">
            <h4 class="temperatureColor text-4xl mt-4 mb-2"><i class="fas fa-thermometer-half"></i> TEMPERATURA</h4>
            <h4 class="temperatureColor text-4xl mb-2"></i>AMBIENTE</h4>
            <!-- Canvas for the temperature chart -->
            <canvas id="temperatureChart" width="400" height="200"></canvas>
        </div>
        <!-- Script to populate and render the temperature chart -->
        <script>
            // Recupere os dados JSON da variável PHP
            var temperatureData = <?php echo $temperatureDataJSON; ?>;

            // Extrair rótulos de tempo e valores de temperatura dos dados
            var labels = temperatureData.map(function(entry) {
                return entry.time;
            });
            var temperatures = temperatureData.map(function(entry) {
                return entry.temperature;
            });

            // Obtenha o elemento canvas
            var ctx = document.getElementById('temperatureChart').getContext('2d');

            // Crie o gráfico de temperatura
            var temperatureChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Temperatura',
                        data: temperatures,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Cor de fundo para a linha
                        borderColor: 'rgba(255, 99, 132, 1)', // Cor da linha
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
</div>

                    <?php
                }
            }
        }
    } else {
        // Se for diferente de "esp32_01", exibe a mensagem "Placa não monitorada"
        ?>
                        <div class="container-fluid">

                    <!-- Page Heading -->
                     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Monitoramento:</h1>
        <div>
            <a href="#" class="btn btn-sm btn-danger shadow-sm mr-2" onclick="window.history.back();"><i class="fas fa-arrow-left fa-sm text-white-50"></i> <?php echo utf8_encode("Voltar"); ?></a>
            <a href="bwdates-report-ds.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> <?php echo utf8_encode("Relatórios"); ?></a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row"> 
                      
      <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                       
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                   
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                             <i class="fas fa-chart-line"></i> <?php  echo utf8_encode("Voltar")?></div></br>
                                            
                                              <button class="h5 mb-0 font-weight-bold text-gray-800" onclick="window.history.back();"><?php echo utf8_encode("Placa não Monitorada") ?></button>

                                             </div>
                                       
                                        <div class="col-auto"> 
                                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                                        </div> 
                                    </div>
                                </div>
                                 </a>
                            </div>
                        </div>
                      
                             </br>
        </div>
         </div>
</div>

                      
                      <?php
    }
} else {
    echo "O parâmetro 'fmid' não foi fornecido na URL.";
}
?>
   
    <script>
      //------------------------------------------------------------
      document.getElementById("ESP32_01_Temp").innerHTML = "NN"; 
      document.getElementById("ESP32_01_Soil_Humd").innerHTML = "NN";
      document.getElementById("ESP32_01_Humd").innerHTML = "NN";
      document.getElementById("ESP32_01_Status_Read_DHT11").innerHTML = "NN";
      document.getElementById("ESP32_01_LTRD").innerHTML = "NN";
      //------------------------------------------------------------
      
      Get_Data("esp32_01");
      
      setInterval(myTimer, 5000);
      
      //------------------------------------------------------------
      function myTimer() {
        Get_Data("esp32_01");
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function Get_Data(id) {
				if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            const myObj = JSON.parse(this.responseText);
            if (myObj.id == "esp32_01") {
              document.getElementById("ESP32_01_Temp").innerHTML = myObj.temperature;
              document.getElementById("ESP32_01_Humd").innerHTML = myObj.humidity;
	      document.getElementById("ESP32_01_Soil_Humd").innerHTML = myObj.soil_humidity;
              document.getElementById("ESP32_01_Status_Read_DHT11").innerHTML = myObj.status_read_sensor_dht11;
               document.getElementById("sensor1").innerHTML = myObj.status_read_sensor_dht11;
                document.getElementById("sensor2").innerHTML = myObj.status_read_sensor_dht11;
              document.getElementById("ESP32_01_LTRD").innerHTML = "Time : " + myObj.ls_time + " | Date : " + myObj.ls_date + " (dd-mm-yyyy)";
              if (myObj.LED_01 == "ON") {
                document.getElementById("ESP32_01_TogLED_01").checked = true;
              } else if (myObj.LED_01 == "OFF") {
                document.getElementById("ESP32_01_TogLED_01").checked = false;
              }
              if (myObj.LED_02 == "ON") {
                document.getElementById("ESP32_01_TogLED_02").checked = true;
              } else if (myObj.LED_02 == "OFF") {
                document.getElementById("ESP32_01_TogLED_02").checked = false;
              }
            }
          }
        };
        xmlhttp.open("POST","getdata.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id="+id);
			}
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function GetTogBtnLEDState(togbtnid, otherbtnid) {
  var togbtn = document.getElementById(togbtnid);
  var otherbtn = document.getElementById(otherbtnid);
  if (togbtn.checked) {
    otherbtn.disabled = true;
  } else {
    otherbtn.disabled = false;
  }
  
  

        if (togbtnid == "ESP32_01_TogLED_01") {
          var togbtnchecked = document.getElementById(togbtnid).checked;
          var togbtncheckedsend = "";
          if (togbtnchecked == true) togbtncheckedsend = "ON";
          if (togbtnchecked == false) togbtncheckedsend = "OFF";
          Update_LEDs("esp32_01","LED_01",togbtncheckedsend);
        }
        if (togbtnid == "ESP32_01_TogLED_02") {
          var togbtnchecked = document.getElementById(togbtnid).checked;
          var togbtncheckedsend = "";
          if (togbtnchecked == true) togbtncheckedsend = "ON";
          if (togbtnchecked == false) togbtncheckedsend = "OFF";
          Update_LEDs("esp32_01","LED_02",togbtncheckedsend);
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function Update_LEDs(id,lednum,ledstate) {
				if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            //document.getElementById("demo").innerHTML = this.responseText;
          }
        }
        xmlhttp.open("POST","updateLEDs.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id="+id+"&lednum="+lednum+"&ledstate="+ledstate);
			}
      //------------------------------------------------------------
    </script>



</body>

                    <!-- Content Row -->

              

             

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