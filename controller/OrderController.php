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
        require_once __DIR__."/../model/User.php";

        $this->connect = new Connection();
        $this->connection = $this->connect->conexion();
    }
    public function cart(){
        $user = new User($this->connection);
        $mode = $user->getNoOrders();
        if ($mode != 1){
            $id = null;
            $user = null;
            if (isset($_SESSION["id"], $_SESSION["user"])){
                $id = $_SESSION["id"];
                $user = $_SESSION["user"];
            }
            $cart = null;
            if (isset($_SESSION["cart"])){
                $cart = $_SESSION["cart"];
            }
            $this->view("newOrder", array(
                "title"=>"Pedido",
                "cart"=>$cart,
                "listProduct"=>$_SESSION["qty"],
                "id" => $id,
                "user" => $user
            ));
        }else{
            header("location:index.php?controller=Product&action=toProducts");
        }
    }
    function details(){
        $id = null;
        $user = null;
        if (isset($_SESSION["id"], $_SESSION["user"])){
            $id = $_SESSION["id"];
            $user = $_SESSION["user"];
        }
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
            "client"=>$client[0],
            "id"=>$id,
            "user"=>$user,
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
    public function getAllStatistics(){
        $product = new Order($this->connection);
        print_r(json_encode($product->getProductCount()));
    }
    public function allStatistics(){
        $product = new Order($this->connection);
        $this->view("adminStatistics", array(
            "title"=>'Estadisticas de ventas',
            "orders"=>$product->getProductCount(),
            "id"=>$_SESSION["id"],
            "user"=>$_SESSION["user"]
        ));
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
                //$this->mail_send($_POST["name"], $_POST["email"], "http://batcodedev.tk/index.php?controller=Order&action=confirmOrder&idOrder=".$ok, $ok, $_SESSION["cart"]);
                $_SESSION["qty"] = 0;
                $_SESSION["cart"] = null;
                echo "1";
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
    function translate($key){
        $dayNames = ["Wednesday"=>"Miercoles", "Thursday"=>"Jueves", "Friday"=>"Viernes", "Saturday"=>"Sabado"];
        return $dayNames[$key];
    }
    function prepareDate(){
        $Date = date("Y/m/d");
        switch (date("l")){
            case "Monday":
                $days = 4;
                $daysEnd = 5;
                break;
            case "Tuesday":
                $days = 8;
                $daysEnd = 11;
                break;
            case "Wednesday":
                $days = 7;
                $daysEnd = 10;
                break;
            case "Thursday":
                $days = 6;
                $daysEnd = 9;
                break;
            case "Friday":
                $days = 5;
                $daysEnd = 8;
                break;
            case "Saturday":
                $days = 4;
                $daysEnd = 7;
                break;
            case "Sunday":
                $days = 4;
                $daysEnd = 6;
                break;
        }
        return "Entre el ".$this->translate(date('l', strtotime($Date. ' + '.$days.' days')))
            ." ".date('d/m/Y', strtotime($Date. ' + '.$days.' days'))
            ." y el ".$this->translate(date('l', strtotime($Date. ' + '.$daysEnd.' days')))
            ." ".date('d/m/Y', strtotime($Date. ' + '.$daysEnd.' days'))." de 11:30 a 20:00";
    }

    public function confirmOrder(){
        $_SESSION["orderId"] = $_GET["idOrder"];
        if($_SESSION["orderId"] == $_GET["idOrder"]){
            $order = new Order($this->connection);
            $order->updateClientOrder($_GET["idOrder"], "CONFIRMADO");
        }
        $this->view("orderConfirm", array(
            "title"=>"orderConfirm",
            "display"=>"d-none",
            "cols"=>"col-6",
            "fechaRecogida"=>$this->prepareDate()
        ));
    }
    public function deleteOrder(){
        $order = new Order($this->connection);
        $order->delete($_GET["idOrder"], "clientorder");
        header("Location: index.php?controller=Order&action=allOrders");
    }
}