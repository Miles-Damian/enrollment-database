<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // When form is submitted
    $subject_id = $_POST['subject_id'];
    $subject_title = $_POST['subject_title'];
    $subject_desc = $_POST['subject_desc'];
    $instructor = $_POST['instructor'];

    // Update query
    $sql = "UPDATE subjects SET subject_title='$subject_title', subject_desc='$subject_desc', instructor='$instructor' WHERE subject_id=$subject_id";
    
    if ($conn->query($sql)) {
        header("Location: index.php");
        echo "Subject updated successfully!";

        // Fetch the updated subject information
        $result = $conn->query("SELECT * FROM subjects WHERE subject_id=$subject_id");
        $subject = $result->fetch_assoc();
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
} else {
    // When the page is accessed via GET to load the form
    if (isset($_GET['subject_id'])) {
        $subject_id = $_GET['subject_id'];
        $result = $conn->query("SELECT * FROM subjects WHERE subject_id=$subject_id");
        $subject = $result->fetch_assoc();
    } else {
        echo "No subject ID provided!";
        exit;
    }
}
?>

<!-- HTML form for updating subject -->
<form method="POST" action="update_subjects.php">
    <input type="hidden" name="subject_id" value="<?php echo $subject['subject_id']; ?>">
    Subject Title: <input type="text" name="subject_title" value="<?php echo isset($subject['subject_title']) ? $subject['subject_title'] : ''; ?>" required><br>
    Description: <input type="text" name="subject_desc" value="<?php echo isset($subject['subject_desc']) ? $subject['subject_desc'] : ''; ?>" required><br>
    Instructor: <input type="text" name="instructor" value="<?php echo isset($subject['instructor']) ? $subject['instructor'] : ''; ?>" required><br>
    <button type="submit">Update Subject</button>
</form>
