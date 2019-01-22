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



    public function insertOrder($commentary, $date, $idUser){
        $res = parent::getConnection()->prepare(
            "INSERT INTO order (commentary, dateOrder, idUser) VALUES (:commentary, :dateOrder, :idUser)"
        );
        $res->execute(array(
            "commentary"=>$commentary,
            "dateOrder"=>$date,
            "idUser"=>$idUser
        ));
    }

    public function updateOrder($id, $commentary, $date, $idUser){
        $res = parent::getConnection()->prepare(
            "UPDATE order SET commentary = :commentary, dateOrder = :dateOrder, idUser = :idUser WHERE id = :id"
        );
        $res->execute(array(
            "id"=>$id,
            "commentary"=>$commentary,
            "dateOrder"=>$date,
            "idUser"=>$idUser
        ));
    }

    public function deleteOrder($id){
        $res = parent::getConnection()->prepare(
            "DELETE FROM order WHERE id = :id"
        );
        $res->execute(array(
            "id"=>$id
        ));
    }

}