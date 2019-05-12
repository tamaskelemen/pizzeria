<?php
if (!App::instance()->isGuest()) {
    App::goHome();
}
?>

<form action="login_controller.php" method="post">
        <div class="container">
        <label for="uname"><b>Email</b></label>
        <input class="text" type="text" placeholder="Email cím" name="email" required>

        <label for="psw"><b>Jelszó</b></label>
        <input type="password" placeholder="Írja be jelszavát" name="pw" required>

        <button type="submit">Belépés</button>
    </div>
</form>
