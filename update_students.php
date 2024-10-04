<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // When the form is submitted
    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['date_of_birth'];
    $section = $_POST['section'];

    // Update the student information
    $sql = "UPDATE students SET first_name='$first_name', last_name='$last_name', date_of_birth='$dob', section='$section' WHERE student_id=$student_id";
    
    if ($conn->query($sql)) {
        header("Location: index.php");
        echo "Student updated successfully!";

        // Fetch the updated student information
        $result = $conn->query("SELECT * FROM students WHERE student_id=$student_id");
        $student = $result->fetch_assoc();
    } else {
        echo "Error: " . $conn->error;
    }
    
    $conn->close();
} else {
    // When the form is first loaded via GET request
    if (isset($_GET['student_id'])) {
        $student_id = $_GET['student_id'];
        $result = $conn->query("SELECT * FROM students WHERE student_id=$student_id");
        $student = $result->fetch_assoc();
    } else {
        echo "No student ID provided!";
        exit;
    }
}
?>

<!-- HTML form for updating student -->
<form method="POST" action="update_students.php">
    <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
    First Name: <input type="text" name="first_name" value="<?php echo isset($student['first_name']) ? $student['first_name'] : ''; ?>" required><br>
    Last Name: <input type="text" name="last_name" value="<?php echo isset($student['last_name']) ? $student['last_name'] : ''; ?>" required><br>
    Date of Birth: <input type="date" name="date_of_birth" value="<?php echo isset($student['date_of_birth']) ? $student['date_of_birth'] : ''; ?>" required><br>
    Section: <input type="text" name="section" value="<?php echo isset($student['section']) ? $student['section'] : ''; ?>" required><br>
    <button type="submit">Update Student</button>
</form>
