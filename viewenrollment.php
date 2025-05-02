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
          <li><a href="All_In_One_Processing.php">Enrollment</a></li>
          <li><a href="addinstructor.html">Add an Instructor</a></li>
          <li><a href="addcourse.html">Add a Course</a></li>
          <li><a href="registercourse.html">Register for Courses</a></li>
          <li><a href="dropcourse.php">Need to drop a course?</a></li>
          <li><a href="viewcourse.php">View Your Courses</a></li>
          <li><a href="viewenrollment.php">View Students</a></li>
          <li><a href="manuels.html">Manuals</a></li>
        </ul>
      </nav>

    <main>
      <?php include 'db_connect.php'; ?>

      <h1>View Students</h1>

      <form method="POST" action="viewenrollment.php">
        <label>View Students by:</label><br>
        <input type="radio" name="view_by" value="course" required> Course<br>
        <input type="radio" name="view_by" value="semester" required> Semester<br><br>

        <?php
          $courseStmt = $pdo->query("SELECT course_id, course_name FROM Courses");
          $semesterStmt = $pdo->query("SELECT DISTINCT semester FROM Courses ORDER BY semester");
        ?>

        <div id="course_list" style="display:none;">
          <label>Select Course:</label><br>
          <select name="course_id">
            <option value="">-- Select a Course --</option>
            <?php foreach ($courseStmt as $course): ?>
              <option value="<?= $course['course_id'] ?>"><?= htmlspecialchars($course['course_name']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div id="semester_list" style="display:none;">
          <label>Select Semester:</label><br>
          <select name="semester">
            <option value="">-- Select a Semester --</option>
            <?php foreach ($semesterStmt as $row): ?>
              <option value="<?= htmlspecialchars($row['semester']) ?>"><?= htmlspecialchars($row['semester']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <br>
        <input type="submit" value="View Students">
      </form>

      <script>
        document.querySelectorAll('input[name="view_by"]').forEach((radio) => {
          radio.addEventListener('change', function() {
            if (this.value === 'course') {
              document.getElementById('course_list').style.display = 'block';
              document.getElementById('semester_list').style.display = 'none';
            } else if (this.value === 'semester') {
              document.getElementById('course_list').style.display = 'none';
              document.getElementById('semester_list').style.display = 'block';
            }
          });
        });
      </script>

      <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          if (!empty($_POST['course_id'])) {
            $course_id = $_POST['course_id'];
            echo "<h2>Students Enrolled in Selected Course</h2>";

            $sql = "SELECT s.student_id, s.first_name, s.last_name, s.student_year, s.student_major, s.student_email
                    FROM Registration r
                    JOIN Students s ON r.student_id = s.student_id
                    WHERE r.course_id = :course_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['course_id' => $course_id]);
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($students) {
              echo "<table border='1'>";
              echo "<tr><th>Students Name</th><th>Students Year</th><th>Students Major</th><th>Students Email</th></tr>";
              foreach ($students as $student) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) . "</td>";
                echo "<td>" . htmlspecialchars($student['student_year']) . "</td>";
                echo "<td>" . htmlspecialchars($student['student_major']) . "</td>";
                echo "<td>" . htmlspecialchars($student['student_email']) . "</td>";
                echo "</tr>";
              }
              echo "</table>";
            } else {
              echo "<p>No students found for this course.</p>";
            }

          } elseif (!empty($_POST['semester'])) {
            $semester = $_POST['semester'];
            echo "<h2>Students Enrolled in Semester: " . htmlspecialchars($semester) . "</h2>";

            $sql = "SELECT DISTINCT s.student_id, s.first_name, s.last_name, s.student_year, s.student_major, s.student_email, course_prefix,course_number,course_section
                    FROM Registration r
                    JOIN Courses c ON r.course_id = c.course_id
                    JOIN Students s ON r.student_id = s.student_id
                    WHERE c.semester = :semester";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['semester' => $semester]);
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($students) {
              echo "<table border='1'>";
              echo "<tr><th>Students Name</th><th>Students Year</th><th>Students Major</th><th>Students Email</th><th>Course Prefix</th><th>Course Number</th><th>Course Section</th></tr>";
              foreach ($students as $student) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) . "</td>";
                echo "<td>" . htmlspecialchars($student['student_year']) . "</td>";
                echo "<td>" . htmlspecialchars($student['student_major']) . "</td>";
                echo "<td>" . htmlspecialchars($student['student_email']) . "</td>";
                echo "<td>" . htmlspecialchars($student['course_prefix']) . "</td>";
                echo "<td>" . htmlspecialchars($student['course_number']) . "</td>";
                echo "<td>" . htmlspecialchars($student['course_section']) . "</td>";
                echo "</tr>";
              }
              echo "</table>";
            } else {
              echo "<p>No students found for this semester.</p>";
            }

          } else {
            echo "<p>Please select a course or semester.</p>";
          }
        }
      ?>
    </main>

  </div>

  <footer>Page Presented By Austin Amash | Gavin Burgess | Samual Creameans | Logan Stanley</footer>

  <script src="script.js"></script> 
</body>
</html>
