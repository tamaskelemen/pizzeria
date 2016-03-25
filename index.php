<?php

$_SESSION['termek'] = null;
include_once "dbcon.php"; ?>
<html>
<head>
	<title>Kiskakas Pizzéria</title>
	<meta http-equiv="Content-Type" content="text/html; "charset = 'utf-8'>
	<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
	
</head>

<body>
	<!-- banner .... ......................................................................................................................... -->
	<div class = "banner">
		<a href= 'index.php'><img class='img' src='pizza.jpg'></a>
	</div>
	<!-- banner vége........................................................................................................................... -->		
	<!-- menu .................................................................................................................................. -->
	<div class="menu">		
		<a class="link" href="index.php">	<div class = 'menu-pont'  >Főoldal</div>	</a>
		<a class="link" href="index.php?menu=pizzak">	<div class = 'menu-pont'  >	Pizzák	</div>	</a>
		<a class="link" href="index.php?menu=hamburger">	<div class = 'menu-pont'  >	Hamburgerek	</div></a>
		<a class="link" href="index.php?menu=kosar"> 	<div class = 'menu-pont'  >	Kosár	</div></a>
		<a class="link" href="index.php?menu=contact">	 <div class = 'menu-pont'  >Kapcsolat	</div></a>		
	</div>
	<!-- Menu vege ..........................................................................................................................-->
	<br>
	<!--Main div.....................................................................................................................-->
	<div class="tartalom">
		<?php 
			if(isset($_GET['menu'])){
				if($_GET['menu'] == 'pizzak'){
					include "pizzak.php";
				}
				else if($_GET['menu'] == 'hamburger'){
					include "hamburger.php";
				}
				else if($_GET['menu'] == 'kosar'){
					include "kosar.php";
				}
				else if($_GET['menu'] == 'contact'	){
					include 'contact.php';
				}
			}else{
				echo "<h1 style= 'text-align: center'>Nyitvatartás</h1>
					<h3 style = 'text-align: center'> 11.00 - 20.00</h3>
				
				";
			}
		?>		
	</div>	
	<!-- Main div vege .....................................................................................................................................-->
	<!-- Also div ..........................................................................................................................................-->
	<div class='alja'>
		<a href='index.php' class= 'link'>Copyright</a>
	</div>
	<!-- Also div vege........................................................................................................................................-->
	</body>
</html>