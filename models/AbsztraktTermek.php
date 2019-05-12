<?php
require_once 'FileHandler.php';
require_once 'Flash.php';
require_once 'InterfaceTermek.php';

abstract class AbsztraktTermek implements InterfaceTermek
{
    public $sorszam;
    public $nev;
    public $feltet;
    public $ar;

}