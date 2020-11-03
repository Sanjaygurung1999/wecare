<?php
include_once('DbConfig.php');
$con=new DbConfig();
if(isset($_POST['accept'])){
    $id=$_POST['id'];
    $accept=$con->connection->query("UPDATE booking SET active='1' where id='$id'");
}
else if(isset($_POST['reject'])){
    $id=$_POST['id'];
    $reject=$con->connection->query("DELETE from booking where id='$id'");
}
?>