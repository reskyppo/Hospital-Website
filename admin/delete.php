<?php
require_once("../conn.php");
$pdo_statement=$pdo->prepare("delete from control where id=" . $_GET['id']);
$pdo_statement->execute();
unlink('../file/'.$_GET['gambar']);
header('location:panel.php');
?>