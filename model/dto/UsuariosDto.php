<?php
class UsuariosDto { 
    private int $us_id;
    private string $usname;
    private string $email;
    private string $password;
    private int $user_type;

    public function __construct($us_id = 0, $usname = null, $email = null, $password = null, $user_type = 0) {
        $this->us_id = $us_id;
        $this->usname = $usname;
        $this->email = $email;
        $this->password = $password;
        $this->user_type = $user_type;
    }
    public function getUsId() {
        return $this->us_id;
    }
    public function getUsnome() {
        return $this->usname;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getUserType() {
        return $this->user_type;
    }
    public function setUsnome($usname) {
        $this->usname = $usname;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function setUserType($user_type) {
        $this->user_type = $user_type;
    }
}