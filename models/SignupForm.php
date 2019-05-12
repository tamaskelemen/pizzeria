<?php
require_once 'User.php';

class SignupForm
{
    public $email;
    public $pw;
    public $pw_again;

    public function signup()
    {
        if (!$this->validateForm()) {
            return false;
        }

        $user = new User();
        $user->email = $this->email;
        $user->pwHash = crypt($this->pw);
        $user->regdate = time();

        try {
            return $user->create();
        } catch (Exception $exception) {
            Flash::error($exception->getMessage());
            return false;
        }
    }

    /**
     * @return bool
     */
    public function validateForm()
    {
        if (empty($this->email)) {
            Flash::error("Az email címet kötelező megadnii!");
            return false;
        }

        if (empty($this->pw)) {
            Flash::error("A jelszót kötelező megadni!");
            return false;
        }

        if (empty($this->pw_again)) {
            Flash::error("A jelszót kötelező megadni!");
            return false;
        }

        if ($this->pw !== $this->pw_again) {
            Flash::error("A két jelszónak meg kell egyezzen!");
            return false;
        }

        if (strlen($this->pw) < 6) {
            Flash::error("A megadott jelszó túl rövid. Min. 6 karakter");
            return false;
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            Flash::error("Az email cím nem megfelelő formátumú!");
            return false;
        }

        if (User::userExists($this->email)) {
            Flash::error("A megadott email cím már használatban van.");
            return false;
        }

        return true;
    }
}