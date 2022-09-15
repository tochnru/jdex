<?php
   session_start();
   require "connect.php";

   if(isset($_COOKIE["token"])){
      $token = $_COOKIE["token"];
      $query_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `token` = '$token'");
      $query_user_assoc = mysqli_fetch_assoc($query_user);
   }else{
      header("Location: ../index.php");
      exit();
   }
   if($token != $query_user_assoc["token"]){
      header("Location: ../index.php");
      exit();
   }

   $logout_token = password_hash(bin2hex(random_bytes(30)), PASSWORD_DEFAULT);
   $query_token_update = mysqli_query($connect, "UPDATE `users` SET `token` = '$logout_token' WHERE `token` = '$token'");
   unset($_SESSION);
   setcookie("token", $token , time() - 3600, "/");
   header("Location: ../index.php");
?>