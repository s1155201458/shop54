<?php
$db = new SQLite3('../cart.db');
$pid = $_POST['pid'];
$catid = $_POST['catid'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$query = "UPDATE products SET catid='$catid', name='$name', description='$description', price='$price' WHERE pid='$pid'";
$db->exec($query);
$db->close();

header('Location: ../admin.php');
exit();
?>
