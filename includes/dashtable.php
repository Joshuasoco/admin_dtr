<?php
    $host = 'localhost';
    $root = 'root';
    $password = '';
    $db = 'admin_data';

    $conn = mysqli_connect($host, $root, $password, $db);

    //check connection
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
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
                <th>RENDERED HOURS</th>
            </tr>
        </thead>
        <tbody>
            <?php
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
                    echo "<td>" . $row['rendered_hours'] . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>