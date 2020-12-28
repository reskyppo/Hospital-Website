<?php
require_once("../conn.php");
$data = [
    'status' => 'verify',
    'id' => $_GET['id'],
];
$sql = "UPDATE control SET status=:status WHERE id=:id";
$stmt= $pdo->prepare($sql);
$saved = $stmt->execute($data);
if ($saved) {
  header("Location: panel.php");
}
?>