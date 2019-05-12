<?php
if (!App::instance()->isGuest()) {
    App::goHome();
}
?>

<form action="regisztracio_controller.php" method="post" >
        <div class="container">
        <label for="email"><b>Email</b></label>
        <input type="text" class="text" placeholder="Email cím" name="email" required>

        <label for="ps"><b>Jelszó</b></label>
        <input type="password" placeholder="Írja be jelszavát" name="pw" required>

        <label for="ps_again"><b>Jelszó mégegyszer</b></label>
        <input type="password" placeholder="Írja be jelszavát" name="pw_again" required>

        <button type="submit">Regisztráció</button>
    </div>
</form>
