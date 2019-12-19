<?php
  // Include db config
  require_once 'db.php';
  require_once 'fuction.php'
?>

<?php

   date_default_timezone_set('Asia/Kolkata'); // Set your Time Zone Here

   function em_getallheaders(){
        $headers = [];
        foreach ($_SERVER as $name => $value) {
           if (substr($name, 0, 5) == 'HTTP_') {
               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
              }
         }
      return $headers;
   }
   function convertUrlQuery($query){
        $queryParts = explode('&', $query);
        $params = array();
        foreach ($queryParts as $param) {
            $item = explode('=', $param);
            $params[$item[0]] = $item[1];
        }
        return $params;
    }
   
   function array2string($array){
        $string = [];
        if($array && is_array($array)){
            foreach ($array as $key=> $value){
               $string[] = $key.': '.$value;
               }
        }
        return implode(',',$string);
   }
   function array3string($array){
        $string = [];
        if($array && is_array($array)){
            foreach ($array as $key=> $value){
               $string[] = $key.'='.$value;
               }
        }
        return implode(',',$string);
   }
    
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
