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


}