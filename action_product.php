<?php
    include('config/db_connect.php');

    // Edit Form
    if(isset($_POST['edit'])) {
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
            $pro_id = $_POST['pro_id'];
            $pro_name = mysqli_real_escape_string($conn, $_POST['product-name']);
            $brand = intval(mysqli_real_escape_string($conn, $_POST['brand']));
            $category = intval(mysqli_real_escape_string($conn, $_POST['category']));
            $quantity = intval(mysqli_real_escape_string($conn, $_POST['quantity']));
    
            // create sql
            $edit_sql = "UPDATE products SET pro_name = '$pro_name', br_id = '$brand', cat_id = '$category', quantity = '$quantity' WHERE pro_id = $pro_id";
    
            if (mysqli_query($conn, $edit_sql)) {
                header('Location: inventory.php');
            } else {
                echo "Error: " . $edit_sql . "<br>" . mysqli_error($conn);
            }
    
        }
    }

    // Delete form
    if(isset($_POST['delete'])) {
        $pro_id = $_POST['pro_id'];

        // create sql
        $delete_sql = "DELETE FROM products WHERE pro_id = $pro_id";

        if (mysqli_query($conn, $delete_sql)) {
            header('Location: inventory.php');
        } else {
            echo "Error: " . $delete_sql . "<br>" . mysqli_error($conn);
        }
    }
?>