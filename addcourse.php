<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Course</title>
  <link rel="stylesheet" href="addcoursestyle.css">
</head>
<body>
    <header>Add a Course</header>
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
            <p>This page allows you to add a new course to the system.</p>
            <div class="form-container">
                <form>
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

                    <label for="courseName">Course Name:</label>
                    <input type="text" id="courseName" name="courseName">

                    <label for="room">Room (Building & Number):</label>
                    <input type="text" id="room" name="room">

                    <label for="days">Days Offered:</label>
                    <select id="days" name="days">
                        <option value="MWF">Monday, Wednesday, Friday</option>
                        <option value="MW">Monday, Wednesday</option>
                        <option value="TTH">Tuesday, Thursday</option>
                        <option value="SD">Single Day</option>
                    </select>

                    <div id="wrap-time-mwf" hidden>
                        <label for="time-mwf">Time (Monday, Wednesday, Friday):</label>
                        <select id="time-mwf" name="time-mwf">
                            <option>8:00 AM to 8:50 AM</option>
                            <option>9:00 AM to 9:50 AM</option>
                            <option>10:00 AM to 10:50 AM</option>
                            <option>11:00 AM to 11:50 AM</option>
                            <option>12:00 PM to 12:50 PM</option>
                            <option>1:00 PM to 1:50 PM</option>
                            <option>2:00 PM to 2:50 PM</option>
                            <option>3:00 PM to 3:50 PM</option>
                        </select>
                    </div>

                    <div id="wrap-time-mw" hidden>
                        <label for="time-mw">Time (Monday, Wednesday):</label>
                        <select id="time-mw" name="time-mw">
                            <option>9:00 AM to 10:50 AM</option>
                            <option>1:00 PM to 2:15 PM</option>
                            <option>1:00 PM to 2:50 PM</option>
                            <option>2:00 PM to 3:15 PM</option>
                        </select>
                    </div>

                    <div id="wrap-time-tth" hidden>
                        <label for="time-tth">Time (Tuesday, Thursday):</label>
                        <select id="time-tth" name="time-tth">
                            <option>8:00 AM to 9:15 AM</option>
                            <option>9:30 AM to 10:45 AM</option>
                            <option>11:00 AM to 12:15 PM</option>
                            <option>1:00 PM to 2:15 PM</option>
                            <option>2:30 PM to 3:45 PM</option>
                        </select>
                    </div>

                    <div id="wrap-time-single" hidden>
                        <label for="time-single">Time (Single Day - Monday, Tuesday, Wednesday, or Thursday):</label>
                        <select id="time-single" name="time-single">
                            <option>1:00 PM to 4:00 PM</option>
                            <option>2:00 PM to 5:00 PM</option>
                            <option>7:00 PM to 9:30 PM</option>
                        </select>
                    </div>

                    
                    <label for="credits">Credit Hours:</label>
                    <input type="text" id="credits" name="credits">

                    <label for="instructorFirstName">Instructor First Name:</label>
                    <input type="text" id="instructorFirstName" name="instructorFirstName">

                    <label for="instructorLastName">Instructor Last Name:</label>
                    <input type="text" id="instructorLastName" name="instructorLastName">

                    <label for="enrollmentCap">Enrollment Cap:</label>
                    <input type="text" id="enrollmentCap" name="enrollmentCap">

                    <input type="submit" value="Submit">
                </form>
            </div>
        </main>
    </div>
    <footer>Page Presented By Austin Amash | Gavin Burgess | Samuel Cremeans | Logan Stanley</footer>
   
    <script src="addCourseScript.js"></script>
</body>
