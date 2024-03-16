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
    <div id="login"><a href="admin.html">Login</a>
    </div>
    <div id="list-content">
      Shopping List
      <div id="listContainer"></div>
    </div>
  </header>

  <div class="container-fluid text-center">
    <div class="row content">
      <div id="category1">
        <fieldset>
          <label for="catid">Category:</label><br>
          <select id="catid" name="catid">
            <?php
            $db = new PDO('sqlite:./cart.db');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $db->prepare("SELECT catid, name FROM categories ORDER BY name");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($results):
              ?>
              <?php
              foreach ($results as $row):
                ?>
                <option value="<?= $row['catid']; ?>">
                  <?= $row['name']; ?>
                </option>
                <?php
              endforeach;
              ?>
            </select><br>
            <?php
            endif;
            ?>
        </fieldset>
        <fieldset>
          <legend>Create Product</legend>
          <form method="POST" action="lib/createproduct.php" enctype="multipart/form-data">
            <input type="hidden" class="hiddencatid" name="catid"><br>
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name"><br>
            <label for="description">Description:</label><br>
            <textarea id="description" name="description"></textarea><br>
            <label for="price">Price:</label><br>
            <input type="text" id="price" name="price"><br>
            <label for="image">Image:</label><br>
            <input type="file" id="image" name="image"><br>
            <input type="submit" value="Submit">
          </form>
        </fieldset>
        <fieldset>
          <legend>Read Product</legend>
          <button onclick="toggleProductList()">Toggle Product List</button>
          <div id="productList" style="display: none;">
            <?php include 'lib/readproduct.php'; ?>
          </div>
        </fieldset>
        <fieldset>
          <legend>Update Product</legend>
          <form action="lib/updateproduct.php" method="POST">
            <label for="pid">Product ID:</label><br>
            <input type="text" id="pid" name="pid"><br>
            <input type="hidden" class="hiddencatid" name="catid"><br>
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name"><br>
            <label for="description">Description:</label><br>
            <textarea id="description" name="description"></textarea><br>
            <label for="price">Price:</label><br>
            <input type="text" id="price" name="price"><br>
            <input type="submit" value="Update">
          </form>
        </fieldset>
        <fieldset>
          <legend>Delete Product</legend>
          <form action="lib/deleteproduct.php" method="POST">
            <label for="pid">Product ID:</label><br>
            <input type="text" id="pid" name="pid" required><br>
            <input type="submit" value="Delete">
          </form>
        </fieldset>
        <fieldset>
          <legend>Create Categories</legend>
          <form method="POST" action="lib/createcategory.php" enctype="multipart/form-data">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name"><br>
            <input type="submit" value="Submit">
          </form>
        </fieldset>
        <fieldset>
          <legend>Read Categories</legend>
          <button onclick="toggleCategoriesList()">Toggle Categories List</button>
          <div id="CategoriesList" style="display: none;">
            <?php include 'lib/readcategory.php'; ?>
          </div>
        </fieldset>
        <fieldset>
          <legend>Update Categories</legend>
          <form action="lib/updatecategory.php" method="POST">
            <label for="catid">Category ID:</label><br>
            <input type="text" id="catid" name="catid"><br>
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name"><br>
            <input type="submit" value="Update">
          </form>
        </fieldset>
        <fieldset>
          <legend>Delete Categories</legend>
          <form action="lib/deletecategory.php" method="POST">
            <label for="name">Category Name:</label><br>
            <input type="text" id="catename" name="name" required><br>
            <input type="submit" value="Delete">
          </form>
        </fieldset>
      </div>
    </div>
  </div>

  <script>
    function toggleProductList() {
      var productList = document.getElementById("productList");
      if (productList.style.display === "none") {
        productList.style.display = "block";
      } else {
        productList.style.display = "none";
      }
    }

    function toggleCategoriesList() {
      const categoriesList = document.getElementById('CategoriesList');
      if (categoriesList.style.display === 'none') {
        categoriesList.style.display = 'block';
      } else {
        categoriesList.style.display = 'none';
      }
    }

    $(document).ready(function () {
      $('#catid').on('change', function () {
        var selectedCatId = $(this).val();
        $('.hiddencatid').val(selectedCatId);
      });
    });
  </script>
</body>

</html>