<?php
$conn = new mysqli('localhost:3307','root','','project');
if(!$conn){
    die("connection error ".$conn->connect_error);
}