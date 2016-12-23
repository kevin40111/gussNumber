<?php

class Model{
    function createAnswer(){
        $checkRepeat = array();
        $answer = "";
        for($i=0;$i<4;$i++){
            while(1)
            {
                $rand = rand(0,9);
                if(!in_array($rand, $checkRepeat))break;
            }
            array_push($checkRepeat,$rand);
        }
        foreach ($checkRepeat as $value) {
             $answer.= $value;
        }
        return $answer;
    }

    function checkRepeat($inputAnswer,$inputRecord){

    }

    function checkAnswer($inputAnswer,$realAnswer){
        $posRight=0;
        $allRight=0;
        $inputArray  = preg_split('//', $inputAnswer, -1, PREG_SPLIT_NO_EMPTY);
        $answerArray = preg_split('//', $realAnswer, -1, PREG_SPLIT_NO_EMPTY);

        for($i=0;$i<4;$i++){
            for($j=0;$j<4;$j++){
                if($inputArray[$i] == $answerArray[$j] && $i==$j){
                    $allRight++;
                    break;
                }else if($inputArray[$i] == $answerArray[$j] && $i!=$j){
                    $posRight++;
                    break;
                }
            }
        }

        return $allRight."A". $posRight."B";

    }
}
?>