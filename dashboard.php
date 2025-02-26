<?php
session_start();
include 'backend/connection.php';  
include 'backend/fetch_students.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hk Duty Tracker</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="/ADMIN_DTR/images/icontitle.png" />
    <link rel="stylesheet" type="text/css" href="/ADMIN_DTR/design/dashboard.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Anek+Devanagari:wght@100..800&family=Jost:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Bebas+Neue&family=Poppins:ital,wght@0,100..900;1,100..900&family=Quicksand:wght@300..700&family=Varela+Round&display=swap" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">
        <h1 class="title-dashboard">Dashboard</h1>
        <h2 class="subtitle-db">Current Student Overview</h2>
        
        <div class="content">
            <div class="chart-student-container">
                <div class="chart-section">
                    <span class="title-bar">Hours Student Graph</span>
                    <div class="chart-container">
                        <canvas id="bar_hours"></canvas>
                    </div>
                </div>
                
                <div class="chart-section">
                    <span class="title-bar">Total List</span>
                    <div class="student-handler">
                        <img src="images/groupstudent.png" alt="groupofstudent">
                        <p>Current Student</p>
                        <p><?php echo $result->num_rows; ?></p>
                    </div>
                </div>
                
                <div class="chart-section">
                    <span class="title-bar">Pending Approvals</span>
                    <div class="approval-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Time in</th>
                                    <th>Time out</th>
                                    <th>Date</th>
                                    <th>Approval</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td data-label="ID">1</td>
                                    <td data-label="Name">John Doe</td>
                                    <td data-label="Time in">10:00 am</td>
                                    <td data-label="Time out">12:00 pm</td>
                                    <td data-label="Date">10-2-2024</td>
                                    <td data-label="Approval" class="approval-pending">Pending</td>
                                </tr>
                                <tr>
                                    <td data-label="ID">2</td>
                                    <td data-label="Name">Jane Smith</td>
                                    <td data-label="Time in">10:00 am</td>
                                    <td data-label="Time out">12:00 pm</td>
                                <td data-label="Date">10-3-2024</td>
                                    <td data-label="Approval" class="approval-pending">Pending</td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    
    <script src="/ADMIN_DTR/script/dashboard.js"></script>
</body>
</html>
