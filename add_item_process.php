<?php
include 'db.php';

if(isset($_POST['available_quantity'])){

 $item_name=$_POST['item_name'];
 $category=$_POST['category'];
 $quantity=$_POST['quantity'];
 $available_quan=$_POST['available_quantity'];
 $date_added=date("Y-m-d");
 $description=$_POST['description'];
 $unit= $_POST['unit_id'];
 $official=$_POST['received'];
 
 $query=mysqli_query($conn, 
   "INSERT INTO items (item_name,category_id,quantity,available_quantity,date_added,description,unit_id,received_by)
    values ('$item_name','$category','$quantity','$available_quan','$date_added','$description','$unit',$official')"
    );

    if($quantity<1){
      echo "Please input a number greater than zero";
      exit;
    }

    if($available_quan<0){
      echo "Please input a number greater than zero";
      exit;
    }


  if($query){
   header("location: admin_dashboard.php?success=1");
  } 
  else{
    echo 'please add it again';
  }
}
else {
    echo "Please try again";
}
?>