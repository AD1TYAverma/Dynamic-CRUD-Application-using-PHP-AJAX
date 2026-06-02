<?php
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];

$con=mysqli_connect("localhost", "root", "", "ajax_db") or die("Connection Failed");

$query = "INSERT INTO students(first_name, last_name)VALUES('{$first_name}', '{$last_name}')";
// $result = mysqli_query($con, $query) or die("Query Failed");

if(mysqli_query($con, $query)){
    echo 1;
}else{
    echo 0;
}

?>