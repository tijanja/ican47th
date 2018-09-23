<?php
$db = new mysqli('localhost', 'root', 'Project123', 'ICAN');
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$result = $db->query("select * from Members where memberId='$username' and registrationNum='$password'");
print_r($result);        
if($result->num_rows>0)
{
    
}
