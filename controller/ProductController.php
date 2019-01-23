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
            "listProduct" => $_SESSION["qty"]
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
        $quantity = 0;
        foreach ($_SESSION["cart"] as $product) {
            $quantity = $quantity + $product["quantity"];
            $_SESSION["qty"] = $quantity;
        }
        echo json_encode($_SESSION["cart"]);
    }
    public function searchCart(){
        foreach ($_SESSION["cart"] as $product) {
            if(intval($product["id"]) == $_GET["idProduct"])
                return $product;
        }
    }
    public function addQtyCart(){
        $product = $this->searchCart();
        $_SESSION["qty"]++;
        $_SESSION["cart"][$product["name"]]["quantity"]++;
        echo json_encode(
            [
                "val"=>$_SESSION["cart"][$product["name"]]["quantity"],
                "id"=>$_GET["idProduct"]
            ]
        );
    }
    public function removeQtyCart(){
        $product = $this->searchCart();
        if($product["quantity"] != 1) {
            $_SESSION["qty"]--;
            $_SESSION["cart"][$product["name"]]["quantity"]--;
        }
        echo json_encode(
            [
                "val"=>$_SESSION["cart"][$product["name"]]["quantity"],
                "id"=>$_GET["idProduct"]
            ]
        );
    }
    public function delete(){
        $product = $this->searchCart();
        $_SESSION["qty"] -= $product["quantity"];
        unset($_SESSION["cart"][$product["name"]]);
        header("location:index.php?controller=Order&action=cart");
    }
}