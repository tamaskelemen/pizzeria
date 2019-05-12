<?php
session_start();
require_once 'models/App.php';
require_once 'models/Flash.php';

App::instance()->accessCheck();

// TODO: megrendeles mentese

Flash::success('Megrendelés rögzítve!');
App::goHome();