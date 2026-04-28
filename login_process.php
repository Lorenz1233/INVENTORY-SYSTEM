    <?php
    //checks if the user is admin or user and checks the account if the password has been change.
    session_start();
    include 'db.php';

    if(isset($_POST['password'])){

    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql= "SELECT * FROM users WHERE username='$username' and password='$password'";
    $result = mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($result);
    
    if(!$result){
    die("Query failed: " . mysqli_error($conn));
}

    else if(mysqli_num_rows($result)==1){

         if($row['is_default_password']==1){
        header("location:change_pass.php");
    }

    else{
        if($row['role']=='admin'){
            header("location: admin_dashboard.php");
            exit();
        }

        else{
            header("location: user_dashboard.php");
            exit();
    }

    }

    }
    }

    else{
        echo"error";
    }

    ?>