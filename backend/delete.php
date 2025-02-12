<?php
session_start();
include 'connection.php';
include '../backend/reset.php';

if (isset($_POST['ids'])) {
    $ids = json_decode($_POST['ids'], true);

    if (!empty($ids)) {
        $id_placeholders = implode(",", array_fill(0, count($ids), "?"));
        $sql = "DELETE FROM students WHERE id IN ($id_placeholders)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(str_repeat("i", count($ids)), ...$ids);

        if ($stmt->execute()) {
            include 'reset.php'; //  reset.php instead of repeating session unset
            echo "success";
        } else {
            echo "error deletion";
        }
        $stmt->close();
    } else {
        echo "no id";
    }
} else {
    echo "invalid_request";
}

$conn->close();
?>
