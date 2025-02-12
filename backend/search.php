<?php
session_start();
include 'connection.php';
include '../backend/function.php'; 
include '../includes/no_result.php';

if (isset($_POST['searchQuery'])) {
    $search = $_POST['searchQuery'];

    $_SESSION['search_active'] = !empty($search);
    $_SESSION['search_query'] = $search;

    // fetchStudents() instead of writing SQL query again
    $result = fetchStudents($search);

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
