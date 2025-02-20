<?php
include 'connection.php';

$query = "SELECT id, name, hk_type, course_code, hk_duty_status, rendered_hours FROM students";
$result = mysqli_query($conn, $query);
?>