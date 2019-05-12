<?php
App::instance()->accessCheck();

$user = App::instance()->user;

?>

<table>
    <tr>
        <td>
            Email:
        </td>

        <td>
            <?= $user->email ?>
        </td>
    </tr>

    <tr>
        <td>
            Regisztráció dátuma:
        </td>

        <td>
            <?= date("Y-m-d H:i:s", (int)$user->regdate) ?>
        </td>
    </tr>
</table>
