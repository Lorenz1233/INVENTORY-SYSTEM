<?php
include 'db.php';

if(isset($_POST['course_code'])){
    $course_code=$_POST['course_code'];
    $course_name=$_POST['course_name'];
    
    mysqli_query($conn,"INSERT INTO course (course_code,course_name) values ('$course_code','$course_name')");

}
else{
    echo "error submitting form";
}
?>