<?php
$student_id =$_POST["id"];
$firstName =$_POST["first_name"];
$lastName =$_POST["last_name"];
$con = mysqli_connect("localhost", "root", "", "ajax_db") or die("Connection Failed");

$query = "UPDATE students SET first_name = '{$firstName}', last_name='{$lastName}' WHERE id = {$student_id} ";

if(mysqli_query($con, $query)){
    echo 1;
}else{
    echo 0;
}
?>