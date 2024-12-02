<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_id = $_POST['project_id'];
    $action = $_POST['action'];

    // Determine the new approval status
    $approval_status = ($action === 'approve') ? 1 : 0;

    // Update the project's approval status
    $query = "UPDATE projects SET approval = ? WHERE project_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $approval_status, $project_id);

    if ($stmt->execute()) {
        $message = $action === 'approve' ? "Project approved successfully! $approval_status" : "Project declined successfully! $approval_status";
    } else {
        $message = "Error updating project approval status: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect back to admin dashboard with a success/error message
    header("Location: admin-dashboard.php?message=" . urlencode($message));
    exit();
}
?>
