<?php
// get database connection details
require_once 'db.config.php';

// retrieve instructor from query string
$instructor_first = 'N/A';
if (isset($_GET['instructorFirstName'])) {
    $instructor_first = $_GET['instructorFirstName'];
}

$instructor_last = 'N/A';
if (isset($_GET['instructorLastName'])) {
    $instructor_last = $_GET['instructorLastName'];
}

$instructor_dept = 'N/A';
if (isset($_GET['instructorDept'])) {
    $instructor_dept = $_GET['instructorDept'];
}

$instructor_email = 'N/A';
if (isset($_GET['instructorEmail'])) {
    $instructor_email = $_GET['instructorEmail'];
}
?>

<h1>Instructor Added</h1>

<?php
try{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO instructors (instructor_first, instructor_last, instructor_dept, instructor_email) 
            VALUES (:instructor_first, :instructor_last, :instructor_dept, :instructor_email)";

    $statement = $pdo->prepare($sql);
    $statement->bindValue(':instructor_first', $instructor_first);
    $statement->bindValue(':instructor_last', $instructor_last);
    $statement->bindValue(':instructor_dept', $instructor_dept);
    $statement->bindValue(':instructor_email', $instructor_email);
    $statement->execute();
}
catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
finally {
    $pdo = null;
}
?>