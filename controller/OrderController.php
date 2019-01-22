<?php
session_start();
require_once __DIR__."/../controller/GenericController.php";
class OrderController extends GenericController {
    private $connect;
    private $connection;

    public function __construct(){
        require_once __DIR__."/../core/Connection.php";
        require_once __DIR__."/../model/Order.php";

        $this->connect = new Connection();
        $this->connection = $this->connect->conexion();
    }

    public function addOrder(){
        $this->view("newOrder", array(
            "title"=>"Pedido",
        ));
    }

}