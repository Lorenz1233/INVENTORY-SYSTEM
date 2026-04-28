<?php
include 'db.php';

$added = 0;
$skipped = 0;

if(isset($_POST['submit'])){

$file = $_FILES['csv_file']['tmp_name'];

if(($handle = fopen($file,"r")) !== FALSE){

fgetcsv($handle);

while(($data = fgetcsv($handle,1000,",")) !== false){

$student_id = $data[0];
$first_name = $data[1];
$last_name = $data[2];
$default_password = $student_id.$last_name;

$check = mysqli_query($conn,"SELECT student_id FROM master_list WHERE student_id='$student_id'");
$CHECKED = mysqli_query($conn,"SELECT student_id FROM users WHERE student_id='$student_id'");

if(mysqli_num_rows($check)==0){

mysqli_query($conn,"INSERT INTO master_list(student_id,first_name,last_name)
VALUES ('$student_id','$first_name','$last_name')");

}

if(mysqli_num_rows($CHECKED)==0){

mysqli_query($conn,"INSERT INTO users(student_id,username,password)
VALUES ('$student_id','$student_id','$default_password')");

$added++;

}

else{

$skipped++;

}

}

fclose($handle);

}

}

echo "IMPORT COMPLETE<br>";
echo "SKIPPED: ".$skipped."<br>";
echo "ADDED: ".$added;
?>