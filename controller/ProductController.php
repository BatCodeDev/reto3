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
    public function toProducts(){
        $id = null;
        $user = null;
        if (isset($_SESSION["id"], $_SESSION["user"])){
            $id = $_SESSION["id"];
            $user = $_SESSION["user"];
        }
        $product = new Product($this->connection);
        $this->view("products", array(
            "products"=>$product->getAll(),
            "activate"=>"active",
            "id"=>$id,
            "user"=>$user,
            "listProduct" => $_SESSION["cart"]
        ));
    }
    public function insert(){
        $user = null;
        if ($_SESSION["user"]){
            $user = $_SESSION["user"];
        }
        $this->view("addProduct", array(
            "user"=>$user
        ));
    }
    public function modal(){
        $product = new Product($this->connection);
        echo json_encode($product->selectById($_GET["idProduct"]));
    }
    public function addCart(){
        if (isset($_SESSION["cart"])) {
            array_push($_SESSION["cart"], $_GET["nameProduct"]);
        }else{
            $_SESSION["cart"] = array($_GET["nameProduct"]);
        }
        echo print_r($_SESSION["cart"]);
    }
}