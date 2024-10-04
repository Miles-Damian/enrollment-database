<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $date_of_enrollment = $_POST['date_of_enrollment'];

    
    $sql = "INSERT INTO enrollment (student_id, subject_id, date_of_enrollment) VALUES ('$student_id', '$subject_id', '$date_of_enrollment')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Enrollment added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
    header("Location: index.php");
}
?>
