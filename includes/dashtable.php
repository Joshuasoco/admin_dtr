<?php
include __DIR__ . '/../backend/connection.php';  

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
unset($_SESSION['search_active']);
unset($_SESSION['search_query']);

    function generateNoResultsHtml() {
        return "<tr><td colspan='6' style='text-align:center;'>No records found</td></tr>";
    }

    $sql = "SELECT id, name, hk_type, course_code, hk_duty_status, rendered_hours FROM students";
    $result = $conn->query($sql);
    
    
?>
<div class="table-container">
    <table class="content-table">
        <thead>
            <tr>              
                <th style="width: 300px">ID</th>
                <th>NAME</th>
                <th style="width: 100px">HK TYPE</th>
                <th>COURSE CODE</th>
                <th>HK DUTY STATUS</th>
                <th>RENDERED STATUS</th>
            </tr>
        </thead>
        <tbody id="tbody">
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                        echo "<td>";
                        echo "<input type='checkbox' class='student-checkbox' data-id='" . $row['id'] . "'>";
                        echo "<span>" . $row['id'] . "</span>";
                        echo "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['hk_type'] . "</td>";
                        echo "<td>" . $row['course_code'] . "</td>";
                        echo "<td>" . $row['hk_duty_status'] . "</td>";
                        echo "<td style='display: flex; align-items: center; gap: 8px; position: relative;'>";
                        echo "<span class='rendered-hours'>" . $row['rendered_hours'] . "</span>";
                        echo "<button class='hours-button' data-id='" . $row['id'] . "'>";
                        
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo generateNoResultsHtml();
            }
            ?>
            
        </tbody>
    </table>
</div>