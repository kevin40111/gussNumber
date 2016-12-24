<?php
class Model{
    function createAnswer(){
        $checkRepeat = array();
        $answer = "";
        $answerLenth = rand(4,10);
        for($i=0;$i<$answerLenth;$i++){
            while(1){
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

    function checkAnswer($inputAnswer,$realAnswer){

        $posRight=0;
        $allRight=0;
        $inputArray  = preg_split('//', $inputAnswer, -1, PREG_SPLIT_NO_EMPTY);
        $answerArray = preg_split('//', $realAnswer, -1, PREG_SPLIT_NO_EMPTY);

        if(sizeof($answerArray)!= sizeof($inputArray))return "輸入長度不正確";

        for($i=0;$i<sizeof($answerArray);$i++){
            for($j=0;$j<sizeof($answerArray);$j++){
                if($inputArray[$i] == $answerArray[$j] && $i==$j){
                    $allRight++;
                    break;
                }else if($inputArray[$i] == $answerArray[$j] && $i!=$j){
                    $posRight++;
                    break;
                }
            }
        }

        $answerResult = $allRight."A". $posRight."B";
        if($posRight==0){
            return "正解";
        }else{
            return $answerResult;
        }

    }
}
?>