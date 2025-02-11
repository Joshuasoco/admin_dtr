<?php
session_start();
include 'connection.php';
include '../includes/no_result.php';

if (isset($_POST['searchQuery'])) {
    $search = mysqli_real_escape_string($conn, $_POST['searchQuery']);
    
    if (empty($search)) {
        // If search is empty, reset search state
        unset($_SESSION['search_active']);
        unset($_SESSION['search_query']);
    } else {
        $_SESSION['search_active'] = true;
        $_SESSION['search_query'] = $search;
    }

    $sql = "SELECT id, name, hk_type, course_code, hk_duty_status, rendered_hours 
            FROM students 
            WHERE id LIKE '%$search%' 
            OR name LIKE '%$search%' 
            OR hk_type LIKE '%$search%' 
            OR course_code LIKE '%$search%' 
            OR hk_duty_status LIKE '%$search%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><input type='checkbox' class='student-checkbox' data-id='" . $row['id'] . "'>";
            echo "<span>" . $row['id'] . "</span></td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['hk_type'] . "</td>";
            echo "<td>" . $row['course_code'] . "</td>";
            echo "<td>" . $row['hk_duty_status'] . "</td>";
            echo "<td>";
            echo "<span class='rendered-hours'>" . $row['rendered_hours'] . "</span>";
            echo "<button class='hours-button' data-id='" . $row['id'] . "'>";
            echo "<img src='/ADMIN_DTR/images/pen.svg' alt='edit' class='hours-icon'>";
            echo "</button></td>";
            echo "</tr>";
        }
    } else {
        echo generateNoResultsHtml($search);
    }
}
?>