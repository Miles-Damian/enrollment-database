<?php
include("connection.php");

$student_id = $_GET['student_id'];

$sql = "DELETE FROM students WHERE student_id=$student_id";
if ($conn->query($sql)) {
    echo "Student deleted successfully!";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
header("Location: index.php");
?>
