<?php
$db = new SQLite3('../cart.db');
$query = "SELECT * FROM categories";
$result = $db->query($query);
echo "<h2>Category List</h2>";
echo "<table border='1'>";
echo "<tr><th>Category ID</th><th>Name</th></tr>";
while ($row = $result->fetchArray()) {
    echo "<tr>";
    echo "<td>".$row['catid']."</td>";
    echo "<td>".$row['name']."</td>";
    echo "</tr>";
}
echo "</table>";

$db->close();
?>
