<?php
// get database connection details
require_once 'db.config.php';

// retrieve values from query string
$student_first = $_GET['studentFirstName'] ?? 'N/A';
$student_last = $_GET['studentLastName'] ?? 'N/A';
$semester = $_GET['semester'] ?? 'N/A';
$year = $_GET['year'] ?? 'N/A';
$course_prefix = $_GET['coursePrefix'] ?? 'N/A';
$course_number = $_GET['courseNumber'] ?? 'N/A';
$course_section = $_GET['courseSection'] ?? 'N/A';
?>

<h1>Course Registration</h1>

<?php
try {
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // lookup student_id
    $stmt1 = $pdo->prepare("SELECT student_id FROM students WHERE student_first = :first AND student_last = :last LIMIT 1");
    $stmt1->bindValue(':first', $student_first);
    $stmt1->bindValue(':last', $student_last);
    $stmt1->execute();
    $student = $stmt1->fetch(PDO::FETCH_ASSOC);

    if (!$student) {
        echo "<p>Error: Student not found in the database.</p>";
        exit;
    }

    $student_id = $student['student_id'];

    // lookup course_id
    $stmt2 = $pdo->prepare("SELECT course_id FROM courses WHERE course_prefix = :prefix AND course_number = :number AND course_section = :section AND semester = :semester AND year = :year LIMIT 1");
    $stmt2->bindValue(':prefix', $course_prefix);
    $stmt2->bindValue(':number', $course_number);
    $stmt2->bindValue(':section', $course_section);
    $stmt2->bindValue(':semester', $semester);
    $stmt2->bindValue(':year', $year);
    $stmt2->execute();
    $course = $stmt2->fetch(PDO::FETCH_ASSOC);

    if (!$course) {
        echo "<p>Error: Course not found in the database.</p>";
        exit;
    }

    $course_id = $course['course_id'];

    // check for existing registration
    $stmt3 = $pdo->prepare("SELECT * FROM registration WHERE student_id = :student_id AND course_id = :course_id");
    $stmt3->bindValue(':student_id', $student_id);
    $stmt3->bindValue(':course_id', $course_id);
    $stmt3->execute();
    $existing = $stmt3->fetch(PDO::FETCH_ASSOC);

    if ($existing) {
        echo "<p>Error: Student is already registered for this course.</p>";
        exit;
    }

    // insert registration
    $stmt4 = $pdo->prepare("INSERT INTO registration (student_id, course_id) VALUES (:student_id, :course_id)");
    $stmt4->bindValue(':student_id', $student_id);
    $stmt4->bindValue(':course_id', $course_id);
    $stmt4->execute();

    echo "<p>Student: $student_first $student_last</p>";
    echo "<p>Semester: $semester $year</p>";
    echo "<p>Course: $course_prefix $course_number-$course_section</p>";
    echo "<p>Registration Successful!</p>";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
} finally {
    $pdo = null;
}
?>
