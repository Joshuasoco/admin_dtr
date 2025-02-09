<?php
include 'connection.php';
include '../includes/no_result.php';

if(isset($_POST['searchQuery'])) {
    $search = mysqli_real_escape_string($conn, $_POST['searchQuery']);
    
    $sql = "SELECT id, name, hk_type, course_code, hk_duty_status, rendered_hours 
            FROM students 
            WHERE id LIKE '%$search%' 
            OR name LIKE '%$search%' 
            OR hk_type LIKE '%$search%' 
            OR course_code LIKE '%$search%' 
            OR hk_duty_status LIKE '%$search%'";
            
    $result = $conn->query($sql);
    
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>";
            echo "<input type='checkbox' class='student-checkbox' 
                style='display: none; margin-right: 10px;' data-id='" 
                . $row['id'] . "'>";
            echo "<span>" . $row['id'] . "</span>";
            echo "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['hk_type'] . "</td>";
            echo "<td>" . $row['course_code'] . "</td>";
            echo "<td>" . $row['hk_duty_status'] . "</td>";
            echo "<td>";
            echo "<span class='rendered-hours'>" . $row['rendered_hours'] . "</span>";
            echo "<button class='hours-button' data-id='" . $row['id'] . "'>";
            echo "<img src='/ADMIN_DTR/images/pen.svg' alt='edit' class='hours-icon'>";
            echo "</button>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo generateNoResultsHtml($search);
    }
}
?>
