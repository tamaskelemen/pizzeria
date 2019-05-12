<?php
require_once 'FileHandler.php';
require_once 'Flash.php';
require_once 'AbsztraktTermek.php';

class Pizza extends AbsztraktTermek
{

    const PIZZA_DATA = 'data/pizzak.csv';

    /**
     * @return Pizza[]
     */
    public static function getAll()
    {
        $result = [];
        $file = FileHandler::read(self::PIZZA_DATA);

        if (!$file) {
            return [];
        }

        foreach ($file as $line) {
            $line = explode(';', $line);
            $pizza = new Pizza();
            $pizza->sorszam = $line[0];
            $pizza->nev = $line[1];
            $pizza->feltet = $line[2];
            $pizza->ar = $line[3];

            $result[] = $pizza;

            unset($pizza);
        }

        return $result;
    }

}