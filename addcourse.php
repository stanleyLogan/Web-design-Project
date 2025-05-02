<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// get database connection details
require_once 'db.config.php';

// retrieve values from query string
$semester = $_GET['semester'] ?? 'N/A';
$year = $_GET['year'] ?? 'N/A';
$course_prefix = $_GET['coursePrefix'] ?? 'N/A';
$course_number = $_GET['courseNumber'] ?? 'N/A';
$course_section = $_GET['courseSection'] ?? 'N/A';
$course_name = $_GET['courseName'] ?? 'N/A';
$room = $_GET['room'] ?? 'N/A';
$days = $_GET['days'] ?? 'N/A';

$time = '';
switch ($days) {
    case "Monday, Wednesday,Friday":
        $time = $_GET['time-mwf'] ?? 'N/A';
        break;
    case "Monday,Wednesday":
        $time = $_GET['time-mw'] ?? 'N/A';
        break;
    case "Tuesday, Thursday":
        $time = $_GET['time-tth'] ?? 'N/A';
        break;
    case "Single Day":
        $time = $_GET['time-single'] ?? 'N/A';
        break;
    default:
        $time = 'N/A';
        break;
}

$hours = $_GET['credits'] ?? 'N/A';
$instructor_first = $_GET['instructorFirstName'] ?? 'N/A';
$instructor_last = $_GET['instructorLastName'] ?? 'N/A';
$enrollment_cap = $_GET['enrollmentCap'] ?? 'N/A';
?>

<h1>Course Added</h1>

<?php
try {
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // lookup instructor_id
    $query = "SELECT instructor_id FROM instructors WHERE instructor_first = :first AND instructor_last = :last LIMIT 1";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':first', $instructor_first);
    $stmt->bindValue(':last', $instructor_last);
    $stmt->execute();
    $instructor = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$instructor) {
        echo "<p>Error: Instructor not found in the database.</p>";
        exit;
    }

    $instructor_id = $instructor['instructor_id'];

    // insert course
    $sql = "INSERT INTO courses (semester, year, course_prefix, course_number, course_section, course_name, room, days_offered, time, hours, instructor_id, enrollment_cap)
            VALUES (:semester, :year, :course_prefix, :course_number, :course_section, :course_name, :room, :days_offered, :time, :hours, :instructor_id, :enrollment_cap)";

    $statement = $pdo->prepare($sql);
    $statement->bindValue(':semester', $semester);
    $statement->bindValue(':year', $year);
    $statement->bindValue(':course_prefix', $course_prefix);
    $statement->bindValue(':course_number', $course_number);
    $statement->bindValue(':course_section', $course_section);
    $statement->bindValue(':course_name', $course_name);
    $statement->bindValue(':room', $room);
    $statement->bindValue(':days_offered', $days);
    $statement->bindValue(':time', $time);
    $statement->bindValue(':hours', $hours);
    $statement->bindValue(':instructor_id', $instructor_id);
    $statement->bindValue(':enrollment_cap', $enrollment_cap);
    $statement->execute();

    echo "<p>Semester: $semester $year</p>";
    echo "<p>Course: $course_prefix $course_number-$course_section - $course_name</p>";
    echo "<p>Room: $room</p>";
    echo "<p>Days/Time: $days at $time</p>";
    echo "<p>Credits: $hours</p>";
    echo "<p>Instructor: $instructor_first $instructor_last</p>";
    echo "<p>Enrollment Cap: $enrollment_cap</p>";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
} finally {
    $pdo = null;
}
?>