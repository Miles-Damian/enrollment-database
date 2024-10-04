<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enrollment_id = $_POST['enrollment_id'];
    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $date_of_enrollment = $_POST['date_of_enrollment'];

    $sql = "UPDATE enrollment SET student_id=$student_id, subject_id=$subject_id, date_of_enrollment='$date_of_enrollment' WHERE enrollment_id=$enrollment_id";
    if ($conn->query($sql)) {
        header("Location: index.php");
        echo "Enrollment updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
} else {
    $enrollment_id = $_GET['enrollment_id'];
    $result = $conn->query("SELECT * FROM enrollment WHERE enrollment_id=$enrollment_id");
    $enrollment = $result->fetch_assoc();
}
?>

<!-- HTML form for updating enrollment -->
<form method="POST" action="update_enrollment.php">
    <input type="hidden" name="enrollment_id" value="<?php echo $enrollment['enrollment_id']; ?>">
    
    <!-- Students Dropdown -->
    Student:
    <select name="student_id" required>
        <?php
        $result = $conn->query("SELECT * FROM students");
        while ($row = $result->fetch_assoc()) {
            $selected = ($row['student_id'] == $enrollment['student_id']) ? 'selected' : '';
            echo "<option value='{$row['student_id']}' $selected>{$row['first_name']} {$row['last_name']}</option>";
        }
        ?>
    </select><br>

    <!-- Subjects Dropdown -->
    Subject:
    <select name="subject_id" required>
        <?php
        $result = $conn->query("SELECT * FROM subjects");
        while ($row = $result->fetch_assoc()) {
            $selected = ($row['subject_id'] == $enrollment['subject_id']) ? 'selected' : '';
            echo "<option value='{$row['subject_id']}' $selected>{$row['subject_title']}</option>";
        }
        ?>
    </select><br>

    Date of Enrollment: <input type="date" name="date_of_enrollment" value="<?php echo $enrollment['date_of_enrollment']; ?>" required><br>
    <button type="submit">Update Enrollment</button>
</form>
