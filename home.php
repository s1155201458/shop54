<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Shopping Website</title>
  <link href="style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <header class="list-container">
    <div id="login"><a href="admin.php">Login</a>
      <div id="login"></div>
    </div>
    <div id="list-content">
      Shopping List
      <div id="listContainer"></div>
    </div>
  </header>

  <div class="container-fluid text-center">
    <div class="row content">
      <ul class="col-sm-3 list-group">
        <li class="list-group-item"><a href="home.php">Home</a></li>
        <li class="list-group-item"><a href="?catid=4">Food</a></li>
        <li class="list-group-item"><a href="?catid=5">Clothes</a></li>
        <li class="list-group-item"><a href="?catid=6">Stationary</a></li>
      </ul>
      <div id="category1" class="col-sm-9">
        <div class="container mt-4">
          <div class="row">
            <?php
            $products = include 'lib/selectfromcatid.php';
            if (!isset($_GET['catid'])) {
              foreach ($products as $product) {
                ?>
                <div class="col-md-4 col-sm-6">
                  <div class="product-item">
                    <a href="product-details.php?pid=<?= urlencode($product['pid']) ?>">
                      <img alt="<?= htmlspecialchars($product['name']) ?>"
                        src="images/<?= htmlspecialchars($product['image']) ?>" class="product-image" />
                    </a>
                    <a href="product-details.php?pid=<?= urlencode($product['pid']) ?>">
                      <h3>
                        <?= htmlspecialchars($product['name']) ?>
                      </h3>
                    </a>
                    <p>
                      <?= htmlspecialchars($product['description']) ?>
                    </p>
                    <p class="price">Price: $
                      <?= number_format($product['price'], 2) ?>
                    </p>
                    <button type="button"
                      onclick="addToCart('<?= addslashes(htmlspecialchars($product['name'])) ?>', <?= htmlspecialchars($product['price']) ?>)">Add to Cart</button>
                  </div>
                </div>
                <?php
              }
            } else {
              foreach ($products as $product) {
                ?>
                <div class="col-md-4 col-sm-6">
                  <div class="product-item">
                    <a href="product-details.php?pid=<?= urlencode($product['pid']) ?>">
                      <img alt="<?= htmlspecialchars($product['name']) ?>"
                        src="images/<?= htmlspecialchars($product['image']) ?>" class="product-image" />
                    </a>
                    <a href="product-details.php?pid=<?= urlencode($product['pid']) ?>">
                      <h3>
                        <?= htmlspecialchars($product['name']) ?>
                      </h3>
                    </a>
                    <p>
                      <?= htmlspecialchars($product['description']) ?>
                    </p>
                    <p class="price">Price: $
                      <?= number_format($product['price'], 2) ?>
                    </p>
                    <button type="button"
                      onclick="addToCart('<?= addslashes(htmlspecialchars($product['name'])) ?>', <?= htmlspecialchars($product['price']) ?>)">Add
                      to Cart</button>
                  </div>
                </div>
                <?php
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
