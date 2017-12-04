<?php

function connect_db($db){
   if($db==1){
       try {
        $conn = new PDO("mysql:host=localhost;dbname=account_net;charset=UTF8", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }  
    catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    return $conn;
   }
   else if($db==2){
        try {
        $conn = new PDO("mysql:host=localhost;dbname=retirada_net;charset=UTF8", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }  
    catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    return $conn;
   }
}
?>