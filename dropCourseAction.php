<?php
require_once 'db.config.php';

if (isset($_POST['student_id']) && isset($_POST['course_id'])) {
    $studentID = $_POST['student_id'];
    $courseID = $_POST['course_id'];

    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the SQL statement
        $stmt = $pdo->prepare("DELETE FROM registration WHERE student_id = :studentID AND course_id = :courseID");
        $stmt->bindValue(':studentID', $studentID);
        $stmt->bindValue(':courseID', $courseID);
        $stmt->execute();

        echo "<h1>Course Dropped Successfully</h1>";
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    } finally {
        $pdo = null;
    }
} else {
    echo "<h1>Error: Student ID or Course ID not set.</h1>";
}