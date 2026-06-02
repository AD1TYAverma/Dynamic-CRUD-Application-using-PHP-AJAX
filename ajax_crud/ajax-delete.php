<?php
$student_id =$_POST["id"];
$con = mysqli_connect("localhost", "root", "", "ajax_db") or die("Connection Failed");

$query = "DELETE FROM students WHERE id ={$student_id}";

if(mysqli_query($con, $query)){
    echo 1;
}else{
    echo 0;
}
?>