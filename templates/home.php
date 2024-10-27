<?php
session_start(); 

require_once('../config/db.php'); 


if (!isset($_SESSION['teacher_id'])) {
    header("Location: login_view.php"); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;700&display=swap" rel="stylesheet">

                
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="../assets/js/script.js"></script>
    <script>
        function toggleDropdown(id) {
    const dropdown = document.getElementById(`dropdown-${id}`);
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}

// Close dropdown 
window.onclick = function(event) {
    if (!event.target.matches('.dropdown-btn')) {
        const dropdowns = document.getElementsByClassName("dropdown-content");
        for (let i = 0; i < dropdowns.length; i++) {
            const openDropdown = dropdowns[i];
            if (openDropdown.style.display === 'block') {
                openDropdown.style.display = 'none';
            }
        }
    }
};
        </script>
</head>
<body class="home">
    <header>
    <div class="welcome-text">
        <h1>Welcome to the Teacher Portal</h1>
    </div>
    <div class="new-section">
        <button onclick="showAddStudentModal()">Add New </button>
        <form action="../controllers/logout.php" method="post" class="none" style="display:inline;">
            <button type="submit">Logout</button>
        </form>
    </div>
</header>
<!-- <p>Your ID: <?php echo htmlspecialchars($_SESSION['teacher_id']); ?></p> -->
<?php
// Display success message 
if (isset($_SESSION['success_message'])) {
    echo "<p style='color: green;'>" . $_SESSION['success_message'] . "</p>";
    unset($_SESSION['success_message']); // Clear the message after displaying
}

// Display error message 
if (isset($_SESSION['error_message'])) {
    echo "<p style='color: red;'>" . $_SESSION['error_message'] . "</p>";
    unset($_SESSION['error_message']); // Clear the message after displaying
}
?>  
<h1>Student List</h1>
<div class="container">
<table>
    <tr>
        <th>Name</th>
        <th>Subject</th>
        <th>Marks</th>
        <th>Actions</th>
    </tr>
    <?php
    // Fetch the students from the database
    $result = $conn->query("SELECT * FROM students");
    
    while ($student = $result->fetch_assoc()) {
        $firstLetter = strtoupper($student['name'][0]); 

        echo "<tr>";
        echo "<td>            <span class='first-letter-box'>{$firstLetter}</span>
{$student['name']}</td>";
        echo "<td>{$student['subject']}</td>";
        echo "<td>{$student['marks']}</td>";
        echo "<td>
 <div class='dropdown'>
                <button onclick='toggleDropdown({$student['id']})' class='dropdown-btn'>▼</button>
                <div id='dropdown-{$student['id']}' class='dropdown-content'>
                    <button onclick='showEditStudentModal({$student['id']}, \"{$student['name']}\", \"{$student['subject']}\", {$student['marks']})'>Edit</button>
                    <form action='../controllers/student.php' method='post' style='display:inline;'>
                        <input type='hidden' name='student_id' value='{$student['id']}'>
                        <button type='submit' name='delete'>Delete</button>
                    </form>
                </div>

        </td>";
        echo "</tr>";
    }
    
    
    ?>
</table>
</div>
<!-- <button onclick="showAddStudentModal()" class="button_home">Add New Student</button> -->

<!-- Add New -->
<div id="addStudentModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeAddStudentModal()">&times;</span>
        <h2>Add New Student</h2>
        <form id="addStudentForm" action="../controllers/student.php" method="POST">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="teacher_id" value="<?php echo $_SESSION['teacher_id']; ?>"> <!-- Hidden teacher_id -->

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>
            <label for="marks">Marks:</label>
            <input type="number" id="marks" name="marks" required>
            <button type="submit">Add</button>
        </form>
    </div>
</div>

<!-- Edit -->
<div id="editStudentModal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closeEditStudentModal()">&times;</span>
        <h2>Edit Student</h2>
        <form id="editStudentForm" action="../controllers/student.php" method="POST">
            <input type="hidden" name="student_id" id="edit_student_id">
            <label for="edit_name">Name:</label>
            <input type="text" name="name" id="edit_name" required>

            <label for="edit_subject">Subject:</label>
            <input type="text" name="subject" id="edit_subject" required>

            <label for="edit_marks">Marks:</label>
            <input type="number" name="marks" id="edit_marks" required>

            <button type="submit" name="action" value="edit">Update</button>
        </form>
    </div>
</div>

</body>
</html>
