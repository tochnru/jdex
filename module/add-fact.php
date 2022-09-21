<?php
   session_start();
   require "connect.php";
   require "name-admin.php";

   if(!isset($_POST["btn-submit"])){//Проверка нажата кнопка
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
   //Проверка выбран ли блок
   $block = $_POST["block"];
   if($block == "Выберите блок"){
      $_SESSION["error-reg"] = "<p class=\"error-reg\">Не выбран блок</p>";
      header("Location: ../add-menu.php");
      exit();
   }
   //Проверка выбран ли месяц
   $month = $_POST["month"];
   if($month == "Укажите месяц"){
      $_SESSION["error-reg"] = "<p class=\"error-reg\">Не выбран месяц</p>";
      header("Location: ../add-menu.php");
      exit();
   }

   $mining = $_GET["mining"];
   $block = $_POST["block"];
   $month = $_POST["month"];
   $year = $_POST["year"];
   $area = $_POST["area"];
   $volume_pesok = $_POST["volume-pesok"];
   $volume_torf = $_POST["volume-torf"];
   $volume_gpr = $_POST["volume-gpr"];
   $gold = $_POST["gold"];

   //Запись в БД
   $insert_fact= mysqli_query($connect, "INSERT INTO `data_fact` (`mining`, `block`, `month`, `year`, `area`, `volume_pesok`, `volume_torf`, `volume_gpr`, `gold`, `archive`) VALUES ( '$mining', '$block', '$month', '$year', '$area', '$volume_pesok', '$volume_torf', '$volume_gpr', '$gold', 0)");

   $_SESSION["success-reg"] = '<p class="success-reg">Данные добавлены</p>';
   header("Location: ../add-menu.php");

?>