<!DOCTYPE html>
<html lang="en">   
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment</title>  
    <link rel="stylesheet" href="StylingEnrollment.css">
</head>
<body>
    <header>Marietta College Student Enrollment Portal</header>
    <div class="Parent-Container">
        <header id="Navigation-Header">Navigation</header>
        <nav>
            <!-- this is the bar of navigation links under the header -->
            <ul id="nav-links">
              <li><a href="index.php">Home</a></li>
              <li><a href="All_In_One_Processing.php">Enrollment</a></li>
              <li><a href="addinstructor.html">Add an Instructor</a></li>
              <li><a href="addcourse.html">Add a Course</a></li>
              <li><a href="registercourse.html">Register for Courses</a></li>
              <li><a href="dropcourse.php">Need to drop a course?</a></li>
              <li><a href="manuels.html">Manuals</a></li>
              <li><a href="viewcourse.php">View Your Courses</a></li>
              <li><a href="viewenrollment.php">View Students</a></li>
            </ul>
        </nav> 
        <?php
        $submission_successful = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $Host = 'localhost';
            $DB_Name = 'web design';
            $User_Name = 'root';
            $Password = ''; #must be an empty string do not remove

            try {
                $pdo = new PDO("mysql:host=$Host;dbname=$DB_Name", $User_Name, $Password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $First_Name = trim($_POST['FirstName']);
                $Last_Name = trim($_POST['LastName']);
                $Student_Year = $_POST['StudentYear'];
                $Student_Major = trim($_POST['StudentMajor']);
                $Student_Email = trim($_POST['StudentEmail']);

                try { #Logic For checking data before binding and execution 
                    $Regex_First_Name = '/^[A-Z][a-z]{1,10}$/';
                    $Regex_Last_Name = '/^[A-Z][a-z]{1,10}$/';
                    $Regex_Student_Major = '/^[A-Z][a-z]{1,15}\s?\-?[A-Z]?[a-z]{0,15}$/';
                    $Regex_Student_Email = '#^[0-9A-Za-z"\'\-]{0,25}@[A-Za-z\.0-9]+\.(com|org|gov|co|edu|net)$#';

                    $Error_Array = [];

                    if (!preg_match($Regex_First_Name, $First_Name)) {
                        $Error_Array['FirstName'] = "Error:Please make name capital with no numbers (Required Feild)";
                    }

                    if (!preg_match($Regex_Last_Name, $Last_Name)) {
                        $Error_Array['LastName'] = "Error:Please make name capital with no numbers (Required Feild)";
                    }

                    if (!preg_match($Regex_Student_Major, $Student_Major)) {
                        $Error_Array['StudentMajor'] = "Error:Please make name capital with no numbers. (Required Feild)";
                    }

                    if (empty($Student_Year)) {
                        $Error_Array['StudentYear'] = "Student Year is required.";
                    } elseif (!in_array($Student_Year, ['Freshman', 'Sophomore', 'Junior', 'Senior'])) {
                        $Error_Array['StudentYear'] = "Invalid Student Year. (Freshman - Senior)";
                    }

                    if (!preg_match($Regex_Student_Email, $Student_Email)) {
                        $Error_Array['StudentEmail'] = "Error:Invalid Student Email (Required Feild)";
                    }

                    if (empty($Error_Array)) {
                        $sql = "INSERT INTO students (first_name, last_name, student_year, student_major, student_email) VALUES (:FirstName, :LastName, :StudentYear, :StudentMajor, :StudentEmail)";
                        $statement = $pdo->prepare($sql);
                        $statement->bindParam(':FirstName', $First_Name);
                        $statement->bindParam(':LastName', $Last_Name);
                        $statement->bindParam(':StudentYear', $Student_Year);
                        $statement->bindParam(':StudentMajor', $Student_Major);
                        $statement->bindParam(':StudentEmail', $Student_Email);
                        $statement->execute();
                        $submission_successful = true;
                    }
                } catch (PDOException $e) {
                    echo ("Data Upload Failed: " . $e->getMessage());
                }
            } catch (PDOException $e) {
                echo ("Connection Failed: " . $e->getMessage());
            }
        }
        ?>
        <form id="MyFormData" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <fieldset>
                <legend>
                    <?php if ($submission_successful): ?>
                        Form Submitted Successfully
                    <?php else: ?>
                        Please Fill Out The Form Below
                    <?php endif; ?>
                </legend>
                <p>
                    <label>First Name</label>
                    <input type="text" name="FirstName" placeholder="Enter your first name" />
                    <?php if (isset($Error_Array['FirstName'])) : ?>
                        <span class="Error"><?php echo htmlspecialchars($Error_Array['FirstName']); ?></span>
                    <?php endif; ?>
                </p>
                <p>
                    <label>Last Name</label>
                    <input type="text" name="LastName" placeholder="Enter your last name" />
                    <?php if (isset($Error_Array['LastName'])) : ?>
                        <span class="Error"><?php echo htmlspecialchars($Error_Array['LastName']); ?></span>
                    <?php endif; ?>
                </p>
                <p>
                <label for="studentYear">Student Year:</label>
                    <input type="text" id="StudentYear" name="StudentYear" list="years" placeholder="Select year">
                    <datalist id="years">
                        <option value="Freshman">
                        <option value="Sophomore">
                        <option value="Junior">
                        <option value="Senior">
                    </datalist>
                    <?php if (isset($Error_Array['StudentYear'])) : ?>
                        <span class="Error"><?php echo htmlspecialchars($Error_Array['StudentYear']); ?></span>
                    <?php endif; ?>
                </p>
                <p>
                    <label>Student Major</label>
                    <input type="text" name="StudentMajor" placeholder="Enter a student major" />
                    <?php if (isset($Error_Array['StudentMajor'])) : ?>
                        <span class="Error"><?php echo htmlspecialchars($Error_Array['StudentMajor']); ?></span>
                    <?php endif; ?>
                </p>
                <p>
                    <label>Student Email</label>
                    <input type="text" name="StudentEmail" placeholder="Enter a valid email address" />
                    <?php if (isset($Error_Array['StudentEmail'])) : ?>
                        <span class="Error"><?php echo htmlspecialchars($Error_Array['StudentEmail']); ?></span>
                    <?php endif; ?>
                </p>
                <button id="Submit-Button" type="submit">Submit Enrollment</button>
            </fieldset>
        </form>
    </div>
</body>
<footer>Page Presented By Austin Amash | Gavin Burgess | Samual Creameans | Logan Stanley</footer>
</html>
