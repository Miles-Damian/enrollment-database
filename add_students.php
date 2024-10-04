<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['date_of_birth'];
    $section = $_POST['section'];

    $sql = "INSERT INTO students (first_name, last_name, date_of_birth, section) VALUES ('$first_name', '$last_name', '$dob', '$section')";
    if ($conn->query($sql)) {
        echo "Student added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
    header("Location: index.php");
}
?>