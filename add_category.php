<?php
    // include database config
    include('config/db_connect.php');

    // Add form
    $category_name = '';
    $errors = array('category-name' => '');

    if(isset($_POST['submit'])) {

        // check name
		if(empty($_POST['category-name'])){
			$errors['category-name'] = 'A name is required';
		} else{
            $category_name = $_POST['category-name'];
        }

        if(array_filter($errors)){
            //echo 'errors in form';
        } else {
            $category_name = mysqli_real_escape_string($conn, $_POST['category-name']);
    
            // create sql
            $add_sql = "INSERT INTO categories(category_name) VALUES('$category_name')";
    
            if (mysqli_query($conn, $add_sql)) {
                header('Location: category.php');
            } else {
                echo "Error: " . $add_sql . "<br>" . mysqli_error($conn);
            }
    
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add category</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>

    <button type="button" class="btn btn-success" id="btn-add" data-toggle="modal" data-target="#add-category">Add category</button>

    <!-- Add brand menu -->
    <div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add category</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="add_category.php">
                        <div class="form-group">
                            <label>Category name</label>
                            <input type="text" name="category-name" class="form-control" placeholder="Enter category name">
                        </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary" >Add</button>
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
