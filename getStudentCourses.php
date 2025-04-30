<?php
require_once 'db.config.php';

$studentID = $_GET['student_id'] ?? null;
header('Content-Type: application/json');

if(!isset($_GET['student_id'])) {
    echo json_encode([]);
    exit;
}

$student_id = $_GET['student_id'];

try{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT r.registration_id, c.course_prefix, c.course_number, c.course_section, c.semester, c.year
            FROM registration r
            JOIN courses c ON r.course_id = c.course_id
            WHERE r.student_id = :student_id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':student_id', $student_id, PDO::PARAM_INT);
    $stmt->execute();
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($courses);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
} finally {
    
}
?>