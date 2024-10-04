<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject_title = $_POST['subject_title'];
    $subject_desc = $_POST['subject_desc'];
    $instructor = $_POST['instructor'];

    $sql = "INSERT INTO subjects (subject_title, subject_desc, instructor) VALUES ('$subject_title', '$subject_desc', '$instructor')";
    if ($conn->query($sql)) {
        echo "Subject added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
    header("Location: index.php");
}
?>
