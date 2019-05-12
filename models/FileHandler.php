<?php

class FileHandler
{
    /**
     * @param $path
     * @return mixed
     */
    public static function read($path)
    {
        try {
            return file($path);
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return false;
        }
    }

    /**
     * @param $path
     * @param $string
     * @return bool
     */
    public static function newLine($path, $string)
    {
        if (empty($path) || empty($string)) {
            return false;
        }

        $file = fopen('data/users.csv', "a+");
        //var_dump($file); die;
        $res = fwrite($file, $string . "\n");
        fclose($file);

        if ($res !== false) {
            return true;
        }

        return $res;
    }
}