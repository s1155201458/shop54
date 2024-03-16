<?php
$db = new SQLite3('../cart.db');
$name = $_POST['name'];
$catid = $_POST['catid'];
$query = "UPDATE categories SET name='$name' WHERE catid='$catid'";
$db->exec($query);
$db->close();

header('Location: ../admin.php');
exit();
?>
