<?php
session_start();
include 'connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    if (empty($student_id) || empty($password)) {
        $_SESSION['login_error'] = "All fields are required";
        header("Location: /ADMIN_DTR/includes/login.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM admin WHERE name = ?");  
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            $_SESSION['admin_name'] = $user['name'];
            $_SESSION['admin_role'] = $user['role'];
            $_SESSION['logged_in'] = true; 
            header("Location: /ADMIN_DTR/dashboard.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid password";
        }
    } else {
        $_SESSION['login_error'] = "User not found";
    }

    header("Location: /ADMIN_DTR/includes/login.php");
    exit();
}
?>