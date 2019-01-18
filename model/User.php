<?php
require_once "Generic.php";
class User extends Generic{

    private $name, $surname, $email, $tlfo;
    public function __construct($connection){
        parent::__construct($connection);
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getSurname(){
        return $this->surname;
    }

    public function setSurname($surname){
        $this->surname = $surname;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getTlfo(){
        return $this->tlfo;
    }

    public function setTlfo($tlfo){
        $this->tlfo = $tlfo;
    }

    public function insertUser($name, $surname, $email, $telephone){
        $res = parent::getConnection()->prepare(
            "INSERT INTO user (name, surname, email, telephone) VALUES (:name, :surname, :email, :telephone)"
        );
        $res->execute(array(
            "name"=>$name,
            "surname"=>$surname,
            "email"=>$email,
            "telephone"=>$telephone
        ));
    }

    public function updateUser($name, $surname, $email, $telephone){
        $res = parent::getConnection()->prepare(
            "UPDATE user SET name = :name, surname = :surname, email = :email, telephone = :telephone WHERE email = :email"
        );
        $res->execute(array(
            "name"=>$name,
            "surname"=>$surname,
            "email"=>$email,
            "telephone"=>$telephone
        ));
    }

    public function deleteUser($email){
        $res = parent::getConnection()->prepare(
            "DELETE FROM user WHERE email = :email"
        );
        $res->execute(array(
            "email"=>$email
        ));
    }

}