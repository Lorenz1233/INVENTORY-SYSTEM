<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
 include 'db.php';

  if(isset($_GET['id'])){
    $id=intval($_GET['id']);

    $delete=mysqli_query($conn, "UPDATE items SET status='inactive' WHERE item_id='$id'");

    if($delete){
     header("location:admin_dashboard.php");
      exit;
    }

   else{
    echo "Failed to delete:". mysqli_error($conn);
    }
  }
  else {
    echo "error".mysqli_error($conn);
  }
?>