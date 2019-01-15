<?php
require_once "Generic.php";
class Order extends Generic{
    private $commentary, $sdate, $idUser;

    public function __construct($connection){
        parent::__construct($connection);
    }

    public function getCommentary(){
        return $this->commentary;
    }

    public function setCommentary($commentary){
        $this->commentary = $commentary;
    }

    public function getSdate(){
        return $this->sdate;
    }

    public function setSdate($sdate){
        $this->sdate = $sdate;
    }

    public function getIdUser(){
        return $this->idUser;
    }

    public function setIdUser($idUser){
        $this->idUser = $idUser;
    }

}