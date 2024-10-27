<?php
session_start();
require_once('../config/db.php');


if (!isset($_SESSION['teacher_id'])) {
    header("Location: ../templates/login_view.php");
    exit();
}

// Add a new student or update an existing student
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $marks = $_POST['marks'];
    $teacher_id = $_POST['teacher_id']; // Get the teacher_id from the form

    if ($action === "add") {
        // Check if the student already exists with the same name and subject, regardless of teacher
        $stmt = $conn->prepare("SELECT * FROM students WHERE name = ? AND subject = ?");
        $stmt->bind_param("ss", $name, $subject);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Check if a student with the same name and subject already exists
        if ($result->num_rows > 0) {
            // If the student exists, set an error message
            $_SESSION['error_message'] = "A student with the same name and subject already exists!";
        } else {
            // If the student does not exist, proceed to insert the new student
            $insert_stmt = $conn->prepare("INSERT INTO students (name, subject, marks, teacher_id) VALUES (?, ?, ?, ?)");
            $insert_stmt->bind_param("ssii", $name, $subject, $marks, $teacher_id);
            $insert_stmt->execute();
    
            // Check if the insert was successful
            if ($insert_stmt->affected_rows > 0) {
                $_SESSION['success_message'] = "Student record successfully added!";
            } else {
                $_SESSION['error_message'] = "Failed to add student record.";
            }
        }
    }
    
        elseif ($action === "edit") {
    
        $student_id = $_POST['student_id']; // Get the student_id from the form

        $update_stmt = $conn->prepare("UPDATE students SET name = ?, subject = ?, marks = ? WHERE id = ?");
        $update_stmt->bind_param("ssii", $name, $subject, $marks, $student_id);
        $update_stmt->execute();
        $_SESSION['success_message'] = "Student record successfully updated!";
    }

    header("Location: ../templates/home.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $student_id = $_POST['student_id'];
    $delete_stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $delete_stmt->bind_param("i", $student_id);
    $delete_stmt->execute();
    header("Location: ../templates/home.php");
    exit();
}
?>
