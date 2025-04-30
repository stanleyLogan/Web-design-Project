<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web Project 1</title>
  <link rel="stylesheet" href="dropcoursestyle.css">
</head>
<body>
    <h1>Drop A Course</h1>

    <!-- Navigation Bar -->
    <div class = "container">
      <nav>
        <button id="menu-toggle">☰ Menu</button> 
        <ul id="nav-links">
          <li><a href="index.html">Home</a></li>
          <li><a href="Enrollment Page.html">Enrollment</a></li>
          <li><a href="addinstructor.html">Add an Instructor</a></li>
          <li><a href="addcourse.html">Add a Course</a></li>
          <li><a href="registercourse.html">Register for Courses</a></li>
          <li><a href="dropcourse.html">Need to drop a course?</a></li>
          <li><a href="manuels.html">Manuals</a></li>
        </ul>
      </nav>
    </div>


    <main>
        <p>This page allows students to drop a course.
           To drop a course, fill in its information then press submit.</p>
        <div class="form-container">
            <form action="dropcourse.php" method="post">
              <label for = "student">Select Student:</label>
              <select name="student_id" id="student" required>
                <option value="">Select a Student</option>
                <?php
                require_once 'db.config.php';
                try{
                  $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
                  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  $stmt = $pdo->query("SELECT student_id, first_name, last_name FROM students ORDER BY last_name");
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['student_id'] . '">' . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . '</option>';
                  }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                ?>
              </select>
                
              <br/>

              <label for="course">Select Course:</label>
              <select name="registration_id" id="course" required>
                <option value="">Select a course</option>
                <!-- options loaded be JS after student selection -->
              </select>

              <br/>

              <input type="submit" value="Drop Course">
            </form>

            <script>
              document.getElementById('student').addEventListener('change', function() {
                var studentId = this.value;
                var courseSelect = document.getElementById('course');

                // Clear course list
                courseSelect.innerHTML = '<option value="">Loading</option>';

                fetch('getStudentCourses.php?student_id=' + studentId)
                  .then(response => response.json())
                  .then(data => {
                    let option = document.createElement('option');
                    option.value = course.registration_id;
                    option.textContent = course.course_prefix + ' ' + course.course_number + '-' + course.course_section + ' (' + course.semester + ' ' + course.year + ')';
                  })
                  .catch(error => {
                    console.error('Error fetching courses:', error);
                    courseSelect.innerHTML = '<option value="">Error loading courses</option>';
                  });
                });
            </script>
    </main>
          
    <footer>Page Designed By Gavin Burgess</footer>
    <script src = "dropCourseScript.js"></script>
</body>
</html>