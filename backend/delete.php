<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ids'])) {
    $ids = json_decode($_POST['ids']);
    
    if ($ids && is_array($ids)) {
        try {

            $conn->begin_transaction();
            

            $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
            
            $success = true;
            foreach ($ids as $id) {
                $stmt->bind_param("i", $id);
                if (!$stmt->execute()) {
                    $success = false;
                    break;
                }
            }
            
            if ($success) {
                $conn->commit();
                echo "success";
            } else {
                $conn->rollback();
                echo "error: " . $conn->error;
            }
            
        } catch (Exception $e){
            $conn->rollback();
            echo "error: " . $e->getMessage();
        }
        
        $stmt->close();
    } else {
        echo "error: Invalid ID format";
    }
} else {
    echo "error: No IDs received";
}

$conn->close();
?>