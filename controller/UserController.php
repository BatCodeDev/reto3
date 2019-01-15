<?php
session_start();
require_once __DIR__."/../controller/GenericController.php";
class UserController extends GenericController {
    private $connect;
    private $connection;

    public function __construct(){
        require_once __DIR__."/../core/Connection.php";
        //require_once __DIR__."/../model/Bodega.php";
        //require_once __DIR__."/../model/Vino.php";

        $this->connect = new Connection();
        $this->connection = $this->connect->conexion();
    }

    public function index(){
        $this->view("index", array(
            "title"=>"Restaurante",
        ));
    }

}