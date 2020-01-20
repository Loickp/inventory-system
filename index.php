<?php 
  $request = $_SERVER['REQUEST_URI'];

  switch ($request) {
      case '/' :
          require __DIR__ . '/index.php';
          break;
      case '/lol' :
          require('/inventory.php');
          break;
  }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inventory system</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <?php include('template/header.php') ?>
 
    <div class="container" id="manage">
        <div class="row">
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Inventory</h5>
                  <p class="card-text">Manage your inventory</p>
                  <a href="inventory.php" class="btn btn-primary">Manage</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Brand</h5>
                  <p class="card-text">Manage all brands</p>
                  <a href="brand.php" class="btn btn-primary">Manage</a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Category</h5>
                    <p class="card-text">Manage all categories</p>
                    <a href="category.php" class="btn btn-primary">Manage</a>
                  </div>
                </div>
              </div>
        </div>
    </div>
</body>
</html>