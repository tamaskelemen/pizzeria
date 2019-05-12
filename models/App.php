<?php
require_once 'User.php';

class App
{
    public $user;
    protected static $instance;

    protected function __construct()
    {
        if (isset($_SESSION['user_email'])) {
            $this->user = User::findByEmail($_SESSION['user_email']);
        }
    }

    /**
     * @return App
     */
    public static function instance()
    {
        if (empty(static::$instance)) {
            static::$instance = new App();
        }
        return static::$instance;
    }

    /**
     * @return bool
     */
    public function isGuest()
    {
        if (empty($this->user)) {
            return true;
        }
        return false;
    }

    /**
     * Check if user has rights to do the action.
     */
    public function accessCheck()
    {
        if (App::instance()->isGuest()) {
            header('Location: index.php?menu=login');
            exit();
        }
    }

    /**
     * Redirect to the homepage.
     */
    public static function goHome()
    {
        header('Location: index.php');
        exit();
    }
}