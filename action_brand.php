<?php
    include('config/db_connect.php');

    // Edit Form
    if(isset($_POST['edit'])) {

        // check name
		if(empty($_POST['brand-name'])){
			$errors['brand-name'] = 'A name is required';
		} else{
            $brand_name = $_POST['brand-name'];
        }

        if(array_filter($errors)){
            //echo 'errors in form';
        } else {
            $brd_id = $_POST['brd_id'];
            $brand_name = mysqli_real_escape_string($conn, $_POST['brand-name']);
    
            // create sql
            $edit_sql = "UPDATE brands SET brand_name = '$brand_name' WHERE brand_id = $brd_id";
    
            if (mysqli_query($conn, $edit_sql)) {
                header('Location: brand.php');
            } else {
                echo "Error: " . $edit_sql . "<br>" . mysqli_error($conn);
            }
    
        }
    }

    // Delete form
    if(isset($_POST['delete'])) {
        $brd_id = $_POST['brd_id'];

        // create sql
        $delete_sql = "DELETE FROM brands WHERE brand_id = $brd_id";

        if (mysqli_query($conn, $delete_sql)) {
            header('Location: brand.php');
        } else {
            echo "Error: " . $delete_sql . "<br>" . mysqli_error($conn);
        }
    }
?>