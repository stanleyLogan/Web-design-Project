<!DOCTYPE html>
<html lang="en">   
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Enrollment</title>  
  <link rel="stylesheet" href="StylingEnrollment.css">
<body>
    <header>Marietta College Student Enrollment Portal</header>
    <div class="Parent-Container">
        <!-- please update the html links here -->
        <header id="Navigation-Header">Navigation</header>
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
        
        <form id="MyFormData" method="post" action="#">
            <fieldset>
                <legend>Please Fill Out The Form Below</legend>
                    <p>
                        <label>First Name</label>
                        <input type="text" name="FirstName"/>
                    </p>
                    <p>
                        <label>Last Name</label>
                        <input type="text" name="LastName"/>
                    </p>
                    <p>
                        <label>Student Year</label>
                        <select name="StudentYear"> name="Student Year"
                            <option>2022</option>
                            <option>2023</option>
                            <option>2024</option>
                            <option>2025</option>
                            <option>2026</option>
                            <option>2027</option>
                    </select>
                    <p>
                        <label>Student Major</label>
                        <input type="text" name="StudentMajor"/>
                    </p>
                    <p>
                        <label>Student Email</label>
                        <input type="text" name="StudentEmail"/>
                    </p>
                        <button id="Submit-Button" type="submit">Submit Enrollment</button>
                </fieldset>  
                
        </form>
    </div>
    <script type="text/javascript" src="Enrollment_Input_Validation.js"></script>
</body>
<footer>Page Presented By Austin Amash | Gavin Burgess | Samual Creameans | Logan Stanley </footer>
<script src="script.js"></script>
