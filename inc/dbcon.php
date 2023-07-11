<?php

$host = "";
$user = "";
$password = "";
$db = "";

$conn = mysqli_connect($host, $user, $password, $db);

if(!$conn){
    die("Connection Failed: ".mysqli_connect_error());
}

?>