<?php
$conn = new mysqli('localhost','root','','school');

if($conn->connect_error){
    die('Connection Failed'.$conn->connect_error);
}

?>