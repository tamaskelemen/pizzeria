<?php
session_start();
require_once 'models/User.php';
require_once 'models/App.php';

if (!App::instance()->isGuest()) {
    App::goHome();
}

$return_url = 'index.php?menu=login';

if (empty($_POST)) {
    Flash::error('Kötelező kitölteni a mezőket!');
    header('Location: '. $return_url);
}


$user = new User();

$user->email = $_POST['email'];
$user->pw = $_POST['pw'];

if (!$user->login()) {
    header('Location: ' . $return_url);
    exit();
};

App::goHome();
