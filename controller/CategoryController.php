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
        if($_POST['category']!=0)
        {
            if(isset($_POST['search']))
            {
                $search=new Category($this->connection);
                $search=$search->getSearchCat($_POST['search'],$_POST['category']);
                $this->view("search", array(
                    "title"=>"Resultados busqueda",
                    "search"=>$search
                ));
            }
        }
        else
        {
            if(isset($_POST['search']))
            {
                $search=new Category($this->connection);
                $search=$search->getSearch($_POST['search']);
                $this->view("search", array(
                    "title"=>"Resultados busqueda",
                    "search"=>$search
                ));
            }
        }
    }
    public function insert()
    {
        //var_dump(die($_POST["category"]));
        $data = json_decode($_POST["category"]);
        $category = new Category($this->connection);
        $category->insertCategory($data);
        //print_r($data);
    }

}