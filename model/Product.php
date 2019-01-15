<?php
require_once "Generic.php";
class Product extends Generic{
    private $name, $description, $prize;

    public function __construct($connection){
        parent::__construct($connection);
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getPrize(){
        return $this->prize;
    }

    public function setPrize($prize){
        $this->prize = $prize;
    }

    public function getAll(){
        $res = parent::getConnection()->prepare(
            "SELECT * FROM product"
        );
        $res->execute();
        return $res->fetchAll();
    }

    public function selectById($id){
        $res = parent::getConnection()->prepare(
            "SELECT * FROM product WHERE id = :id"
        );
        $res->execute(array(
            "id"=>$id
        ));
        return $res->fetchAll()[0];
    }
}