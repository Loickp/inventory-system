<?php
    include('config/db_connect.php');

    // Edit Form
    if(isset($_POST['edit'])) {

        // check name
		if(empty($_POST['category-name'])){
			$errors['category-name'] = 'A name is required';
		} else{
            $category_name = $_POST['category-name'];
        }

        if(array_filter($errors)){
            //echo 'errors in form';
        } else {
            $cat_id = $_POST['cat_id'];
            $category_name = mysqli_real_escape_string($conn, $_POST['category-name']);
    
            // create sql
            $edit_sql = "UPDATE categories SET category_name = '$category_name' WHERE category_id = $cat_id";
    
            if (mysqli_query($conn, $edit_sql)) {
                header('Location: category.php');
            } else {
                echo "Error: " . $edit_sql . "<br>" . mysqli_error($conn);
            }
    
        }
    }

    // Delete form
    if(isset($_POST['delete'])) {
        $cat_id = $_POST['cat_id'];

        // create sql
        $delete_sql = "DELETE FROM categories WHERE category_id = $cat_id";

        if (mysqli_query($conn, $delete_sql)) {
            header('Location: category.php');
        } else {
            echo "Error: " . $delete_sql . "<br>" . mysqli_error($conn);
        }
    }
?>