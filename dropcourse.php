<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web Project 1</title>
  <link rel="stylesheet" href="dropcoursestyle.css">
</head>
<body>
    <header>Drop A Course</header>

    <!-- Navigation Bar -->
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
        <p>This page allows students to drop a course.
            To drop a course, fill in its information then press submit.</p>
        <div class="form-container">
            <form>
                <label for="studentFirstName">Student First Name:</label>
                <input type="text" id="studentFirstName" name="studentFirstName">
                <br/>
                <label for="studentLastName">Student Last Name:</label>
                <input type="text" id="studentLastName" name="studentLastName">
                <br/>
                <label for="semester">Semester:</label>
                <input type="text" id="semester" name="semester">
                <br/>
                <label for="year">Year:</label>
                <input type="text" id="year" name="year">
                <br/>
                <label for="coursePrefix">Course Prefix:</label>
                <input type="text" id="coursePrefix" name="coursePrefix">
                <br/>
                <label for="courseNumber">Course Number:</label>
                <input type="text" id="courseNumber" name="courseNumber">
                <br/>
                <label for="courseSection">Course Section:</label>
                <input type="text" id="courseSection" name="courseSection">
                <br/>
                <input type="submit" value="Submit">
            </form>
    </main>
          
    <footer>Page Designed By Gavin Burgess</footer>
    <script src = "dropCourseScript.js"></script>
</body>