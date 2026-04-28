<?php
include 'db.php';

if(isset($_POST['student_id'])){
  $student_name=$_POST['first_name'];
  $student_last_name= $_POST['last_name'];
  $student_id=$_POST['student_id'];
  $year=$_POST['year'];
  $course=$_POST['course'];
   
  $quer= mysqli_query($conn,
   "INSERT into master_list(first_name, last_name, course_code, year_level, student_id) 
    values ('$student_name', '$student_last_name', '$course', '$year', '$student_id')
  ");

  if($quer){
    echo "successfully added";
  }
  else{
    echo "there's something wrong adding the student";
  }
  }

  if(isset($_POST['employee_id'])){
    $first_name=$_POST['official_first_name'];
     $last_name=$_POST['official_last_name'];
      $employee_id=$_POST['employee_id'];
       $position=$_POST['position'];

       $official_quer= mysqli_query($conn, "INSERT INTO officials_masterlist (first_name, last_name, position_code, official_id) 
       values ('$first_name', '$last_name', '$position', '$employee_id')");

       if($official_quer){
        echo "added successfully";
       }

       else{
        echo "there's something wrong adding the official";
       }
  }
   
       else{
        echo"ERROR";
       }
  ?>
