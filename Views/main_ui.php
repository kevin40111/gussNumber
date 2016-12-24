<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<title>猜數字</title>
<style type="text/css">
input::-webkit-inner-spin-button{
    -webkit-appearance: none !important;
    margin: 0;
}
input[type="number"]{-moz-appearance:textfield;}

#main{
width:500px;
margin:auto;
border: 1px solid;
position:relative;
padding: 10px;
}

.block{
    float: left;
}
.content{
    clear:left;
}

.top-block-title{
    padding-left:5px;
}

.top-block-answer-prompt{
    padding-left: 20px;
    padding-top: 33px;
    font-size: 20px;
}

.top-block-button {
    margin-top:25px;
    position:absolute;
    right:0px;
    padding-right: 20px;
}

.top-block-button > #restart{
    font-size: 20px;
    width:120px;
}

.middle-block-input-form{
    padding-top: 10px;
    width:100%;
}

.middle-block-input-form > input{
    font-size: 20px;
}

.middle-block-input-form > #answer_input{
    width: 50%;
}

.middle-block-input-form > #answer_submit{
    width:100px;
    margin-left: 10px;
}

.middle-block-input-form > #display_input{
    visibility: hidden;
    color:red;
}

.footer-block-record {
    position: relative;
    margin-top: 5px;
    width: 100%;
}


.footer-block-record > #record_panel{
    overflow-y: auto ;
    overflow-x: hidden;
    visibility: hidden;
    border:1px solid;
    width:50%;
    height: 250px;
}

 #record_panel > .clear{
    display: none;
 }


.footer-block-record > #download_record{
    position: absolute;
    margin-left: 10px;
    font-size: 20px;
    bottom:0px;
}

</style>
<script>
var inputRecord = [];

function checkRepeat(inputAnswer){
    var exist = false;
    for(var i=0;i<inputRecord.length;i++){
        if(inputRecord[i]==inputAnswer){
        exist=true;
        break;
        }
    }
    return exist;
}

$(document).ready(function(){
    $('#answer_submit').click(function(){

        $.ajax({
            type: 'POST',
            url: "index.php",
            data:"action=checkAnswer&inputAnswer="+$("#answer_input").val(),
            dataType: 'text',
            success: function(result){
                var inputAnswer = $("#answer_input").val();
                if(!checkRepeat(inputAnswer)){
                    inputRecord.push(inputAnswer);

                    if(result == "正解"){
                        $("#display_answer").text($("#answer_input").val()+"："+result);
                        $('.middle-block-input-form > input').css("visibility","hidden");
                    }else{
                        $("#display_answer").text("你輸入的答案是"+inputAnswer+"："+result);
                        $("#display_input").css("visibility","visible");
                    }
                    $("#record_panel").css("visibility","visible");
                    $("#record_panel").append("<br><span data='inputAnswer'>"+inputAnswer+"</span>："+result+"<span class='clear'>!</span>");
                }else{
                    $("#display_answer").text("此答案已經輸入過了");
                }
                $("#answer_input").val("");
            }
        });
    });

    $('#restart').click(function(){
        $.ajax({
            type: 'POST',
            url: "index.php",
            data:"action=restartGame",
            dataType: 'text',
            success: function(result){
            location.reload();
            }
        });
    });

    $('#download_record').click(function(){
        var url = "getfile.php";
            url += "?action=downloadRecord";
            url += "&inputData="+$("#record_panel").text();
        window.location = url;
    });

});
</script>
</head>
<body>
<div id = "main">
    <div class="content top-content">
        <div class = "block top-block-title">
            <b><h1>猜數字</h1></b>
        </div>
        <div class = "block top-block-answer-prompt">
            <span>答案提示：<?=$answer;?></span>
            <span id="answer"></span>
        </div>
        <div class = "block top-block-button">
            <input id="restart" class = "button" type="button" value="重新遊戲">
        </div>
    </div>
    <div class="content middle-content">
        <div class="block middle-block-input-form">
            <input id="answer_input" type="number" placeholder="請輸入不重複的數字" name="answer_input">
            <input id="answer_submit" class="button" type="button" value="GO" >
            <p id = "display_input">
                <span id = "display_answer">-</span>
            </p>
        </div>
    </div>
    <div class="content footer-content">
        <div class = "block footer-block-record">
            <div id="record_panel" class="block">作答紀錄<span class="clear">!</span></div>
            <input id="download_record" type="button" value="下載作答紀錄" >
        </div>
    </div>

    <div class="content end-content"></div>
</div>
</body>
</html>