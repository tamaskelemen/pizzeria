<?php
session_start();
require_once 'models/App.php';
require_once 'models/FileHandler.php';
require_once 'models/Flash.php';
require_once 'models/User.php';

?>
<html lang="hu">
<head>
	<title>Kiskakas Pizzéria</title>
	<meta http-equiv="Content-Type" content="text/html;" charset = 'utf-8'>
	<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
</head>

<body>
	<!-- banner .... ............................................................................................... -->
	<div class = "banner">
		<a href= 'index.php'><img class='img' src='pizza.jpg' alt="banner"></a>
	</div>
	<!-- banner vége................................................................................................ -->
	<!-- menu ...................................................................................................... -->
	<div class="menu">		
		<a class="link" href="index.php">
            <div class = 'menu-pont <?= !isset($_GET['menu']) ? 'active-menu' : '' ?>' >Főoldal</div>
        </a>
		<a class="link" href="index.php?menu=pizzak">
            <div class = 'menu-pont <?= isset($_GET['menu']) && $_GET['menu'] === 'pizzak' ? 'active-menu' : '' ?>' >	Pizzák	</div>
        </a>
		<a class="link" href="index.php?menu=hamburger">
            <div class = 'menu-pont <?= isset($_GET['menu']) && $_GET['menu'] === 'hamburger' ? 'active-menu' : '' ?>'  >	Hamburgerek	</div>
        </a>
		<a class="link" href="index.php?menu=kosar">
            <div class = 'menu-pont <?= isset($_GET['menu']) && $_GET['menu'] === 'kosar' ? 'active-menu' : '' ?>'  >	Kosár	</div>
        </a>

        <?php if (App::instance()->isGuest()) { ?>
        <a class="link" href="index.php?menu=regisztracio">
            <div class = 'menu-pont <?= isset($_GET['menu']) && $_GET['menu'] === 'regisztracio' ? 'active-menu' : '' ?>'  >Regisztráció	</div>
        </a>
		<a class="link" href="index.php?menu=login">
            <div class = 'menu-pont <?= isset($_GET['menu']) && $_GET['menu'] === 'login' ? 'active-menu' : '' ?>'  >Bejelentkezés</div>
        </a>
        <?php } else { ?>
        <a class="link" href="index.php?menu=profil">
            <div class="menu-pont <?= isset($_GET['menu']) && $_GET['menu'] == 'profil' ? 'active-menu' : '' ?>">
               Profil
            </div>
        </a>
        <a class="link" href="logout_controller.php">
            <div class="menu-pont">
                Kilépés (<?= App::instance()->user->email ?>)
            </div>
        </a>

        <?php } ?>
	</div>
	<!-- Menu vege ..................................................................................................-->
	<br>
	<!--Main div.....................................................................................................-->

    <?php
    if (isset($_SESSION['flash_success'])) { ?>
        <div class="flash success"><?= $_SESSION['flash_success'] ?></div>
    <?php
    }

    if (isset($_SESSION['flash_error'])) { ?>
        <div class="flash error"><?= $_SESSION['flash_error'] ?></div>
    <?php
    }
    Flash::destroyFlash();

    ?>

	<div class="tartalom">
		<?php 
			if (isset($_GET['menu'])) {
			    try {
			        require($_GET['menu'] . '.php');
                } catch (Exception $e) {
			        echo $e->getMessage();
                }
			} else {
				echo "<h1 class='text-center'>Nyitvatartás</h1>
					<h3 class='text-center'> 11.00 - 20.00</h3>
				
				";
			}
		?>		
	</div>	
	<!-- Main div vege ..............................................................................................-->
	<!-- Also div ...................................................................................................-->
	<div class='alja'>
		<a href='index.php' class= 'link'>Copyright</a>
	</div>
	<!-- Also div vege...............................................................................................-->
	</body>
</html>