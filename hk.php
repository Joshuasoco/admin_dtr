<?php
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']){
    header("Location: /ADMIN_DTR/includes/login.php");
    exit(); 
}

include 'backend/connection.php';

$student_id = $_GET['id'] ?? null;
if ($student_id) {
    
    $stmt = $conn->prepare("
    SELECT *, 
    schedule_days AS schedule 
    FROM students 
    WHERE id = ?
    ");
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1){
        $student_data = $result->fetch_assoc(); 
    } else{
        header("Location: /ADMIN_DTR/dashboard.php");
        exit;
    }
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
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Anek+Devanagari:wght@100..800&family=Jost:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Bebas+Neue&family=Poppins:ital,wght@0,100..900;1,100..900&family=Quicksand:wght@300..700&family=Varela+Round&display=swap" rel="stylesheet">

</head>
<body>
<div class="wrapper">
    <?php include 'includes/sidebar.php'; ?>
    <div class="main">
        <h1 class="title_hk">Hk student</h1>
        <h2 class="subtitle_hk">Student status</h2>

        <div class="student_id_wrapper">
        <?php if(isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php elseif(isset($student_data)): ?>
        <!-- student ID container -->
            <div class="student_id_container">
                <div class="student-id-content">
                    <div class="student-img-wrapper">         
                        <img loading="lazy"
                            src="/ADMIN_DTR/images/id.svg"
                            alt="Student ID icon"/>
                    </div>
                    <div class="student-id-info">
                        <div class="student-id-label">Student ID</div>
                            <div class="student-id-number">
                                <?php echo htmlspecialchars($student_data['id'])?>
                            </div>
                    </div>
                </div>
            </div>
        <!-- student name container -->

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
                        <div class="student-name">
                            <?php echo htmlspecialchars($student_data['name'])?>
                        </div>
                    </div>
                </div>
            </div>
        <!-- student sched container -->

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
                            <div class="student-schedule">
                                <?php echo htmlspecialchars($student_data['schedule'])?>
                            </div>
                    </div>
                </div>
            </div>
        <!-- student course container -->

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
                            <div class="student-course">
                            <?php echo htmlspecialchars($student_data['course_code'])?>                            </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
                <div class="select-container">
                    <img src="/ADMIN_DTR/images/hk_nofound.jpg" alt="Selected student">
                    <div class="notice">Select a student..</div>
                    <p>No student selected yet.</p>
                    <button type="button" onclick="window.location.href
                    ='student_list.php'">
                        Go to student list
                    </button>
                </div>
            <?php endif;?>
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