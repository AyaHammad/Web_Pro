<?php
include 'connect.php';
$id = $_GET['id'];
$sql_delete = "DELETE FROM tblemployees WHERE id=$id";
$conn->exec($sql_delete);
header("Location: manage.php");
?>