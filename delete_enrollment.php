<?php
include("connection.php");

$enrollment_id = $_GET['enrollment_id'];

$sql = "DELETE FROM enrollment WHERE enrollment_id=$enrollment_id";
if ($conn->query($sql)) {
    echo "Enrollment deleted successfully!";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
header("Location: index.php");
?>
