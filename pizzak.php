<?php
require_once 'models/Pizza.php';

$current_url = base64_encode("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

//lekerdez
$pizzak = Pizza::getAll();

?>

<h2 class="title"> Pizzáink </h2>
<table class='tabla' >

<?php
foreach ($pizzak as $pizza) { ?>
    <form  method='post' action='kosar_feldolgoz.php' id='pizza_form'>
        <tr class='tabla-sor'   >
            <td>
                <?= $pizza->sorszam ?>
            </td>

            <td>
                <b><?= $pizza->nev ?></b> (<?= $pizza->feltet ?>)
            </td>

            <td>
                <?= $pizza->ar ?> Ft
            </td>
            <td>
                <label for="mennyiseg" class="hidden" >Mennyiség</label>
                <!-- TODO: remove inline css -->
                <input id='mennyiseg' type='text' name='mennyiseg' value=1 style='width: 30px'>
            </td>
            <td>
                <input type='submit' class='kosarba_button' value='Kosárba!'>
            </td>
        </tr>

        <input type='hidden' name='id' value='<?= $pizza->sorszam ?>'>
        <input type='hidden' name='nev' value='<?=  $pizza->nev ?>'>
        <input type='hidden' name='feltet' value='<?= $pizza->feltet ?>'>
        <input type='hidden' name='ar' value='<?= $pizza->ar ?>'>
        <input type='hidden' name='return_url' value='<?= $current_url ?>'>
        <input type='hidden' name='type' value='add' >
    </form>

<?php
}
?>
</table>
