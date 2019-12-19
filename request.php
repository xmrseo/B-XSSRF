<?php
  // Include db config
  require_once 'db.php';
  require_once 'fuction.php'
?>

<?php

   date_default_timezone_set('Asia/Kolkata'); // Set your Time Zone Here
    
   $ip = $_SERVER['REMOTE_ADDR'];
   $parameter = $_SERVER["QUERY_STRING"];
   $parameter = convertUrlQuery($parameter);
   $parameter = array3string($parameter);
   $header= em_getallheaders();
   $header=array2string($header);
   $datex = date('Y/m/d');
   $timex = date('G:i:s');

    $sql = 'INSERT INTO xssrf_logs (ip, header, parameter,datex, timex) VALUES (:ip, :header, :parameter, :datex, :timex)';
    if($stmt = $pdo->prepare($sql)){
        
        $stmt->bindParam(':ip', $ip);
        $stmt->bindParam(':header', $header);
        $stmt->bindParam(':parameter', $parameter);
        $stmt->bindParam(':datex', $datex);
        $stmt->bindParam(':timex', $timex);

    if($stmt->execute()){
		  echo 'YES';
        } else {
		  echo 'NO';
        }
      }

    unset($pdo);
    
?>