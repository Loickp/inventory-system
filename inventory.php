<?php
    // include database config
    include('config/db_connect.php');
    
    // Product query
    $pro_sql = 'SELECT pro_id, pro_name, br_id, cat_id, quantity, brand_id, brand_name, category_id, category_name FROM products INNER JOIN brands ON products.br_id = brands.brand_id INNER JOIN categories ON products.cat_id = categories.category_id';
    $pro_result = mysqli_query($conn, $pro_sql);
    $products = mysqli_fetch_all($pro_result, MYSQLI_ASSOC);

    // Var for number of products
    $i = 0;
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
    <?php include('action_product.php'); ?>

    <div class="container">
        <div class="title">
            <h1>Manage Inventory</h1>
            <hr class="solid">
            <?php include('add_product.php') ?>
        </div>
        
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Product Name</th>
                <th scope="col">Brand</th>
                <th scope="col">Category</th>
                <th scope="col">Quantity</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product): ?>
                    <tr>
                        <th scope="row">
                            <?php
                                $i++;
                                echo $i;
                            ?>
                        </th>
                        <td><?php echo htmlspecialchars($product['pro_name']); ?></td>
                        <td><?php echo htmlspecialchars($product['brand_name']); ?></td>
                        <td><?php echo htmlspecialchars($product['category_name']); ?></td>
                        <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                        <td>
                            <a type="button" href="#edit_product<?php echo $product['pro_id']; ?>" class="btn btn-success" data-toggle="modal">Edit</a>
                            <a type="button" href="#delete_product<?php echo $product['pro_id']; ?>" class="btn btn-danger" data-toggle="modal">Delete</a>
                        </td>
                    </tr>

                    <!-- Edit product modal -->
                    <div class="modal fade" id="edit_product<?php echo $product['pro_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit product</h5>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="inventory.php">
                                        <input type="hidden" name="pro_id" value="<?php echo $product['pro_id']; ?>">
                                        <div class="form-group">
                                            <label>Product name</label>
                                            <input type="text" name="product-name" class="form-control" value="<?php echo $product['pro_name']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <select class="form-control" name="brand">
                                                <?php foreach($brds as $brd): ?>
                                                    <option value="<?php echo $brd["brand_id"]; ?>"><?php echo htmlspecialchars($brd["brand_name"]); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" name="category">
                                                <?php foreach($cats as $cat): ?>
                                                    <option value="<?php echo $cat["category_id"]; ?>"><?php echo htmlspecialchars($cat["category_name"]); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="text" name="quantity" class="form-control" value="<?php echo $product['quantity']; ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete product modal -->
                    <div class="modal fade" id="delete_product<?php echo $product['pro_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete product</h5>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="inventory.php">
                                        <input type="hidden" name="pro_id" value="<?php echo $product['pro_id']; ?>">
                                        <p>Are you sure to delete this product</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>      
</body>
</html>