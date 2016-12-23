<?php
    require("Models/model.php");

    if(isset($_GET['action'])){
        switch ($_GET['action'])
        {
            case 'checkAnswer':
                require("views/main_ui.php");
                break;

            default:
                require("views/main_ui.php");
                break;
        }
    }else{
        $model = new model();
        $model->createAnswer();
        require("views/main_ui.php");
    }


?>