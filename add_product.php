<?php
    // include database config
    include('config/db_connect.php');

    // Brand query
    $br_sql = "SELECT * FROM brands";
    $br_result = mysqli_query($conn, $br_sql);
    $brds = mysqli_fetch_all($br_result, MYSQLI_ASSOC);

    // Category query
    $cat_sql = "SELECT * FROM categories";
    $cat_result = mysqli_query($conn, $cat_sql);
    $cats = mysqli_fetch_all($cat_result, MYSQLI_ASSOC);

    // Add form
    $pro_name = $brand = $category = $quantity = '';
    $errors = array('pro_name' => '', 'brand' => '', 'category' => '', 'quantity' => '');

    if(isset($_POST['submit'])) {

        // check name
		if(empty($_POST['product-name'])){
			$errors['pro_name'] = 'A name is required';
		} else{
            $pro_name = $_POST['product-name'];
        }

        // check brand
        if(empty($_POST['brand'])){
			$errors['brand'] = 'A brand is required';
		} else{
            $brand = intval($_POST['brand']);
        }

        // check category
        if(empty($_POST['category'])){
			$errors['category'] = 'A category is required';
		} else{
            $category = intval($_POST['category']);
        }

        // check quantity       
        if(empty($_POST['quantity'])){
			$errors['quantity'] = 'A quantity is required';
		} else{
			$quantity = intval($_POST['quantity']);
        }
        
        if(array_filter($errors)){
            //echo 'errors in form';
        } else {
            $pro_name = mysqli_real_escape_string($conn, $_POST['product-name']);
            $brand = intval(mysqli_real_escape_string($conn, $_POST['brand']));
            $category = intval(mysqli_real_escape_string($conn, $_POST['category']));
            $quantity = intval(mysqli_real_escape_string($conn, $_POST['quantity']));
    
            // create sql
            $sql = "INSERT INTO products(pro_name, br_id, cat_id, quantity) VALUES('$pro_name', '$brand', '$category', '$quantity')";
    
            if (mysqli_query($conn, $sql)) {
                header('Location: inventory.php');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
    
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add product</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>

    <button type="button" class="btn btn-success" id="btn-add" data-toggle="modal" data-target="#add_product">Add product</button>

    <!-- Add product modal -->
    <div class="modal fade" id="add_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add product</h5>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="add_product.php">
                        <div class="form-group">
                            <label>Product name</label>
                            <input type="text" name="product-name" class="form-control" placeholder="Enter product name">
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
                            <input type="text" name="quantity" class="form-control" placeholder="Enter quantity">
                        </div>
                        <div class="text-right">
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

