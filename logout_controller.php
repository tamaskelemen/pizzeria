<?php
session_start();
require_once 'models/User.php';
require_once 'models/App.php';

App::instance()->user->logout();
Flash::success("Sikeresen kijelentkezés!");
header('Location: index.php');
