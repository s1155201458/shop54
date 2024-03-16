<?php
$db = new SQLite3('../cart.db');
$pid = $_POST['pid'];
$query = "DELETE FROM products WHERE pid='$pid'";
$db->exec($query);
$db->close();

header('Location: ../admin.php');
exit();
?>
