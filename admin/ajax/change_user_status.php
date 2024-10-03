<?php
session_start();
include_once '../../connectdb.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'changeUserStatus') {
    $userId = intval($_POST['id']);
    $newStatus = $_POST['status'];

    $sql = "UPDATE staff_users SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newStatus, $userId);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    $stmt->close();
    exit;
}
?>
