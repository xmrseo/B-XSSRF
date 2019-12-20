<?php

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
               $string[] = $key.': '.$value."<br />\n";
               }
        }
        return implode(' ',$string);
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
?>