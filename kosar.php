
<?php 
session_start();
//get current url, erre fog visszabaszni kosar_feldolgoz.php
	$current_url = base64_encode("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

	echo "<h2 style='margin-left: 15px'> Kosár </h2>";
	
	//ha van van kosarba termek, kiiratja tabla-ba
	if(isset($_SESSION['termek'])){		
		$summary=0;
	//teljes session kiiratas
	
			
		//tablazat		
		echo "<table class='tabla'>";		
		foreach($_SESSION['termek'] as $cartitems){				
			echo "<form enctype='multiport/form-data' method='post' action='kosar_feldolgoz.php' id='pizza_form'>";			
			echo "
			<tr class = 'tabla-sor'>			
			<td>".$cartitems['id'].".</td>
			<td> <b>".$cartitems['nev']."</b> (".$cartitems['feltet']." )</td>
			<td>".$cartitems['ar']." Ft</td>
			<td>".$cartitems['mennyiseg']." db</td>
			<td><input type='submit' class='kosarba_button'value='Törlés a kosárból!'> </td>
			</tr>
			<input type='hidden' name='return_url' value='".$current_url."'>
			<input type='hidden' name='type' value='remove' >
			<input type='hidden' name='id' value='".$cartitems['id']."'>
			<input type='hidden' name='nev' value='".$cartitems['nev']."'>
			<input type='hidden' name='feltet' value='".$cartitems['feltet']."'>
			<input type='hidden' name='ar' value='".$cartitems['ar']."'>
			<input type='hidden' name='mennyiseg' value='".$cartitems['mennyiseg']."'>";
			$summary += $cartitems['ar']*$cartitems['mennyiseg'];
			echo "</form>";
		}
		
		echo "<tr style = 'background-color: #3d0000' >
		<td></td>
		<td style = 'text-align: right'>Összesen:&nbsp&nbsp</td>
		<td style='border-top: solid #ffffff;'>".$summary." Ft </td>
		<td></td>
		<td></td>";
		
		
		echo "</table>";
		//tablazat vege
		
		//user adatok
		echo "Neved: <input type='text' name='neve'><br><br>
			email cím: <input type='text' name='email'><br><br>
			megjegyzés: <br><textarea name='megjegyzes' rows='4' cols='75' > </textarea><br>
		
		";
		
		
		
		
			
	}else{		//ha ures a session
		echo "A kosár jelenleg üres!<br>";	
	}

	
	echo "<br><form enctype='multiport/form-data' method='post' action='kosar_feldolgoz.php' id='pizza_form'>	
		<input type='hidden' name='type' value='empty' >
		<input type ='submit' class='kosarba_button' style='margin-left: 15px' name='asd' value = 'Kosár ürítése' >
		<input type='hidden' name='return_url' value='".$current_url."'>
		</form>";
?>

