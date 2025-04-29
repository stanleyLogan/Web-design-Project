<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web Project 1</title>
  <link rel="stylesheet" href="style.css">
</head>
<body> 
    <header>Welcome to Student Registration!</header>

    <div class="container">
      <nav>
        <button id="menu-toggle">☰ Menu</button> 
        <ul id="nav-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="Enrollment Page.php">Enrollment</a></li>
          <li><a href="addinstructor.php">Add an Instructor</a></li>
          <li><a href="addcourse.php">Add a Course</a></li>
          <li><a href="registercourse.php">Register for Courses</a></li>
          <li><a href="dropcourse.php">Need to drop a course?</a></li>
          <li><a href="manuels.html">Manuals</a></li>
        </ul>
      </nav>

      <main>
      <?php
include 'db_connect.php'; // Make sure you connect to your database
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Courses</title>
</head>
<body>

<h1>View Courses</h1>

<form method="POST" action="viewcourse.php">
  <label>View courses by:</label><br>
  <input type="radio" name="view_by" value="student" required> Student<br>
  <input type="radio" name="view_by" value="instructor" required> Instructor<br><br>

  <?php
  // Fetch Students
  $studentStmt = $pdo->query("SELECT student_id, first_name FROM Students");
  $students = $studentStmt->fetchAll(PDO::FETCH_ASSOC);

  // Fetch Instructors
  $instructorStmt = $pdo->query("SELECT instructor_id, instructor_first FROM Instructors");
  $instructors = $instructorStmt->fetchAll(PDO::FETCH_ASSOC);
  ?>

  <div id="student_list" style="display:none;">
    <label>Select Student:</label><br>
    <select name="student_id">
      <option value="">-- Select a Student --</option>
      <?php foreach ($students as $student): ?>
        <option value="<?= $student['student_id'] ?>"><?= htmlspecialchars($student['first_name']) ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div id="instructor_list" style="display:none;">
    <label>Select Instructor:</label><br>
    <select name="instructor_id">
      <option value="">-- Select an Instructor --</option>
      <?php foreach ($instructors as $instructor): ?>
        <option value="<?= $instructor['instructor_id'] ?>"><?= htmlspecialchars($instructor['instructor_first']) ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <br>
  <input type="submit" value="View Courses">
</form>

<script>
document.querySelectorAll('input[name="view_by"]').forEach((radio) => {
  radio.addEventListener('change', function() {
    if (this.value === 'student') {
      document.getElementById('student_list').style.display = 'block';
      document.getElementById('instructor_list').style.display = 'none';
    } else if (this.value === 'instructor') {
      document.getElementById('student_list').style.display = 'none';
      document.getElementById('instructor_list').style.display = 'block';
    }
  });
});
</script>

<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST['student_id'])) {
    $student_id = $_POST['student_id'];
    echo "<h2>Courses for Selected Student</h2>";

    $sql = "SELECT c.course_prefix, c.course_number, c.course_section, c.course_name, c.time, c.room, c.hours, i.instructor_first, c.enrollment_cap
            FROM Registration r
            JOIN Courses c ON r.course_id = c.course_id
            JOIN Instructors i ON c.instructor_id = i.instructor_id
            WHERE r.student_id = :student_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['student_id' => $student_id]);
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($courses) {
      echo "<table border='1'>";
      echo "<tr><th>Prefix</th><th>Number</th><th>Section</th><th>Name</th><th>Days/Time</th><th>Room</th><th>Credit Hours</th><th>Instructor</th><th>Cap</th></tr>";
      foreach ($courses as $course) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($course['course_prefix']) . "</td>";
        echo "<td>" . htmlspecialchars($course['course_number']) . "</td>";
        echo "<td>" . htmlspecialchars($course['course_section']) . "</td>";
        echo "<td>" . htmlspecialchars($course['course_name']) . "</td>";
        echo "<td>" . htmlspecialchars($course['time']) . "</td>";
        echo "<td>" . htmlspecialchars($course['room']) . "</td>";
        echo "<td>" . htmlspecialchars($course['hours']) . "</td>";
        echo "<td>" . htmlspecialchars($course['instructor_first']) . "</td>";
        echo "<td>" . htmlspecialchars($course['enrollment_cap']) . "</td>";
        echo "</tr>";
      }
      echo "</table>";
    } else {
      echo "<p>No courses found for this student.</p>";
    }

  } elseif (!empty($_POST['instructor_id'])) {
    $instructor_id = $_POST['instructor_id'];
    echo "<h2>Courses Taught by Selected Instructor</h2>";

    $sql = "SELECT course_prefix, course_number, course_section, course_name, time, room, hours, enrollment_cap
            FROM Courses
            WHERE instructor_id = :instructor_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['instructor_id' => $instructor_id]);
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($courses) {
      echo "<table border='1'>";
      echo "<tr><th>Prefix</th><th>Number</th><th>Section</th><th>Name</th><th>Days/Time</th><th>Room</th><th>Credit Hours</th><th>Cap</th></tr>";
      foreach ($courses as $course) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($course['course_prefix']) . "</td>";
        echo "<td>" . htmlspecialchars($course['course_number']) . "</td>";
        echo "<td>" . htmlspecialchars($course['course_section']) . "</td>";
        echo "<td>" . htmlspecialchars($course['course_name']) . "</td>";
        echo "<td>" . htmlspecialchars($course['time']) . "</td>";
        echo "<td>" . htmlspecialchars($course['room']) . "</td>";
        echo "<td>" . htmlspecialchars($course['hours']) . "</td>";
        echo "<td>" . htmlspecialchars($course['enrollment_cap']) . "</td>";
        echo "</tr>";
      }
      echo "</table>";
    } else {
      echo "<p>No courses found for this instructor.</p>";
    }
  } else {
    echo "<p>Please select a student or instructor.</p>";
  }
}
?>

</body>
</html>
      </main>

    </div>

    <footer>Page Presented By Austin Amash | Gavin Burgess | Samual Creameans | Logan Stanley</footer>

    <script src="script.js"></script> 
</body>
</html>
