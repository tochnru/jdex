<?php
   session_start();
   require "module/connect.php";

   if(isset($_COOKIE["token"])){
      $token = $_COOKIE["token"];
      $query_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `token` = '$token'");
      $query_user_assoc = mysqli_fetch_assoc($query_user);
   }else{
      header("Location: index.php");
      exit();
   }
   if($token != $query_user_assoc["token"]){
      header("Location: index.php");
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
   <link rel="stylesheet" href="css/swiper-bundle.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/fonts.css">
   <link rel="icon" href="img/global/favicon.png" type="image/png">
   <title><?php echo $query_organization_assoc["name"]?></title>
</head>

<body>
   <main class="main">
      <div class="container">
         <div class="top-header">
            <div class="box-logo">
               <img class="box-logo__img" src="img/global/logo.svg" alt="">
               <p class="box-logo__name"><?php echo $query_organization_assoc["name"]?></p>
            </div>
            <div class="box-mining-btn">
               <?php
                  require "module/name-admin.php";
                  if($query_user_assoc['login'] == $name_admin){?>
                     <a href="add-menu.php">
                        <img class="btn-gear" src="img/mining/gear.svg" alt="gear">
                     </a>
                  <?php
                  }
               ?>
               <a href="module/logout.php">
                  <img class="btn-logout" src="img/mining/out-icon.svg" alt="exit">
               </a>
            </div>
         </div>
      </div>
   </main>
   


   <script src="js/swiper-bundle.min.js"></script>
   <script src="js/slider-mining.js"></script>
</body>

</html>