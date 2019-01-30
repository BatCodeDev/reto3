<?php
session_start();
require_once __DIR__."/../controller/GenericController.php";
class OrderController extends GenericController {
    private $connect;
    private $connection;

    public function __construct(){
        require_once __DIR__."/../core/Connection.php";
        require_once __DIR__."/../model/Order.php";
        require_once __DIR__."/../model/Product.php";

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
    function details(){
        $product =  new Product($this->connection);
        $order =  new Order($this->connection);

        $cart = [];

        foreach ($product->getProductByOrder($_GET["idOrder"]) as $p) {

            $p["quantity"] = $order->getQuantityByProduct($p["id"], $_GET["idOrder"])[0]["quantity"];
            $cart[] = $p;
        }

        $client = $order->getClienteByOrder($_GET["idOrder"]);
        $this->view("orderDetails", array(
            "title"=>"Pedido",
            "cart"=>$cart,
            "client"=>$client[0]
        ));
    }
    function setAll($order){
        $order =  new Order($this->connection);
        $order->setCommentary($_POST["coment"]);
        $order->setUserName($_POST["name"]);
        $order->setUserSurname($_POST["surname"]);
        $order->setUserTlfo($_POST["tlfo"]);
        $order->setUserEmail($_POST["email"]);
        return $order;
    }
    function changeStatus(){
        $order =  new Order($this->connection);
        $order->updateClientOrder($_POST["orderId"], $_POST["status"]);
    }
    public function insert(){
        if($_SESSION["qty"] == 0){
            echo "0";
        }else{
            $order = $this->setAll(new Order($this->connection));
            $ok = $order->insertOrder();
            if ($ok != 0){
                $_SESSION["qty"] = 0;
                $_SESSION["cart"] = null;
                echo "1";
                $this->mail_send($_POST["name"], $_POST["email"], "http://batcodedev.tk/confirm/".$ok, $ok);
            }else{
                echo "2";
            }
        }
    }
    public function allOrders(){
        $order = new Order($this->connection);
        $this->view("adminOrders", array(
            "orders"=>$order->getAll(),
            "id"=>$_SESSION["id"],
            "user"=>$_SESSION["user"],
            "listProduct" => $_SESSION["qty"]
        ));
    }
    public function confirmOrder(){
        /*$order = new Order($this->connection);
        $order->updateClientOrder($_GET["idOrder"], "CONFIRMED");*/
        $this->view("orderConfirm", array(
            "title"=>"orderConfirm"
        ));
    }
}