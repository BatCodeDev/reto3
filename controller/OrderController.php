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
    public function cart(){
        $cart = null;
        if (isset($_SESSION["cart"])){
            $cart = $_SESSION["cart"];
        }
        $this->view("newOrder", array(
            "title"=>"Pedido",
            "cart"=>$cart,
            "listProduct"=>$_SESSION["qty"]
        ));
    }
    public function insert(){
        if($_SESSION["qty"] == 0){
            echo 1;
        }
    }
}