<?php
   session_start();
   require "module/connect.php";
   require "module/name-admin.php";

   if(isset($_COOKIE["token"])){
      $token = $_COOKIE["token"];
      $query_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `token` = '$token'");
      $query_user_assoc = mysqli_fetch_assoc($query_user);
   }else{
      header("Location: index.php");
      exit();
   }
   if($token != $query_user_assoc["token"] or $query_user_assoc["login"] != $name_admin){
      header("Location: index.php");
      exit();
   }
   //Запрос предприятия
   $query_organization = mysqli_query($connect, "SELECT * FROM `organization`");
   $query_organization_assoc = mysqli_fetch_assoc($query_organization);

   //Проверка выбрано ли месторождение
   $mining = $_POST["mining-fact"];
   if($mining == "Выберите месторождение"){
      $_SESSION["error-reg"] = "<p class=\"error-reg\">Месторождение не выбрано</p>";
      header("Location: add-menu.php");
      exit();
   }

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
   <title>Добавление блока</title>
</head>

<body>
   <main class="main">
      <div class="wrapper-add container">
         <div class="top-header">
            <div class="box-logo">
               <img class="box-logo__img" src="img/global/logo.svg" alt="">
               <p class="box-logo__name">
                  <?php echo $query_organization_assoc["name"]?>
               </p>
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
         <!--Форма фактические данные-->
         <div class="wrapper-form-add" style="display: block;">
            <form class="form-add" action="module/add-fact.php?mining=<?php echo $mining ?>" method="post">
               <h1 class="form-add__h1">Фактические данные</h1>
               <select class="add-input-select" name="block" required="required">
                  <option class="add-input-option" value="Выберите блок">Выберите блок</option>
                  <?php
                     $query_block= mysqli_query($connect, "SELECT `block` FROM `data_geology` WHERE `mining` = '$mining' AND `archive` = 0");
                     while($query_block_assoc = mysqli_fetch_assoc($query_block)){?>
                        <option class="add-input-option" value="<?php echo $query_block_assoc["block"]?>">
                           <?php echo $query_block_assoc["block"]?>
                        </option>
                  <?php
                     }
                  ?>
                        <option class="add-input-option" value="За контур">За контур</option>
               </select>
               <select class="add-input-select" name="month" required="required">
                  <option class="add-input-option" value="Укажите месяц">Укажите месяц</option>
                  <option class="add-input-option" value="Апрель">Апрель</option>
                  <option class="add-input-option" value="Май">Май</option>
                  <option class="add-input-option" value="Июнь">Июнь</option>
                  <option class="add-input-option" value="Июль">Июль</option>
                  <option class="add-input-option" value="Август">Август</option>
                  <option class="add-input-option" value="Сентябрь">Сентябрь</option>
                  <option class="add-input-option" value="Октябрь">Октябрь</option>
                  <option class="add-input-option" value="Ноябрь">Ноябрь</option>
               </select>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required" maxlength="10" name="year">
                  <span class="add-inpun-box__span">Год</span>
               </div>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required" maxlength="10" name="area">
                  <span class="add-inpun-box__span">Площадь</span>
               </div>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required" maxlength="10" name="volume-pesok">
                  <span class="add-inpun-box__span">Объем песков</span>
               </div>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required" maxlength="10" name="volume-torf">
                  <span class="add-inpun-box__span">Объем торфов</span>
               </div>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required" maxlength="10" name="volume-gpr">
                  <span class="add-inpun-box__span">ГПР</span>
               </div>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required" maxlength="10" name="gold">
                  <span class="add-inpun-box__span">Добыто золото</span>
               </div>

               <input class="btn-add" type="submit" value="ДОБАВИТЬ" name="btn-submit">
               <a href="add-menu.php" class="close-menu-add" style="text-decoration: none;">X</a>
            </form>
         </div>
      </div>
   </main>

</body>

</html>