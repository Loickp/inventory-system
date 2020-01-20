<?php
    // include database config
    include('config/db_connect.php');
    
    // Brand query
    $brd_sql = 'SELECT * FROM brands';
    $brd_result = mysqli_query($conn, $brd_sql);
    $brands = mysqli_fetch_all($brd_result, MYSQLI_ASSOC);

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
    <?php include('action_brand.php'); ?>

    <div class="container">
        <div class="title">
            <h1>Manage Brands</h1>
            <hr class="solid">
            <?php include('add_brand.php') ?>
        </div>
        
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Brand Name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach($brands as $brand): ?>
                    <tr>
                        <th scope="row">
                            <?php
                                $i++;
                                echo $i;
                            ?>
                        </th>
                        <td><?php echo htmlspecialchars($brand['brand_name']); ?></td>
                        <td>
                            <a type="button" href="#edit_brand<?php echo $brand['brand_id']; ?>" class="btn btn-success" data-toggle="modal">Edit</a>
                            <a type="button" href="#delete_brand<?php echo $brand['brand_id']; ?>" class="btn btn-danger" data-toggle="modal">Delete</a>
                        </td>
                    </tr>

                    <!-- Edit brand menu -->
                    <div class="modal fade" id="edit_brand<?php echo $brand['brand_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit brand</h5>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="brand.php">
                                        <input type="hidden" name="brd_id" value="<?php echo $brand['brand_id']; ?>">
                                        <div class="form-group">
                                            <label>Brand name</label>
                                            <input type="text" name="brand-name" class="form-control" value="<?php echo $brand['brand_name']; ?>">
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

                     <!-- Delete brand modal -->
                     <div class="modal fade" id="delete_brand<?php echo $brand['brand_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete brand</h5>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="brand.php">
                                        <input type="hidden" name="brd_id" value="<?php echo $brand['brand_id']; ?>">
                                        <p>Are you sure to delete this brand ?</p>
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
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>