<?php
    require("Models/model.php");

    function getCookie(){
        $data = array();
        $data["answer"] = $_COOKIE["answer"];
        return $data;
    }

    if(isset($_COOKIE["answer"])){
            $model = new model();
            $data = getCookie();

         if(isset($_GET['action'])){
            switch ($_GET['action'])
            {
                case 'checkAnswer':
                    echo $model->checkAnswer($_GET['inputAnswer'],$data["answer"]);
                break;

                default:

                break;
            }

        }else{
            require("views/main_ui.php");
        }
    }else{
        $model = new model();
        $data = getCookie();
        setcookie("answer",$model->createAnswer(),time() + (86400 * 30), "/");
        header('Location: '.$_SERVER['PHP_SELF']);
        die;
    }


?>