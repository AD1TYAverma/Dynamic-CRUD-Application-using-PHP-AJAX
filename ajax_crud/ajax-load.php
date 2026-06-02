<?php
$con=mysqli_connect("localhost", "root", "", "ajax_db") or die("Connection Failed");

$query ="SELECT * FROM students";
$result = mysqli_query($con, $query) or die("Query Failed");
// $output = "";

if(mysqli_num_rows($result)>0){
    $output= '<table border="1" class="table table-bordered" width="100%" cellspacing="0" cellpadding="10px">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th colspan="2">Actions</th>
                </tr>';
    while($row = mysqli_fetch_assoc($result)){
        $output .= "<tr>
        <td>{$row["id"]}</td>
        <td>{$row["first_name"]} {$row["last_name"]}</td>
        <td><button class='delete-btn' data-id='{$row["id"]}'>Delete</button></td>
        <td><button class='edit-btn' data-eid='{$row["id"]}'>Edit</button></td>
        <tr>";
    };
    $output .='</table>';

    echo $output;
    mysqli_close($con);

}
?>
