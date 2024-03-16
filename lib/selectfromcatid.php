<?php
$pdo = new PDO('sqlite:../cart.db');
if(isset($_GET['catid'])) {
    $catid = (int)$_GET['catid'];
    $stmt = $pdo->prepare('SELECT pid, catid, name, description, price, image FROM products WHERE catid = :catid');
    $stmt->bindParam(':catid', $catid, PDO::PARAM_INT);
} else {
    $stmt = $pdo->prepare('SELECT pid, catid, name, description, price, image FROM products');
}
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

return $products;
?>
