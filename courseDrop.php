<?php
require_once 'db.config.php';

if(!isset($_POST['student_id']) || !isset($_POST['course_id'])) {
    die("Missing data.");
}

$registration_id = $_POST['course_id']; //this is the registration ID

try{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $stmt = $pdo->prepare("DELETE FROM registration WHERE registration_id = :id");
    $stmt->bindValue(':id', $registration_id);
    $stmt->execute();

    echo "<h1>Course successfully dropped!</h1>";
    echo "<p><a href='dropcourse.php'>Back to Drop Course</a></p>";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
} finally {
    $pdo = null;
}