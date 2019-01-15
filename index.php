<?php
require_once "config/global.php";
if(isset($_GET["controller"])){
    $controllerObj = loadController($_GET["controller"]);
    launchAction($controllerObj);
}else{
    $controllerObj = loadController(DEFAULT_CONTROLLER);
    launchAction($controllerObj);
}
function loadController($controller){
    $file = "controller/".$controller."Controller.php";
    if(file_exists($file)){
        require_once $file;
        $control = $controller."Controller";
        return new $control();
    }
    header("location: index.php");
}
function launchAction($controllerObj){
    if(isset($_GET["action"])){
        $controllerObj->run($_GET["action"]);
    }else{
        $controllerObj->run(DEFAULT_ACTION);
    }
}
?>