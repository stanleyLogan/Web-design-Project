<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web Project 1</title>
  <link rel="stylesheet" href="addinstructorstyle.css">
</head>
<body>
    <header>Add Instructor</header>
    
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
          <p style="text-align:center;">
              This page allows students to add an instructor.
              Simply enter the instructor's information in the form below and press submit.
          </p>
  
          <div class="form-container">
              <form>
                  <label for="instructorFirstName">Instructor First Name:</label>
                  <input type="text" id="instructorFirstName" name="instructorFirstName">
  
                  <label for="instructorLastName">Instructor Last Name:</label>
                  <input type="text" id="instructorLastName" name="instructorLastName">
  
                  <label for="instructorDept">Instructor Department:</label>
                  <input type="text" id="instructorDept" name="instructorDept">
  
                  <label for="instructorEmail">Instructor Email:</label>
                  <input type="email" id="instructorEmail" name="instructorEmail">
  
                  <br/>
  
                  <select name="rank" class="rank">
                      <option value="instructor">Instructor</option>
                      <option value="assistantprofessor">Assistant Professor</option>
                      <option value="associateprofessor">Associate Professor</option>
                      <option value="professor">Professor</option>
                  </select>
  
                  <br/>
  
                  <input type="submit" class="submitbutton">
              </form>
          </div>
      </main>
  </div> <!-- Close the .container div properly -->
  
  <footer>Page Designed By Gavin Burgess</footer>
  <script src = "addInstructor.js"></script>
</body>
  