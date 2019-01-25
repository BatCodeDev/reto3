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
    public function allProducts(){
        $product = new Product($this->connection);
        $this->view("adminProducts", array(
            "products"=>$product->getAll(),
            "id"=>$_SESSION["id"],
            "user"=>$_SESSION["user"],
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
        $header = "location:index.php?controller=product&action=toProducts";
        $extension = explode("/", $_FILES["img"]["type"])[1];
        if (isset($_GET["mode"])){
            $url = "img/productImg/".$_POST["prevImg"];
            $product->setImg($_POST["prevImg"]);
            $product->updateProduct($_GET["idProduct"]);
            $ok = 1;
            $header = "location:index.php?controller=Product&action=allProducts";
        }else{
            $img = $_POST["name"].'.'.$extension;
            $url = "img/productImg/".$img;
            $product->setImg($img);
            $ok = $product->insertProduct();
        }
        if($ok != 0)
            move_uploaded_file($_FILES["img"]["tmp_name"], $url);
        header($header);
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
    public function details(){
        if(isset($_GET["idProduct"])){
            $product = new Product($this->connection);
            $this->view("productDetails",array(
                "title"=>"Detalles de producto",
                "product"=>$product->searchById($_GET["idProduct"])[0]
            ));
        }
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
                "total"=>$_SESSION["qty"],
                "id"=>$_GET["idProduct"],
                "op"=>"+"
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
                "total"=>$_SESSION["qty"],
                "id"=>$_GET["idProduct"],
                "op"=>"-"
            ]
        );
    }
    public function delete(){
        $product = $this->searchCart();
        $_SESSION["qty"] -= $product["quantity"];
        unset($_SESSION["cart"][$product["name"]]);
        header("location:index.php?controller=Order&action=cart");
    }
    public function deleteProduct(){
        $product = new Product($this->connection);
        $product->delete($_GET["idProduct"], "product");
        header("location:index.php?controller=Product&action=allProducts");
    }
}