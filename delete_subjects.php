<?php
include("connection.php");

$subject_id = $_GET['subject_id'];

$sql = "DELETE FROM subjects WHERE subject_id=$subject_id";
if ($conn->query($sql)) {
    echo "Subject deleted successfully!";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
header("Location: index.php");
?>
