<?php
session_start();
require_once 'models/SignupForm.php';
require_once 'models/App.php';

if (!App::instance()->isGuest()) {
    App::goHome();
}

$return_url = 'index.php?menu=regisztracio';

if (empty($_POST)) {
    Flash::error('Kötelező kitölteni a mezőket!');
    header('Location: '. $return_url);
}

$signupForm = new SignupForm();
$signupForm->email = $_POST['email'];
$signupForm->pw = $_POST['pw'];
$signupForm->pw_again = $_POST['pw_again'];

if ($signupForm->signup()) {
    header('Location: index.php?menu=login');
    exit;
}
header('Location: ' . $return_url);
exit();
