<?php
require_once "Generic.php";
class Category extends Generic{
    private $name;

    public function __construct($connection){
        parent::__construct($connection);
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function insertCategory($name){
        $res = parent::getConnection()->prepare(
            "INSERT INTO category (name) VALUES (:name)"
        );
        $res->execute(array(
            "name"=>$name
        ));
    }

    public function updateCategory($name){
        $res = parent::getConnection()->prepare(
            "UPDATE category SET name = :name WHERE name = :name"
        );
        $res->execute(array(
            "name"=>$name
        ));
    }

    public function deleteCategory($name){
        $res = parent::getConnection()->prepare(
            "DELETE FROM category WHERE name = :name"
        );
        $res->execute(array(
            "name"=>$name
        ));
    }
}