<?php
    // include database config
    include('config/db_connect.php');
    
    // Category query
    $cat_sql = 'SELECT * FROM categories';
    $cat_result = mysqli_query($conn, $cat_sql);
    $categories = mysqli_fetch_all($cat_result, MYSQLI_ASSOC);

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
    <?php include('action_category.php'); ?>

    <div class="container">
        <div class="title">
            <h1>Manage Categories</h1>
            <hr class="solid">
            <?php include('add_category.php') ?>
        </div>
        
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Category Name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach($categories as $category): ?>
                    <tr>
                        <th scope="row">
                            <?php
                                $i++;
                                echo $i;
                            ?>
                        </th>
                        <td><?php echo htmlspecialchars($category['category_name']); ?></td>
                        <td>
                            <a type="button" href="#edit_category<?php echo $category['category_id']; ?>" class="btn btn-success" data-toggle="modal">Edit</a>
                            <a type="button" href="#delete_category<?php echo $category['category_id']; ?>" class="btn btn-danger" data-toggle="modal">Delete</a>
                        </td>
                    </tr>

                    <!-- Edit category menu -->
                    <div class="modal fade" id="edit_category<?php echo $category['category_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit category</h5>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="category.php">
                                        <input type="hidden" name="cat_id" value="<?php echo $category['category_id']; ?>">
                                        <div class="form-group">
                                            <label>Category name</label>
                                            <input type="text" name="category-name" class="form-control" value="<?php echo $category['category_name']; ?>">
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

                    <!-- Delete category modal -->
                    <div class="modal fade" id="delete_category<?php echo $category['category_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete category</h5>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="category.php">
                                        <input type="hidden" name="cat_id" value="<?php echo $category['category_id']; ?>">
                                        <p>Are you sure to delete this category ?</p>
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