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
         <nav class="mining-menu">
            <?php
               require "module/connect.php";
               $this_year = date("Y");
               $select_mining = mysqli_query($connect, "SELECT * FROM `mining` WHERE `archive` = 0 ORDER BY `names`");

               while($select_mining_assoc = mysqli_fetch_assoc($select_mining)){
                  $sum_gold = mysqli_query($connect, "SELECT  SUM(`gold`) AS `sum` FROM `data_fact` WHERE `mining` ='$select_mining_assoc[names]' AND `year` = $this_year") ;
                  $sum_gold_assoc = mysqli_fetch_assoc($sum_gold);
               ?>
                  <a href="mining-detail.php?id=<?php echo $select_mining_assoc["id"]?>" class="mining-link">
                     <img src="<?php echo $select_mining_assoc["img"]?>" alt="" class="mining-link__img">
                     <p class="mining-link__name"><?php echo $select_mining_assoc["names"]?></p>
                     <p class="mining-link__data-gold"><?php echo $sum_gold_assoc["sum"]?> кг</p>
                  </a>
               <?php
               }
            ?>
         </nav>
         <div class="box-total">
            <div class="mining-total">
               <div class="mining-total__line mining-total__line--green"></div>
               <?php
                  $sum_gold_total = mysqli_query($connect, "SELECT ROUND(SUM(`gold`), 2) AS `sum` FROM `data_fact` WHERE `year` = $this_year and `archive` = 0;");
                  $sum_gold_total_assoc = mysqli_fetch_assoc($sum_gold_total);
                  
                  $sum_pesok_total = mysqli_query($connect, "SELECT ROUND(SUM(`volume_pesok`), 2) AS `sum` FROM `data_fact` WHERE `year` = $this_year and `archive` = 0;");
                  $sum_pesok_total_assoc = mysqli_fetch_assoc($sum_pesok_total);
                  
               ?>
               <p class="mining-total__data"><?php echo $sum_gold_total_assoc["sum"]?> кг</p>
               <p class="mining-total__name">Добыто</p>
            </div>
            <div class="mining-total">
               <div class="mining-total__line mining-total__line--red"></div>
               <p class="mining-total__data"><?php echo $sum_pesok_total_assoc["sum"]?> м<sup>3</sup></p>
               <p class="mining-total__name">Промыто</p>
            </div>
         </div>
         <p class="header-article">Новости</p>
         <!--Слайдер-->
         <div class="event-slider swiper-container">
            <div class="swiper-wrapper">
               <!--Слайд1-->
               <div class="event-slide swiper-slide">
                  <img src="img/article/img-1.svg" alt="" class="event-slide__img">
                  <div class="event-slide__content">
                     <p class="event-slide__header">Темпы золотодобычи</p>
                     <p class="event-slide__txt">В целом по предприятию золотодобыча идет с опережением, по сравнению с
                        предыдущим годом, примерно на 10%.</p>
                  </div>
               </div>
               <!--Слайд2-->
               <div class="event-slide swiper-slide">
                  <img src="img/article/img-2.svg" alt="" class="event-slide__img">
                  <div class="event-slide__content">
                     <p class="event-slide__header">День геолога</p>
                     <p class="event-slide__txt">Через тундру, через реки,</p>
                     <p class="event-slide__txt">Путь геолога лежит.</p>
                     <p class="event-slide__txt">Вами, чудо-человеки,</p>
                     <p class="event-slide__txt">Не единый пласт открыт.</p>
                  </div>
               </div>
               <!--Слайд3-->
               <div class="event-slide swiper-slide">
                  <img src="img/article/img-3.svg" alt="" class="event-slide__img">
                  <div class="event-slide__content">
                     <p class="event-slide__header">Пажароопасный сезон</p>
                     <p class="event-slide__txt">Начался пожароопаснй сезон! Будьте осторожны с огнем, ведь лесные
                        пожары представляют серьезную опасность для всего, что может встретиться на их пути!</p>
                  </div>
               </div>
            </div>
            <!--Кнопки пролистывания-->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <!--Пагинация-->
            <div class="swiper-pagination"></div>
         </div>
      </div>
   </main>
   
   <script src="js/swiper-bundle.min.js"></script>
   <script src="js/slider-mining.js"></script>
</body>

</html>