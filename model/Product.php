<?php
require_once "Generic.php";
class Product extends Generic{
    private $connection;

    private $name, $description, $prize, $img, $category;

    public function __construct($connection){
        parent::__construct($connection);
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getPrize(){
        return $this->prize;
    }

    public function setPrize($prize){
        $this->prize = $prize;
    }

    public function getImg(){
        return $this->img;
    }

    public function setImg($img){
        $this->img = $img;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getAll(){
        $res = parent::getConnection()->prepare(
            "SELECT * FROM product ORDER BY name"
        );
        $res->execute();
        return $res->fetchAll();
    }

    public function getProductByOrder($idOrder){
        $res = parent::getConnection()->prepare(
            "SELECT * FROM product where id in (select idProduct from orderproduct where idOrder = :idOrder)"
        );
        $res->execute(array("idOrder" => $idOrder));
        return $res->fetchAll();
    }

    public function selectById($id){
        $res = parent::getConnection()->prepare(
            "SELECT * FROM product WHERE id = :id"
        );
        $res->execute(array(
            "id"=>$id
        ));
        return $res->fetchAll()[0];
    }
    public function data(){
        return [
            "name"=>$this->name,
            "description"=>$this->description,
            "prize"=>$this->prize,
            "img"=>$this->img,
            "category"=>$this->category
        ];
    }
    public function searchById($id){
        $res = parent::getConnection()->prepare(
            "SELECT * FROM product WHERE ID = :id"
        );
        $res->execute(array(
            "id"=>$id
        ));
        return $res->fetchAll();
    }
    public function insertProduct(){
        $res = parent::getConnection()->prepare(
            "INSERT INTO product (name, description, prize, img, id_category) VALUES (:name, :description, :prize, :img, :category)"
        );
        $res->execute($this->data());
        $lastid = parent::getConnection()->lastInsertId();
        $this->connection = null;
        return $lastid;
    }

    public function updateProduct($id){
        $res = parent::getConnection()->prepare(
            "UPDATE product SET name = :name, description = :description, prize = :prize, img = :img, category = :category WHERE id = ".$id
        );
        $res->execute($this->data());
        $this->connection = null;
    }
    public function deleteProduct($name){
        $res = parent::getConnection()->prepare(
            "DELETE FROM product WHERE name = :name"
        );
        $res->execute(array(
            "name"=>$name
        ));
    }


}