<?php
   session_start();
   require "connect.php";
   require "name-admin.php";
   require "function.php";

   if(!isset($_POST["btn-submit"])){//Проверка нажата кнопка Зарегистрироваться
      header("Location: ../add-menu.php");
      exit();
   }

   if(isset($_COOKIE["token"])){
      $token = $_COOKIE["token"];
      $query_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `token` = '$token'");
      $query_user_assoc = mysqli_fetch_assoc($query_user);
   }else{
      header("Location: ../index.php");
      exit();
   }
   if($token != $query_user_assoc["token"] or $query_user_assoc["login"] != $name_admin){
      header("Location: ../index.php");
      exit();
   }

   $name_mining = $_POST["name-mining"];
   $name_img = $_POST["name-img"];
   $path_img = "img/icon-mining/" . $name_img;

   emptyInput($name_mining, $data_name["mining"], "../add-menu.php");

   //Проверка месторождения в БД
   $query_mining = mysqli_query($connect, "SELECT * FROM `mining` WHERE `names` = '$name_mining'");
   $query_mining_assoc = mysqli_fetch_assoc($query_mining);

   if($name_mining == @$query_mining_assoc["names"]){
      $_SESSION["error-reg"] = '<p class="error-reg">Месторождение уже существует</p>';
      header("Location: ../add-menu.php");
      exit();
   }
   //Запись в БД
   $insert_mining = mysqli_query($connect, "INSERT INTO `mining` (`names`, `img`,  `archive`) VALUES ( '$name_mining', '$path_img',  0)");
   $_SESSION["success-reg"] = '<p class="success-reg">Месторождение добавлено</p>';
   header("Location: ../add-menu.php");
?>