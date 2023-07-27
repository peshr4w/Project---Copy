<?php
include('conf.php');
$inboxId = $_GET['inboxId'];
$res = $conn->query("delete from inbox where id = '$inboxId'");
if($res){
    echo("deleted");
}
