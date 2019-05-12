<?php

$current_url = base64_encode("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
?>

<h2 class="title"> Kosár </h2>
<?php

if (isset($_SESSION['termek'])) {
	$summary = 0;
?>
	<table class='tabla'>
<?php foreach ($_SESSION['termek'] as $cartitems) { ?>
		<form method='post' action='kosar_feldolgoz.php' id='pizza_form'>

            <tr class = 'tabla-sor'>
                <td>
                    <?= $cartitems['id'] ?>
                </td>

                <td>
                    <b><?= $cartitems['nev'] ?></b> ( <?=$cartitems['feltet'] ?> )
                </td>

                <td>
                    <?= $cartitems['ar']?> Ft
                </td>

                <td>
                    <?= $cartitems['mennyiseg'] ?> db
                </td>

                <td>
                    <input type='submit' class='kosarba_button' value='Törlés a kosárból!'>
                </td>
            </tr>

            <input type='hidden' name='return_url' value='<?= $current_url ?>'>
            <input type='hidden' name='type' value='remove' >
            <input type='hidden' name='id' value=<?= $cartitems['id'] ?>>
            <input type='hidden' name='nev' value='<?= $cartitems['nev'] ?>'>
            <input type='hidden' name='feltet' value='<?= $cartitems['feltet'] ?>'>
            <input type='hidden' name='ar' value='<?= $cartitems['ar'] ?>'>
            <input type='hidden' name='mennyiseg' value='<?= $cartitems['mennyiseg'] ?>'>

            <?php
                $summary += $cartitems['ar']*$cartitems['mennyiseg'];
            ?>
		</form>
	<?php } ?>

        <tr style = 'background-color: #3d0000' >
            <td></td>
            <td style = 'text-align: right'>
                Összesen:&nbsp&nbsp
            </td>
            <td style='border-top: solid #ffffff;'>
                <?= $summary ?> Ft
            </td>

            <td></td>
            <td></td>
    </tr>
	</table>
    <?php
    if (App::instance()->isGuest()) { ?>
        <h3>A megrendeléshez be kell jelentkezz!</h3>
    <?php } else {
    ?>
    <form action="megrendeles_controller.php" method="post">
        <label for="neve">
            Neved:
        </label>

        <input type='text' id="neve" name='neve' class="text"><br><br>

        <label for="email">
            Email cím:
        </label>

        <input type='text' id='email' name='email' class="text">
        <br><br>

        <label for="megjegyzes">
            Megjegyzés
        </label>

        <br>

        <textarea id="megjegyzes" name='megjegyzes' rows='4' cols='75' > </textarea><br>

        <button type="submit">Megrendelés</button>
    </form>
    <?php }
 } else {		//ha ures a session ?>
	A kosár jelenleg üres!<br>
<?php } ?>
    <br>
<form method='post' action='kosar_feldolgoz.php' id='pizza_form'>
	<input type='hidden' name='type' value='empty' >
	<input type ='submit' class='kosarba_button' style='margin-left: 15px' name='asd' value = 'Kosár ürítése' >
	<input type='hidden' name='return_url' value='<?= $current_url ?>'>
</form>


