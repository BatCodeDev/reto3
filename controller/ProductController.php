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
        $listProduct = 0;
        if (isset($_SESSION["cart"])){
            $quantity = 0;
            foreach ($_SESSION["cart"] as $product) {
                $quantity = $quantity + $product["quantity"];
            }
            $listProduct = $quantity;
        }
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
            "listProduct" => $listProduct
        ));
    }
    public function setAll($product){
        $product->setName($_POST["name"]);
        $product->setDescription($_POST["descr"]);
        $product->setPrize($_POST["prize"]);
        return $product;
    }
    public function insert(){
        $product = $this->setAll(new Product($this->connection));
        if ($_FILES["img"]["error"] > 0){
            echo "Error: " . $_FILES["file"]["error"] . "<br />";
        }else{
            $extension = explode("/", $_FILES["img"]["type"])[1];
            $img = uniqid().'.'.$extension;
            $url = "img/productImg/".$img;
            $product->setImg($img);
            $ok = $product->insertProduct();

            if($ok != 0)
                move_uploaded_file($_FILES["img"]["tmp_name"], $url);
            header("location:index.php?controller=product&action=toProducts");
        }
    }

    public function addProduct(){
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
            if (isset($_SESSION["cart"][$_POST["nameProduct"]])) {
                $quant = $_SESSION["cart"][$_POST["nameProduct"]]["quantity"];
                $_SESSION["cart"][$_POST["nameProduct"]] = array("quantity" => $quant+1, "id" => $_POST["idProduct"] , "name" => $_POST["nameProduct"], "prize" => $_POST["prizeProduct"], "img" => $_POST["imgProduct"]);  
            }else{
                $_SESSION["cart"][$_POST["nameProduct"]] = array("quantity" => 1, "id" => $_POST["idProduct"] , "name" => $_POST["nameProduct"], "prize" => $_POST["prizeProduct"], "img" => $_POST["imgProduct"]); 
            }
        }else{
            $_SESSION["cart"][$_POST["nameProduct"]] = array("quantity" => 1, "id" => $_POST["idProduct"] , "name" => $_POST["nameProduct"], "prize" => $_POST["prizeProduct"], "img" => $_POST["imgProduct"]); 
            
        }
        echo json_encode($_SESSION["cart"]);
    }
}