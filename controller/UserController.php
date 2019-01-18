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

    public function loginValidate(){
        if(isset($_POST["user"], $_POST["pass"])){
            $user = new User($this->connection);
            $dbuser = $user->selectByName($_POST["user"]);
            if($dbuser == null){
                echo 0;
            }else{
                if($dbuser[0]["pass"] === $_POST["pass"]){
                    $_SESSION["admin"] = $dbuser[0]["id"];
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }
    }

}