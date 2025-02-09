<?php
include 'backend/connection.php'; 

$query = "SELECT * FROM students";
$result = mysqli_query($conn, $query);
?>