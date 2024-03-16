<?php
$db = new SQLite3('../cart.db');
$query = "SELECT products.*, categories.name as catname FROM products JOIN categories ON products.catid = categories.catid";
$result = $db->query($query);
echo "<h2>Product List</h2>";
echo "<table border='1'>";
echo "<tr><th>Product ID</th><th>Category</th><th>Name</th><th>Description</th><th>Price</th><th>Image</th></tr>";
while ($row = $result->fetchArray()) {
    echo "<tr>";
    echo "<td>".$row['pid']."</td>";
    echo "<td>".$row['catname']."</td>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['description']."</td>";
    echo "<td>".$row['price']."</td>";
    echo "<td><img src='images/".$row['image']."' width='100'></td>";
    echo "</tr>";
}
echo "</table>";

$db->close();
?>
