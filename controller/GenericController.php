<?php

class GenericController{

    public function run($action){
        try{
            $this->$action();
        }catch (Error $e){
            var_dump(die($e));
            $this->index();
        }
    }

    public function view($view, $data){
        require_once __DIR__."/../vendor/autoload.php";
        $loader = new Twig_Loader_Filesystem(__DIR__."/../view");
        $twig = new Twig_Environment($loader);
        echo $twig->render($view."View.twig", $data);
    }
}