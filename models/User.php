<?php
require_once 'FileHandler.php';
require_once 'Flash.php';

class User
{

    public $id;
    public $email;
    public $pw;
    public $pwHash;
    public $regdate;

    const USER_DATA = 'data/users.csv';

    /**
     * @param $email
     * @return User||null
     */
    public static function findByEmail($email)
    {
        $users = self::getAll();

        foreach ($users as $user) {
            if ($user->email === $email) {
                return $user;
            }
        }
        return null;
    }

    /**
     * @return bool
     */
    public function login()
    {
        if (!$this->validateLoginForm()) {
            return false;
        }

        $user = self::findByEmail($this->email);
        $_SESSION['user_email'] = $user->email;
        Flash::success("Sikeres bejelentkezés!");

        return true;
    }

    public function logout()
    {
        unset($_SESSION['user_email']);
    }

    /**
     * @return bool
     */
    public function validateLoginForm()
    {
        if (empty($this->email)) {
            Flash::error("Az email címet kötelező megadni!");
            return false;
        }
        if (empty($this->pw)) {
            Flash::error("A jelszót kötelező megadni!");
            return false;
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            Flash::error("Az email cím nem megfelelő formátumú!");
            return false;
        }

        if (!self::userExists($this->email)) {
            Flash::error("A megadott email és jelszó páros nem megfelelő!");
            return false;
        }

        $user = self::findByEmail($this->email);
        if (!password_verify($this->pw, $user->pwHash)) {
            Flash::error("A megadott email és jelszó páros nem megfelelő!");
            return false;
        }

        return true;
    }

    /**
     * @param $email
     * @return bool
     */
    public static function userExists($email)
    {
        if (!empty(self::findByEmail($email))) {
            return true;
        }
        return false;
    }

    /**
     * @param string $string The password to hash
     *@return string The hashed password
     */
    protected static function encryptPassword($string)
    {
        return crypt($string);
    }

    /**
     * @return User[]
     */
    public static function getAll()
    {
        $result = [];
        $file = FileHandler::read(self::USER_DATA);

        if (!$file) {
            return [];
        }
        foreach ($file as $line) {
            $line = explode(';', $line);
            $user = new User();
            $user->email = $line[0];
            $user->pwHash = $line[1];
            $user->regdate = $line[2];

            $result[] = $user;

            unset($user);
        }

        return $result;
    }

    /**
     * @throws Exception
     */
    public function create()
    {
        if (self::findByEmail($this->email)) {
            throw new \Exception('Nem sikerült létrehozni a felhasználót, mert már létezik ilyen az adatok között.');
        }

        $data[] = $this->email;
        $data[] = $this->pwHash;
        $data[] = $this->regdate;
        $line = implode(';', $data);
        return FileHandler::newLine(self::USER_DATA, $line);
    }
}