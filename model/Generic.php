<?php
class Generic{

    private $connection;

    public function getConnection(){
        return $this->connection;
    }

    public function setConnection($connection){
        $this->connection = $connection;
    }

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function delete($id, $tableName){
        $res = $this->connection->prepare(
            "DELETE FROM ".$tableName." WHERE id = :id"
        );
        $res->execute(array(
            "id"=>$id
        ));
        $this->connection = null;
    }
}