<?php
class Connection{
    private $driver;
    private $host, $user, $pass, $database, $charset;

    public function __construct() {
        require_once __DIR__.'/../config/database.php';
        $this->driver = DB_DRIVER;
        $this->host = DB_HOST;
        $this->user = DB_USER;
        $this->pass = DB_PASS;
        $this->database = DB_DATABASE;
        $this->charset = DB_CHARSET;
    }

    public function conexion(){
        $bbdd = $this->driver
            . ':host=' . $this->host
            . ';dbname=' . $this->database
            . ';charset=' . $this->charset;
        $connection = new PDO($bbdd, $this->user, $this->pass);
        return $connection;
    }

}
?>