<?php
require_once 'models/Hamburger.php';

$current_url = base64_encode("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

//lekerdez
$hamburgerek = Hamburger::getAll();

?>

<h2 class="title"> Hamburgereink </h2>
<table class='tabla' >

    <?php
    foreach ($hamburgerek as $hamburger) { ?>
        <form  method='post' action='kosar_feldolgoz.php' id='hamburger_form'>
            <tr class='tabla-sor'   >
                <td>
                    <?= $hamburger->sorszam ?>
                </td>

                <td>
                    <b><?= $hamburger->nev ?></b> (<?= $hamburger->feltet ?>)
                </td>

                <td>
                    <?= $hamburger->ar ?> Ft
                </td>
                <td>
                    <label for="mennyiseg" class="hidden">Mennyiség</label>
                    <input id='mennyiseg' type='text' name='mennyiseg' value=1 style='width: 30px'>
                </td>
                <td>
                    <input type='submit' class='kosarba_button' value='Kosárba!'>
                </td>
            </tr>

            <input type='hidden' name='id' value='<?= $hamburger->sorszam ?>'>
            <input type='hidden' name='nev' value='<?=  $hamburger->nev ?>'>
            <input type='hidden' name='feltet' value='<?= $hamburger->feltet ?>'>
            <input type='hidden' name='ar' value='<?= $hamburger->ar ?>'>
            <input type='hidden' name='return_url' value='<?= $current_url ?>'>
            <input type='hidden' name='type' value='add' >
        </form>

        <?php
    }
    ?>
</table>
