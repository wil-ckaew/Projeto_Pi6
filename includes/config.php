<?php
//time zone
date_default_timezone_set('America/Sao_Paulo');
//database connection
$con=mysqli_connect("","","","");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}

  ?>


