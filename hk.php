<?php

$student_id = $_GET['id'] ?? null;
if ($student_id) {
    // Fetch student data using $student_id
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hk Duty Tracker</title>
    <link rel="icon" href="/ADMIN_DTR/images/icontitle.png" />
    <link rel="stylesheet" type= "text/css" href = "/ADMIN_DTR/design/hk_style.css">
</head>
<body>
<div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
    <div class="main">
        <h1 class="title_hk">Hk student</h1>
        <h2 class="subtitle_hk">Student status</h2>

        <div class="student_id_wrapper">
            
            <!-- Student ID -->
            <div class="student_id_container">
                <div class="student-id-content">
                    <div class="student-img-wrapper">         
                        <img loading="lazy"
                            src="/ADMIN_DTR/images/id.svg"
                            alt="Student ID icon"/>
                    </div>
                    <div class="student-id-info">
                        <div class="student-id-label">Student ID</div>
                        <div class="student-id-number">03-2324-12345</div>
                    </div>
                </div>
            </div>

            <!-- Student Name -->
            <div class="student_id_container">
                <div class="student-id-content">
                    <div class="student-img-wrapper">
                        <img loading="lazy"
                            src="/ADMIN_DTR/images/details.svg"
                            class="student-id-icon"
                            alt="Student ID icon"/>
                    </div>
                    <div class="student-id-info">
                        <div class="student-id-label">Student Name</div>
                        <div class="student-id-number">Josh Co Po</div>
                    </div>
                </div>
            </div>

            <!-- Schedule -->
            <div class="student_id_container">
                <div class="student-id-content">
                    <div class="student-img-wrapper">
                        <img loading="lazy"
                            src="/ADMIN_DTR/images/date.svg"
                            class="student-id-icon"
                            alt="Student ID icon"/>
                    </div>
                    <div class="student-id-info">
                        <div class="student-id-label">Schedule</div>
                        <div class="student-id-number">Monday & Tuesday</div>
                    </div>
                </div>
            </div>

            <!-- Course -->
            <div class="student_id_container">
                <div class="student-id-content">
                    <div class="student-img-wrapper">
                        <img loading="lazy"
                            src="/ADMIN_DTR/images/cap.svg"
                            class="student-id-icon"
                            alt="Student ID icon"/>
                    </div>
                    <div class="student-id-info">
                        <div class="student-id-label">Course</div>
                        <div class="student-id-number">BSIT</div>
                    </div>
                </div>
            </div>
            <?php include 'includes/hourstable.php';?>
        </div>
    </div>
</div>
    <div class="form-modal" id="form_popup">
        <div class="form-content">
            <h3>Time Logs</h3>
            <form id="timeForm">
                <label for="editdate">Date</label>
                <input type="date" id="edit_date" name="editdate" required>
                
                <label for="edittimein">Time in</label>
                <input type="time" id="edit_timein" name="timein" required>
                
                <label for="edittimeout">Time out</label>
                <input type="time" id="edit_timeout" name="timeout" required>
                
                <label for="remarks">Remarks</label>
                <input type="text" id="remarks" name="remarks" required>
                
                <div class="buttons">
                    <button type="button" onclick="closeModal()">Cancel</button>
                    <button type="submit">Approve</button>
                </div>
            </form>
        </div>
    </div>
    <script src = "/ADMIN_DTR/script/hk_function.js"></script>
          
</body>
</html>