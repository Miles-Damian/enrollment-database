<!DOCTYPE html>
<html>
<head>
    <title>Student, Subject, and Enrollment Management</title>
    <?php
        include("connection.php");
    ?>
</head>
<body>
<h2>Add Students:</h2>
<form method="POST" action="add_students.php">
    <input type="hidden" name="action" value="add_student">
    <ul style="list-style-type: none;">
    <li>First Name: &nbsp; <input type="text" name="first_name" required><br></li><br>
    <li>Last Name: &nbsp;<input type="text" name="last_name" required></li><br>
    <li>Date of Birth: &nbsp;<input type="date" name="date_of_birth" required></li><br>
    <li>Section: &nbsp;<input type="text" name="section" required></li><br>
    <li><button type="submit">Add Student</button></li>
    </ul>
</form>

<h2>Students:</h2>
<?php
$result = $conn->query("SELECT * FROM students");
echo "<table border=1px>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Date of Birth</th>
    <th>Section</th>
    <th>Action</th>
</tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['student_id']}</td>
            <td>{$row['first_name']} {$row['last_name']}</td>
            <td>{$row['date_of_birth']}</td>
            <td>{$row['section']}</td>
            <td>
                <a href='update_students.php?student_id={$row['student_id']}'>Update</a> | 
                <a href='delete_students.php?student_id={$row['student_id']}'>Delete</a>
            </td>
          </tr>";
}
echo "</table>";
?>


<h2>Add Subject:</h2>
<form method="POST" action="add_subjects.php">
    <ul style="list-style-type:none;">
    <input type="hidden" name="action" value="add_subject">
    <li> Subject Title: <input type="text" name="subject_title" required></li><br>
    <li>Description: <input name="subject_desc" required></input></li><br>
    <li>Instructor: <input type="text" name="instructor" required></li><br>
    <li><button type="submit">Add Subject</button></li>
    </ul>
</form>

<h2>Subjects:</h2>
<?php
$result = $conn->query("SELECT * FROM subjects");
echo "<table border='1'><tr><th>ID</th><th>Title</th><th>Description</th><th>Instructor</th><th>Action</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['subject_id']}</td>
            <td>{$row['subject_title']}</td>
            <td>{$row['subject_desc']}</td>
            <td>{$row['instructor']}</td>
            <td>
                <a href='update_subjects.php?subject_id={$row['subject_id']}'>Update</a> | 
                <a href='delete_subjects.php?subject_id={$row['subject_id']}'>Delete</a>
            </td>
          </tr>";
}
echo "</table>";
?>


<!-- Enrollment Select -->
<h2>Enroll Students in Subjects:</h2>
<form method="POST" action="add_enrollment.php">
    <input type="hidden" name="action" value="enroll_student">
    
    <ul style="list-style-type:none;">

    <li><label for="student_id">Students:</label>
    <select name="student_id" required>
        <?php
        $result = $conn->query("SELECT * FROM students");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['student_id']}'>{$row['first_name']} {$row['last_name']}</option>";
        }
        ?>
    </select></li><br>

    <li><label for="subject_id">Subject:</label>
    <select name="subject_id" required>
        <?php
        $result = $conn->query("SELECT * FROM subjects");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['subject_id']}'>{$row['subject_title']}</option>";
        }
        ?>
    </select></li><br>

    <li><label for="date_of_enrollment">Date of Enrollment:</label>
    <input type="date" name="date_of_enrollment" required></li><br>

    <li><button type="submit">Enroll Student</button></li>
    </ul> 
</form>

<!-- Enrollment Table -->
<h2>Enrollments</h2>
<?php
$result = $conn->query("
    SELECT e.enrollment_id, s.first_name, s.last_name, sub.subject_title, e.date_of_enrollment 
    FROM enrollment e
    JOIN students s ON e.student_id = s.student_id
    JOIN subjects sub ON e.subject_id = sub.subject_id
");

echo "<table border='1'>
<tr><th>Enrollment ID</th>
<th>Student</th>
<th>Subject</th>
<th>Date of Enrollment</th>
<th>Action</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['enrollment_id']}</td>
            <td>{$row['first_name']} {$row['last_name']}</td>
            <td>{$row['subject_title']}</td>
            <td>{$row['date_of_enrollment']}</td>
            <td>
                <a href='update_enrollment.php?enrollment_id={$row['enrollment_id']}'>Update</a> | 
                <a href='delete_enrollment.php?enrollment_id={$row['enrollment_id']}'>Delete</a>
            </td>
          </tr>";
}
echo "</table>";
?>

</body>
</html>
