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

   $login = $_POST["login"];
   $password = $_POST["password"];
   $family = $_POST["family"];
   $name = $_POST["name"];
   $patronymic = $_POST["patronymic"];
   $job = $_POST["job"];
   $subdivision = $_POST["subdivision"];
   $token = 0;

   emptyInput($login, $data_name["login"], "../add-menu.php");

   //Проверка логина в БД
   $query_login = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
   $query_login_assoc = mysqli_fetch_assoc($query_login);

   if($login == @$query_login_assoc["login"]){
      $_SESSION["error-reg"] = '<p class="error-reg">Данный логин занят</p>';
      header("Location: ../add-menu.php");
      exit();
   }
   //Зашифровываем пароль
   $password_encrypt = password_hash($password, PASSWORD_DEFAULT);
   //Запись в БД
   $insert_login = mysqli_query($connect, "INSERT INTO `users` (`login`, `password`, `family`, `name`, `patronymic`, `job`, `subdivision`, `token`) VALUES ( '$login', '$password_encrypt', '$family', '$name', '$patronymic', '$job', '$subdivision', '$token')");

   $_SESSION["success-reg"] = '<p class="success-reg">Пользователь зарегистрирован</p>';
   header("Location: ../add-menu.php");
?>