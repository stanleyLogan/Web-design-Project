<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register for Course</title>
  <link rel="stylesheet" href="registercoursestyle.css">
</head>
<body>
    <header>Register for a Course</header>
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
          <li><a href="viewcourse.php">View Your Courses</a></li>
          <li><a href="manuels.html">Manuals</a></li>
        </ul>
      </nav>
        
        <main>
            <p>This page allows students to register for courses.</p>
            <div class="form-container">
                <form>
                    <label for="studentFirstName">Student First Name:</label>
                    <input type="text" id="studentFirstName" name="studentFirstName">
                    
                    <label for="studentLastName">Student Last Name:</label>
                    <input type="text" id="studentLastName" name="studentLastName">

                    <label for="semester">Semester:</label>
                    <select id="semester" name="semester">
                        <option value="Spring">Spring</option>
                        <option value="Summer">Summer</option>
                        <option value="Fall">Fall</option>
                    </select>
                    
                    <label for="year">Year:</label>
                    <input type="text" id="year" name="year">
                    
                    <label for="coursePrefix">Course Prefix:</label>
                    <input type="text" id="coursePrefix" name="coursePrefix">
                    
                    <label for="courseNumber">Course Number:</label>
                    <input type="text" id="courseNumber" name="courseNumber">
                    
                    <label for="courseSection">Course Section:</label>
                    <input type="text" id="courseSection" name="courseSection">
                    
                    <input type="submit" value="Submit">
                </form>
            </div>
        </main>
    </div>
    <footer>Page Presented By Austin Amash | Gavin Burgess | Samuel Cremeans | Logan Stanley</footer>
    <script src = "registerCourseScript.js"></script>
</body>

</html>
