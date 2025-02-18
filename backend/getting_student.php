<?php
header('Content-Type: application/json');
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $stmt = $conn->prepare("SELECT id, name, course_code, hk_duty_status, schedule_days FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        echo json_encode(['success' => true, 'student' => $student]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Student not found']);
    }
    
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'No ID provided']);
}

$conn->close();
?>