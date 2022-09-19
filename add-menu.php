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
   <title>Меню добавления</title>
</head>

<body>
   <main class="main">
      <div class="wrapper-add container">
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
         <nav class="add-menu">
            <?php
               echo @$_SESSION["error-reg"];
               unset($_SESSION["error-reg"]);
               echo @$_SESSION["success-reg"];
               unset($_SESSION["success-reg"]);
            ?>
            <div class="add-menu__btn" id="btn-add-user">
               <div class="add-menu__box-img">
                  <img class="add-menu__img" src="img/add-menu/add-user.svg" alt="">
               </div>
               <p class="add-menu__name">Новый пользователь</p>
            </div>
            <div class="add-menu__btn" id="btn-add-mining">
               <div class="add-menu__box-img">
                  <img class="add-menu__img" src="img/add-menu/new-mining.svg" alt="">
               </div>
               <p class="add-menu__name">Новое месторождение</p>
            </div>
            <div class="add-menu__btn" id="btn-add-geology">
               <div class="add-menu__box-img">
                  <img class="add-menu__img" src="img/add-menu/geology-data.svg" alt="">
               </div>
               <p class="add-menu__name">Геологические данные</p>
            </div>
            <div class="add-menu__btn">
               <div class="add-menu__box-img">
                  <img class="add-menu__img" src="img/add-menu/document.svg" alt="">
               </div>
               <p class="add-menu__name">Данные добычи</p>
            </div>
            <div class="add-menu__btn">
               <div class="add-menu__box-img">
                  <img class="add-menu__img" src="img/add-menu/delete-notes.svg" alt="">
               </div>
               <p class="add-menu__name">Удалить записи</p>
            </div>
         </nav>
         <!--Форма новый пользователь-->
         <div class="wrapper-form-add" id="menu-add-user">
            <form class="form-add" action="module/add-user.php" method="post">
               <h1 class="form-add__h1">Новый пользователь</h1>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required"  maxlength="20" value="" name="login">
                  <span class="add-inpun-box__span">Логин</span>
               </div>
               <div class="add-inpun-box">
                  <?php
                     $password = bin2hex(random_bytes(3));
                  ?>
                  <input class="add-inpun-box__input" type="text" required="required" maxlength="20" value="<?php echo $password;?>" name="password">
                  <span class="add-inpun-box__span">Пароль</span>
               </div>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required" maxlength="20" value="" name="family">
                  <span class="add-inpun-box__span">Фамилия</span>
               </div>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required" maxlength="20" value="" name="name">
                  <span class="add-inpun-box__span">Имя</span>
               </div>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required" maxlength="20" value="" name="patronymic">
                  <span class="add-inpun-box__span">Отчество</span>
               </div>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required" maxlength="20" value="" name="job">
                  <span class="add-inpun-box__span">Должность</span>
               </div>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required" maxlength="20" value="" name="subdivision">
                  <span class="add-inpun-box__span">Участок</span>
               </div>
               <input class="btn-add" type="submit" value="ЗАРЕГИСТРИРОВАТЬ" name="btn-submit">
               <div class="close-menu-add" id="close-add-user">X</div>
            </form>
         </div>
         <!--Форма новое месторождение-->
         <div class="wrapper-form-add" id="menu-add-mining">
            <form class="form-add" action="module/add-mining.php" method="post" enctype="multipart/form-data">
               <h1 class="form-add__h1">Новое месторождение</h1>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required"  maxlength="20" value="" name="name-mining">
                  <span class="add-inpun-box__span">Название</span>
               </div>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required"  maxlength="10" value="" name="name-img">
                  <span class="add-inpun-box__span">Изображение</span>
               </div>
               <input class="btn-add" type="submit" value="ДОБАВИТЬ" name="btn-submit">
               <div class="close-menu-add" id="close-add-mining">X</div>
            </form>
         </div>
         <!--Форма геологические данные-->
         <div class="wrapper-form-add" id="menu-add-geology">
            <form class="form-add" action="module/add-geology.php" method="post" enctype="multipart/form-data">
               <h1 class="form-add__h1">Геологические данные</h1>

               <select class="add-input-select" name="mining" required="required">
                  <option class="add-input-option" value="Выберите месторождение">Выберите месторождение</option>
                  <?php
                     $query_mining= mysqli_query($connect, "SELECT * FROM `mining` WHERE `archive` = 0");
                     while($query_mining_assoc = mysqli_fetch_assoc($query_mining)){?>
                        <option class="add-input-option" value="<?php echo $query_mining_assoc["names"]?>"><?php echo $query_mining_assoc["names"]?></option>
                     <?php
                     }
                  ?>
               </select>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required"  maxlength="20" value="" name="block">
                  <span class="add-inpun-box__span">Блок</span>
               </div>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required"  maxlength="10" value="" name="area">
                  <span class="add-inpun-box__span">Площадь</span>
               </div>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required"  maxlength="10" value="" name="power-pesok">
                  <span class="add-inpun-box__span">Мощность песков</span>
               </div>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required"  maxlength="10" value="" name="power-torf">
                  <span class="add-inpun-box__span">Мощность торфов</span>
               </div>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required"  maxlength="10" value="" name="volume-pesok">
                  <span class="add-inpun-box__span">Объем песков</span>
               </div>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required"  maxlength="10" value="" name="volume-torf">
                  <span class="add-inpun-box__span">Объем торфов</span>
               </div>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required"  maxlength="10" value="" name="soderzhaniye">
                  <span class="add-inpun-box__span">Содержание</span>
               </div>
               <div class="add-inpun-box">
                  <input class="add-inpun-box__input" type="text" required="required"  maxlength="10" value="" name="gold">
                  <span class="add-inpun-box__span">Запасы золота</span>
               </div>


               <input class="btn-add" type="submit" value="ДОБАВИТЬ" name="btn-submit">
               <div class="close-menu-add" id="close-add-geology">X</div>
            </form>
         </div>
      </div>
   </main>



<script src="js/add.js"></script>
</body>

</html>