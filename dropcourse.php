<!DOCTYPE html>
<head>
    <title>Drop Course</title>
    <link rel="stylesheet" href="dropcoursestyle.css">
</head>
<body>
    <!-- Navigation Bar -->
    <div class = "container">
        <nav>
            <button id="menu-toggle">☰ Menu</button> 
            <ul id="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="All_In_One_Processing.php">Enrollment</a></li>
                <li><a href="addinstructor.html">Add an Instructor</a></li>
                <li><a href="addcourse.html">Add a Course</a></li>
                <li><a href="registercourse.html">Register for Courses</a></li>
                <li><a href="dropcourse.php">Need to drop a course?</a></li>
                <li><a href="manuels.html">Manuals</a></li>
            </ul>
        </nav>
        <main>
            <h1>Drop Course</h1>
            <p>Select a student to view their courses</p>

            <form class="form-container" action="courseDrop.php" method="POST">
                <label for="student">Select Student:</label>
                <select id="student" name="student_id" required>
                    <option value="">--Select a Student--</option>
                    <?php
                    require_once 'db.config.php';

                    try {
                        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $stmt = $pdo->query("SELECT student_id, first_name, last_name FROM students");
                        while($row = $stmt->fetch()) {
                            echo "<option value='{$row['student_id']}'>{$row['first_name']} {$row['last_name']}</option>";
                        }
                    } finally {
                        $pdo = null;
                    }
                    ?>
                </select>
                
                <label for="course">Select Course:</label>
                <select id="course" name="course_id" required>
                    <option value="">--Select Course--</option>
                    <!-- This will be populated with JavaScript -->
                </select>

                <input type="submit" value="Drop Course">
            </form>
        </main>
    </div>

    <footer>Page Designed by Gavin Burgess</footer>

    <script>
        const studentDropdown = document.getElementById('student');
        const courseDropdown = document.getElementById('course');

        studentDropdown.addEventListener('change', function() {
            const studentId = studentDropdown.value;
            courseDropdown.innerHTML = ''; // clear old options

            fetch(`getStudentCourses.php?student_id=${studentId}`)
                .then(res => res.json())
                .then(data => {

                    if (data.length === 0) {
                        courseDropdown.innerHTML = '<option disabled>No courses found</option>';
                    } else {
                        data.forEach(course => {
                            const option = document.createElement('option');
                            option.value = course.registration_id;
                            option.textContent = `${course.course_prefix} ${course.course_number} ${course.course_section} (${course.semester} ${course.year})`;
                            courseDropdown.appendChild(option);
                        })
                    
                    }
                })
                .catch(err => {
                    console.error("Errer fetching courses:", err);
                    courseDropdown.innerHTML = '<option value="">--Error loading courses--</option>';
                });
        });

    </script>
</body>
</html>