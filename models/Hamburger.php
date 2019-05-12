<?php
require_once 'FileHandler.php';
require_once 'Flash.php';
require_once 'AbsztraktTermek.php';

class Hamburger extends AbsztraktTermek
{
    const HAMBURGER_DATA = 'data/hamburgerek.csv';

    /**
     * @return Hamburger[]
     */
    public static function getAll()
    {
        $result = [];
        $file = FileHandler::read(self::HAMBURGER_DATA);

        if (!$file) {
            return [];
        }

        foreach ($file as $line) {
            $line = explode(';', $line);
            $hamburger = new Hamburger();
            $hamburger->sorszam = $line[0];
            $hamburger->nev = $line[1];
            $hamburger->feltet = $line[2];
            $hamburger->ar = $line[3];

            $result[] = $hamburger;

            unset($hamburger);
        }

        return $result;
    }
}