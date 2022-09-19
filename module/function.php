<?php
   $data_name = [
      "login" => "логин",
      "password" => "пароль",
      "mining" => "месторождение",
   ];
   function emptyInput($data, $data_name, $path){
      if(empty($data)){
         $_SESSION["error-reg"] = "<p class=\"error-reg\">Введите {$data_name}</p>";
         header("Location: ../{$path}");
         exit();
      }
   }
   function strlenLargerInput($data, $data_name, $lenght){
      if(mb_strlen($data) > $lenght){// подсчет символов в строке
         $_SESSION["error-reg"] = "<p class=\"error-reg\">Ошибка: Длинный {$data_name}</p>";
         header("Location: ../index.php");
         exit();
      }
   }
?>