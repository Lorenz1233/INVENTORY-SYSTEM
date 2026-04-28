<?php
include 'db.php';

if (isset($_POST['category_name'])){
    $category= $_POST['category_name'];
    $ct=mysqli_query($conn, "INSERT into category (category_name) values('$category')");
    if($ct){
        header("location: admin_dashboard.php");
        exit;
    }
    else{
        echo "There was a problem adding category";
    }
}
else {
    echo "ERROR";
}
?>