<?php
// download.php

// Allow access only if the user is logged in
session_start();
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

// File to download
$file_path = 'company_confidential.txt';

// Send headers for file download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
header('Content-Length: ' . filesize($file_path));
readfile($file_path);
?>

