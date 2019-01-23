<?php
session_start();
require_once __DIR__."/../controller/GenericController.php";
class CategoryController extends GenericController {
    private $connect;
    private $connection;

    public function __construct(){
        require_once __DIR__."/../core/Connection.php";
        //require_once __DIR__."/../model/Bodega.php";
        //require_once __DIR__."/../model/Vino.php";
        require_once __DIR__."/../model/Category.php";
        $this->connect = new Connection();
        $this->connection = $this->connect->conexion();
    }

    public function index(){
        $this->view("index", array(
            "title"=>"Restaurante",
        ));
    }

    public function searchP(){

        if(isset($_POST['category']))
        {
            if(isset($_POST['search']))
            {

            }
        }
        else
        {
            if(isset($_POST['search']))
            {
                $search=new Category($this->connection);
                $search=$search->getSearch();
                $this->view("products", array(
                    "title"=>"Restaurante",
                    "search"=>$search
                ));
            }
        }

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

}