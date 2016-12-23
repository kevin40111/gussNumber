<?php
    class Model{
            public $answer;
            public $answerRecord = array();






            function createAnswer(){
                $checkRepeat = array();
                $this->answer = "";
                for($i=0;$i<4;$i++){
                    while(1)
                    {
                        $rand = rand(0,9);
                        if(!in_array($rand, $checkRepeat))break;
                    }
                    array_push($checkRepeat,$rand);
                }
                foreach ($checkRepeat as $value) {
                     $this->answer .= $value;
                }
            }
            function checkAnswer($inputAnswer){

            }
        }
?>