<?php

$file = 'attendance_data.txt';

if (!file_exists($file)) {
    die('<h1>No attendance data found.</h1>');
}

file_put_contents($file, '');
echo "The file has been cleared.";
header("Location: view_attendance.php");

?>