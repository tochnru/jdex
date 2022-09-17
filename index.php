<?php
   session_start();
   require "module/connect.php";
   @$token = $_COOKIE["token"];
   $query_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `token` = '$token'");
   $query_user_assoc = mysqli_fetch_assoc($query_user);

   if(isset($_COOKIE['token']) and @$_COOKIE['token'] == @$query_user_assoc["token"]){
      header("Location: mining.php");
      exit();
   }
   //Запрос предприятия
   $query_organization = mysqli_query($connect, "SELECT * FROM `organization`");
   $query_organization_assoc = mysqli_fetch_assoc($query_organization);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/fonts.css">
   <link rel="icon" href="img/global/favicon.png" type="image/png">
   <title><?php echo $query_organization_assoc["name"]?></title>
</head>

<body>
   <main class="main">
      <div class="container">
         <form class="form-login" action="module/login.php" method="post">
            <div class="login-box-logo">
               <img class="login-box-logo__img" src="img/global/logo.svg" alt="logo">
               <p class="login-box-logo__name"><?php echo $query_organization_assoc["name"]?></p>
            </div>
            <div class="login-inpun-box">
               <input class="login-inpun-box__input" type="text" required="required" maxlength="20" value="test" name="login">
               <span class="login-inpun-box__span">Логин</span>
            </div>
            <div class="login-inpun-box">
               <input class="login-inpun-box__input" type="text" required="required" maxlength="20" value="1234" name="password">
               <span class="login-inpun-box__span">Пароль</span>
            </div>
            <input class="btn-login" type="submit" value="ВОЙТИ" name="btn-submit">
            <?php
               echo @$_SESSION["error-reg"];
               unset($_SESSION["error-reg"]);
            ?>
         </form>
      </div>
   </main>
   
</body>

</html>