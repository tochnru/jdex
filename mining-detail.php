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
         <div class="header-detail">
            <div class="gold-detail">
               <div class="gold-detail__top">1</div>
               <p class="gold-detail__txt">Место</p>
               <p class="gold-detail__data-gold">514.38</p>
               <p class="gold-detail__data-txt">кг</p>
            </div>
            <div class="chart-detail">
               <p class="chart-detail__name-mining">Королевское</p>
               <p class="chart-detail__type-mining">месторождение</p>
               <div class="box-chart">
                  <div class="box-chart__bar"></div>
                  <div class="box-chart__bar"></div>
                  <div class="box-chart__bar"></div>
                  <div class="box-chart__bar"></div>
                  <div class="box-chart__bar"></div>
                  <div class="box-chart__bar"></div>
                  <div class="box-chart__bar"></div>
               </div>
            </div>
         </div>

         <div class="table-detail">
            <div class="table-detail__header">
               <p class="table-detail__data">Месяц</p>
               <p class="table-detail__data">Пески</p>
               <p class="table-detail__data">Вскрыша</p>
               <p class="table-detail__data">ГПР</p>
               <p class="table-detail__data">Золото</p>
            </div>
            <div class="table-detail__string">
               <p class="table-detail__data">Май</p>
               <p class="table-detail__data">100.5</p>
               <p class="table-detail__data">200.1</p>
               <p class="table-detail__data">560.6</p>
               <p class="table-detail__data">170.89</p>
            </div>
            <div class="table-detail__string">
               <p class="table-detail__data">Июн</p>
               <p class="table-detail__data">15.3</p>
               <p class="table-detail__data">18.1</p>
               <p class="table-detail__data">50.6</p>
               <p class="table-detail__data">12.89</p>
            </div>
            <div class="table-detail__string">
               <p class="table-detail__data">Июл</p>
               <p class="table-detail__data">22.0</p>
               <p class="table-detail__data">18.7</p>
               <p class="table-detail__data">25.9</p>
               <p class="table-detail__data">9.27</p>
            </div>
            <div class="table-detail__string">
               <p class="table-detail__data">Авг</p>
               <p class="table-detail__data">45.1</p>
               <p class="table-detail__data">15.2</p>
               <p class="table-detail__data">12.3</p>
               <p class="table-detail__data">8.47</p>
            </div>
            <div class="table-detail__string">
               <p class="table-detail__data">Сен</p>
               <p class="table-detail__data">21.1</p>
               <p class="table-detail__data">19.4</p>
               <p class="table-detail__data">13.7</p>
               <p class="table-detail__data">21.09</p>
            </div>
            <div class="table-detail__string">
               <p class="table-detail__data">Окт</p>
               <p class="table-detail__data">20.1</p>
               <p class="table-detail__data">125.1</p>
               <p class="table-detail__data">12.3</p>
               <p class="table-detail__data">3.25</p>
            </div>
            <div class="table-detail__footer">
               <p class="table-detail__data">ИТОГО</p>
               <p class="table-detail__data">150.4</p>
               <p class="table-detail__data">1000.2</p>
               <p class="table-detail__data">80.8</p>
               <p class="table-detail__data">300.27</p>
            </div>
         </div>
      </div>
   </main>
   


   <script src="js/swiper-bundle.min.js"></script>
   <script src="js/slider-mining.js"></script>
</body>

</html>