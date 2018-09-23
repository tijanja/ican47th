<?php
include_once 'model/Connection.php';
$msg="";
if(isset($_POST['save']))
{
    $db = new mysqli('localhost', 'root', 'Project123', 'ICAN');
    $question = trim($_POST['question']);
    $option1 = trim($_POST['option1']);
    $option2 = trim($_POST['option2']);
    $option3 = trim($_POST['option3']);
    $answer = trim($_POST['answer']);
    
    $res = $db->query("INSERT INTO question_table VALUES('','$question','$answer','$option1','$option2','$option3','')");
    
    if($res)
    {
        $msg = 'Question saved';
    }
 else {
        $msg = $db->error;
    }
            
   
}
?>

<html>
    <body>
        <form method="post" action="?">
            <h3><?php echo $msg; ?></h3>
            <textarea cols="50" rows="5" name="question" placeholder="Enter Question"></textarea><br><br>
            <input type="text" name="option1" placeholder="Option 1" /><br><br>
            <input type="text" name="option2" placeholder="Option 2"/><br><br>
            <input type="text" name="option3" placeholder="Option 3"/><br><br>
            <input type="text" name="answer" placeholder="Answer"/><br><br>
            
            <input type="submit" name="save" value="Save"/>
            
        </form>
    </body>
</html>
