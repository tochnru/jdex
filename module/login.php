<?php
   session_start();
   if(!isset($_POST["btn-submit"])){//Проверка нажата кнопка подтвердить
      header("Location: ../index.php");
      exit();
   }
   require "connect.php";
   require "function.php";

   $login = trim($_POST["login"]);
   $password = trim($_POST["password"]);

   emptyInput($login, $data_name["login"], "../index.php");
   emptyInput($password, $data_name["password"], "../index.php");

   strlenLargerInput($login, $data_name["login"], 20);
   strlenLargerInput($password, $data_name["password"], 20);

   $query_login = mysqli_query($connect,"SELECT * FROM `users` WHERE `login` = '$login'");
   $query_login_assoc = mysqli_fetch_assoc($query_login);

   $password_decrypted = password_verify($password, $query_login_assoc["password"]);

   if($query_login_assoc["login"] != $login or $password_decrypted == false){
      $_SESSION['error-reg'] = '<p class="error-reg">Ошибка: Не верный логин или пароль</p>';
      header("Location: ../index.php");
      exit();
   }else{
      $token = password_hash(bin2hex(random_bytes(30)), PASSWORD_DEFAULT);
      $query_token_update =mysqli_query($connect, "UPDATE `users` SET `token` = '$token' WHERE `login` = '$login'");
      setcookie("token", $token, time()+60*60*24*30, "/");
      header("Location: ../mining.php");
   }
?> 