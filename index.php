<?php
    require("Models/model.php");
    session_start();
    $model = new model();

    if(isset($_SESSION["answer"])){
        $realAnswer = $_SESSION["answer"];
         if(isset($_POST['action'])){
            switch ($_POST['action'])
            {
                case 'checkAnswer':
                echo $model->checkAnswer($_POST['inputAnswer'],$realAnswer);
                break;

                case 'restartGame':
                session_unset();
                break;

                default:
                break;
            }

        }else{
            $answer = $_SESSION["answer"];
            require("views/main_ui.php");
        }
    }else{
        $_SESSION["answer"] = $model->createAnswer();
        header('Location: '.$_SERVER['PHP_SELF']);
        die;
    }


?>