<?php
session_start();
require_once __DIR__."/../controller/GenericController.php";
class UserController extends GenericController {
    private $connect;
    private $connection;

    public function __construct(){
        require_once __DIR__."/../core/Connection.php";
        require_once __DIR__."/../model/User.php";

        $this->connect = new Connection();
        $this->connection = $this->connect->conexion();
    }
    public function admin1234(){
        $this->view("adminLogin", array());
    }
    public function index(){
        $id = null;
        $user = null;
        $listProduct = array();
        if (isset($_SESSION["cart"])) {
            $listProduct = $_SESSION["cart"];
        }
        if (isset($_SESSION["id"], $_SESSION["user"])){
            $id = $_SESSION["id"];
            $user = $_SESSION["user"];
        }
        $this->view("index", array(
            "title"=>"BatFood",
            "id"=>$id,
            "user"=> $user,
            "listProduct" => $listProduct
        ));
    }
    public function loginValidate(){
        if(isset($_POST["user"], $_POST["pass"])){
            $user = new User($this->connection);
            $dbuser = $user->selectByName($_POST["user"]);
            if($dbuser == null){
                echo 0;
            }else{
                if($dbuser[0]["pass"] === $_POST["pass"]){
                    $_SESSION["id"] = $dbuser[0]["id"];
                    $_SESSION["user"] = $dbuser[0]["user"];
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }
    }
    public function delete(){
        $user = new User($this->connection);
        $user->delete($_GET["idUser"], "admin");
        header("location:index.php?controller=User&action=toManageAdmins");
    }
    public function toManageAdmins(){
        $user = new User($this->connection);
        $users =  $user->getAll();
        for ($x = 0; $x < sizeof($users) && $users[$x]["id"] != $_SESSION["id"]; $x++){}
        $current = $users[$x];
        $this->view("manageAdmins", array(
            "title"=>"Gestion de administradores",
            "admins"=>$users,
            "id"=> $_SESSION["id"],
            "user"=> $_SESSION["user"],
            "current" => $current
        ));
    }
    public function logOut(){
        session_destroy();
        header("location:index.php");
    }
}