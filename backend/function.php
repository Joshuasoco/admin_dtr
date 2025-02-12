<?php
include 'connection.php'; 

function fetchStudents($searchQuery = ''){
    global $conn;

    
    $sql = "SELECT id, name, hk_type, course_code, hk_duty_status, rendered_hours FROM students";
   
    if (!empty($searchQuery)) {
        $searchQuery = mysqli_real_escape_string($conn, $searchQuery);
        $sql .= " WHERE id LIKE '%$searchQuery%' 
                  OR name LIKE '%$searchQuery%' 
                  OR hk_type LIKE '%$searchQuery%' 
                  OR course_code LIKE '%$searchQuery%' 
                  OR hk_duty_status LIKE '%$searchQuery%'";
    }
    //echo $sql;
    return $conn->query($sql); 
}
?>
 