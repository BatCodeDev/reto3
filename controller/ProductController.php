<?php
session_start();
require_once __DIR__."/../controller/GenericController.php";
class ProductController extends GenericController {
    private $connect;
    private $connection;

    public function __construct(){
        require_once __DIR__."/../core/Connection.php";
        require_once __DIR__."/../model/Product.php";

        $this->connect = new Connection();
        $this->connection = $this->connect->conexion();
    }

    public function index(){
        $this->view("index", array(
            "title"=>"Restaurante",
        ));
    }
    public function toProducts(){
        $product = new Product($this->connection);
        $this->view("products", array(
            "title"=>"Restaurante",
            "products"=>$product->getAll()
        ));
    }
    public function modal(){
        $product = new Product($this->connection);
        echo json_encode($product->selectById($_GET["idProduct"]));
    }
}