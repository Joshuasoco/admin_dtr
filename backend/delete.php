<?php
session_start();
include 'connection.php';

if (isset($_POST['ids'])) {
    $ids = json_decode($_POST['ids'], true);
    
    if (!empty($ids)) {
        $id_placeholders = implode(",", array_fill(0, count($ids), "?"));
        $sql = "DELETE FROM students WHERE id IN ($id_placeholders)";
        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param(str_repeat("i", count($ids)), ...$ids);
        
        if ($stmt->execute()) {
            // Reset search state after successful deletion
            unset($_SESSION['search_active']);
            unset($_SESSION['search_query']);
            echo "success";
        } else {
            echo "error";
        }

        $stmt->close();
    } else {
        echo "no_ids";
    }
} else {
    echo "invalid_request";
}
$conn->close();
?>