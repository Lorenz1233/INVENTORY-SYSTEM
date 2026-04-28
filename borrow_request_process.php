<?php
include 'db.php';

if (isset($_POST['student_id'])){

    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    $user_id = $_POST['student_id'];
    $days = $_POST['return_date'];
    $request_date = date("Y-m-d");
    $return_date= date("Y-m-d",strtotime("+$days days"));
    
    $check = mysqli_query($conn, "SELECT * FROM master_list where student_id='$user_id'");
    $get = mysqli_fetch_assoc($check);
   
      if($get){

           $req = mysqli_query($conn, "INSERT INTO borrow_request (item_id, quantity_request, student_id, days_to_return, request_date) 
            VALUES ('$item_id','$quantity','$user_id','$days','$request_date')");

            $REQUEST=mysqli_insert_id($conn);

            $approval=mysqli_query($conn, "INSERT into transactions (request_id, borrow_date, return_date)
                                   values ('$REQUEST','$request_date','$return_date' )");
        

            if($req && $approval){
                header("location: borrow_request.php");
                exit;
            }
            else{
                echo "Error inserting data";
            }

        }

  else{
            echo "Please enter a correct student id number";
        }


}

else{
    echo "Please try again";
}
?>