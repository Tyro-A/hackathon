<?php
session_start();
if ($_SESSION['is_admin']) {
    header("Location: admin-dashboard.php"); 
} else {
    header("Location: user-dashboard.php"); 
}
exit; 
?>
