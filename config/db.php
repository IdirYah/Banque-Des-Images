<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'l2info';
$conn = new mysqli($host,$user,$password,$dbname);
if($conn->connect_error){
    die("Erreur de connexion : ".$conn->connect_error);
}
?>
