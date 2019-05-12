<?php

class Flash
{
    public static function success($message)
    {
        $_SESSION['flash_success'] = $message;
    }

    public static function error($message)
    {
        $_SESSION['flash_error'] = $message;
    }

    public static function destroyFlash()
    {
        unset($_SESSION['flash_error']);
        unset($_SESSION['flash_success']);
    }
}