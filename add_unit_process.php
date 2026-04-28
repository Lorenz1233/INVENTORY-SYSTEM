<?php 
include 'db.php';
if(isset($_POST['unit_name'])){
    $unit=$_POST['unit_name'];
   
    $un=mysqli_query($conn, "INSERT INTO unit(unit_name) values ('$unit')");
    
    if($un){
        header("location: admin_dashboard.php");
        exit;
    }

    else{
        echo "There was a problem adding the unit.";
    }
}

else{
    echo "ERROR";
}
?>