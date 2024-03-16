<?php
$db = new SQLite3('../cart.db');
$name = $_POST['name'];
$query = "DELETE FROM categories WHERE name='$name'";
$db->exec($query);
$db->close();

header('Location: ../admin.php');
exit();
?>