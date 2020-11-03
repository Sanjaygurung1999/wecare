<?php
include_once('DbConfig.php');
$con=new DbConfig();
$docid=$_POST['id'];
$update=$con->connection->query("UPDATE signup set active='1' where id='$docid'");
?>