<?php
include_once '../model/include.php';
include_once '../model/excel_reader2.php';

$db = new mysqli('localhost', 'root', 'Project123', 'ICAN');
        
        if($db->connect_errno > 0){
            die('Unable to connect to database [' . $db->connect_error . ']');
        }

if(isset($_POST['submit']))
{
 $file = $_FILES['xlfile']['tmp_name']; 

        

$result = array();



$xls = new Spreadsheet_Excel_Reader($file,false);


for($i=2;$i<619;$i++)
{
    
    $lName = $db->real_escape_string(trim($xls->val($i, "C")));
      $fName = $db->real_escape_string(trim($xls->val($i, "B")));
      $regId =  $db->real_escape_string(trim($xls->val($i, "E")));
      $memberid = $db->real_escape_string(trim($xls->val($i, "A")));
    
    $db->query("INSERT INTO Members VALUES('','$memberid','$regId','$fName','$lName','','','')");
    
    echo $fName.'<br>';
}
//$array_prefix = explode(":", $gcp);
//$date = date("Y-m-d");
//$prefix = trim($array_prefix[1]);
//$num_range = getNumRange($regId); //$prefix; */   
}
 else {
    echo 'Ooops!!';
}





?>

<html>
    <body>
        <form action="?" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="xlfile" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
    </body>
</html>