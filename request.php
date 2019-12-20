<?php
  // Include db config
  require_once 'db.php';
  require_once 'fuction.php'
?>

<?php

   date_default_timezone_set('Asia/Shanghai'); // Set your Time Zone Here
    
   $ip = $_SERVER['REMOTE_ADDR'];
   $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
   $country = $details->country; 
   $parameter = $_SERVER["QUERY_STRING"];
   $parameter = convertUrlQuery($parameter);
   $parameter = array3string($parameter);
   $header= em_getallheaders();
   $header=array2string($header);
   $datex = date('Y/m/d');
   $timex = date('G:i:s');
   if($parameter == '='){
         $parameter = 'null';
   }


    $sql = 'INSERT INTO xssrf_logs (ip, country, header, parameter,datex, timex) VALUES (:ip, :country, :header, :parameter, :datex, :timex)';
    if($stmt = $pdo->prepare($sql)){
        
        $stmt->bindParam(':ip', $ip);
        $stmt->bindParam(':country', $country);
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
