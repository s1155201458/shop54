<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Details</title>
  <link href="../style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <header class="list-container">
    <div id="login"><a href="./admin.php">Login</a></div>
    <div id="list-content">
      Shopping List
      <div id="listContainer"></div>
    </div>
  </header>

  <div class="container mt-4">
    <?php
    $db = new SQLite3('./cart.db');
    $pid = $_GET['pid'];
    $query = 'SELECT pid, catid, name, description, price, image FROM products WHERE pid = ' . $pid;
    $result = $db->query($query);

    while ($row = $result->fetchArray(SQLITE3_ASSOC)):
      ?>
      <div class="row">
        <div class="col-md-5">
          <img alt="<?= htmlspecialchars($row['name']) ?>" src="images/<?= htmlspecialchars($row['image']) ?>"
            class="details-image" />
        </div>

        <div class="col-md-7 product-details">
          <h2>
            <?= htmlspecialchars($row['name']) ?>
          </h2>
          <p>
            <?= htmlspecialchars($row['description']) ?>
          </p>
          <p class="price">Price: $
            <?= number_format($row['price'], 2) ?>
          </p>
          <button type="button"
            onclick="addToCart('<?= addslashes(htmlspecialchars($row['name'])) ?>', <?= htmlspecialchars($row['price']) ?>)">Add to Cart</button>
        </div>
      </div>
    <?php endwhile; ?>
    <?php $db->close(); ?>
  </div>
</body>

</html>
