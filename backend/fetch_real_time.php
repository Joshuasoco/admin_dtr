<?php
session_start();
include '../backend/connection.php';

// Only check search_active if it exists
if (!isset($_SESSION['search_active']) || $_SESSION['search_active'] !== true) {
    $sql = "SELECT id, name, hk_type, course_code, hk_duty_status, rendered_hours FROM students";
    $result = $conn->query($sql);

    $output = '';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output .= "<tr>";
            $output .= "<td><input type='checkbox' class='student-checkbox' data-id='" . $row['id'] . "'>";
            $output .= "<span>" . $row['id'] . "</span></td>";
            $output .= "<td>" . $row['name'] . "</td>";
            $output .= "<td>" . $row['hk_type'] . "</td>";
            $output .= "<td>" . $row['course_code'] . "</td>";
            $output .= "<td>" . $row['hk_duty_status'] . "</td>";
            $output .= "<td style='display: flex; align-items: center; gap: 8px; position: relative;'>";
            $output .= "<span class='rendered-hours'>" . $row['rendered_hours'] . "</span>";
            $output .= "<button class='hours-button' data-id='" . $row['id'] . "'>";
            $output .= "<img src='/ADMIN_DTR/images/pen.svg' alt='edit' class='hours-icon'>";
            $output .= "</button></td>";
            $output .= "</tr>";
        }
    } else {
        include '../includes/no_result.php';
        $output .= generateNoResultsHtml("");
    }
    echo $output;
}
?>
