<?php 	session_start(); ?>
<h2 style='margin-left: 15px'> Pizzáink </h2>
<table class='tabla' >
<?php
	

	//get current url, erre fog visszabaszni kosar_feldolgoz.php
	$current_url = base64_encode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

	//lekerdez
	$p = 'pizza';
	$sql = "SELECT * FROM $p;";
	$eredmeny = mysql_query($sql);
	
	//kiirat
	while ($result = mysql_fetch_array($eredmeny)){
	echo "
	<form enctype='multiport/form-data' method='post' action='kosar_feldolgoz.php' id='pizza_form'>	
	<tr class='tabla-sor'   >
	<td>".$result['sorszam'].".</td>
	<td> <b>".$result['p_nev']."</b> (".$result['feltet'].")</td>
	<td>".$result['p_ar']." Ft</td>
	<td><input type='text' name='mennyiseg' value=1 style='width: 30px'></td>
	<td> <input type='submit' class='kosarba_button'value='Kosárba!'></td>
	</tr>
	<input type='hidden' name='id' value='".$result['sorszam']."'>
	<input type='hidden' name='nev' value='".$result['p_nev']."'>
	<input type='hidden' name='feltet' value='".$result['feltet']."'>
	<input type='hidden' name='ar' value='".$result['p_ar']."'>
	<input type='hidden' name='return_url' value='".$current_url."'>
	<input type='hidden' name='type' value='add' >	
	</form>
	";
	
	}

?>
</table>
