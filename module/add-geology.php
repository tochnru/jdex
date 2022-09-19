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

   $mining = $_POST["mining"];
   $block = $_POST["block"];
   $area = $_POST["area"];
   $power_pesok = $_POST["power-pesok"];
   $power_torf = $_POST["power-torf"];
   $volume_pesok = $_POST["volume-pesok"];
   $volume_torf = $_POST["volume-torf"];
   $soderzhaniye = $_POST["soderzhaniye"];
   $gold = $_POST["gold"];

   if($mining == "Выберите месторождение"){
      $_SESSION["error-reg"] = "<p class=\"error-reg\">Месторождение не выбрано</p>";
      header("Location: ../add-menu.php");
      exit();
   }
   //Проверка блока в БД
   $query_block = mysqli_query($connect, "SELECT `block` FROM `data_geology` WHERE `mining` = '$mining' AND `block` = '$block'");
   $query_block_assoc = mysqli_fetch_assoc($query_block);

   if($block == @$query_block_assoc["block"]){
      $_SESSION["error-reg"] = '<p class="error-reg">Блок уже существует</p>';
      header("Location: ../add-menu.php");
      exit();
   }

   //Запись в БД
   $insert_geology= mysqli_query($connect, "INSERT INTO `data_geology` (`mining`, `block`, `area`, `power_pesok`, `power_torf`, `volume_pesok`, `volume_torf`, `soderzhaniye`, `gold`) VALUES ( '$mining', '$block', '$area', '$power_pesok', '$power_torf', '$volume_pesok', '$volume_torf', '$soderzhaniye', '$gold')");
   $_SESSION["success-reg"] = '<p class="success-reg">Блок добавлен</p>';
   header("Location: ../add-menu.php");
?>