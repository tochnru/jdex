<?php
   $hostname = "127.0.0.1";
   $username = "root";
   $password = "root";
   $database = "jdex";

   $connect = mysqli_connect($hostname, $username, $password, $database);
   
   if($connect == false){
      echo "Ошибка подключения к БД";
      exit();
   }
?>