document.addEventListener("DOMContentLoaded", function() {
  // ---- Menu toggle ----

  const menuToggle = document.getElementById("menu-toggle");
  const menuToggle2 = document.getElementById("menu-toggle2");
  const navLinks = document.getElementById("nav-links");
  const navlinks2 = document.getElementById('nav-links2');

  if (menuToggle) {
      menuToggle.addEventListener("click", function() {
          navLinks.classList.toggle("hide");
      });
  }

  if (menuToggle2 && navlinks2) {
      menuToggle2.addEventListener("click", function() {
          navlinks2.classList.toggle("hide");
      });
  }

  // ---- Time Dropdown Visibility Based on Day Selection ----
  const daySelect = document.getElementById("days");
  const timeDropdowns = {
    "Monday, Wednesday,Friday": document.getElementById("wrap-time-mwf"),
    "Monday,Wednesday": document.getElementById("wrap-time-mw"),
    "Tuesday, Thursday": document.getElementById("wrap-time-tth"),
    "Single Day": document.getElementById("wrap-time-single")
  };


  function updateTimeDropdown() {
    for (let key in timeDropdowns) {
      timeDropdowns[key].hidden = true;
    }
    const selectedDay = daySelect.value;
    if (timeDropdowns[selectedDay]) {
      timeDropdowns[selectedDay].hidden = false;
    }
  }

  if (daySelect) {
    daySelect.addEventListener("change", updateTimeDropdown);
    updateTimeDropdown(); // initialize on load
  }

  // ---- Form validation and processing ----

  const form = document.querySelector("form");
  if (form) {
    form.addEventListener("submit", function (event) {
      let isValid = true;
      let errorMessage = "";

      // Grab input values
      const semester = document.getElementById("semester").value;
      const year = document.getElementById("year").value.trim();
      const coursePrefix = document.getElementById("coursePrefix").value.trim();
      const courseNumber = document.getElementById("courseNumber").value.trim();
      const courseSection = document.getElementById("courseSection").value.trim();
      const courseName = document.getElementById("courseName").value.trim();
      const room = document.getElementById("room").value.trim();
      const credits = document.getElementById("credits").value.trim();
      const instructorFirstName = document.getElementById("instructorFirstName").value.trim();
      const instructorLastName = document.getElementById("instructorLastName").value.trim();
      const enrollmentCap = document.getElementById("enrollmentCap").value.trim();
      const selectedDay = document.getElementById("days").value;
      let selectedTime = "";

      if (timeDropdowns[selectedDay]) {
        selectedTime = timeDropdowns[selectedDay].value;
      }

      // Define patterns
      const yearPattern = /^\d{4}$/;
      const coursePrefixPattern = /^[A-Z]{3,4}$/;
      const courseNumberPattern = /^\d{3}$/;
      const courseSectionPattern = /^\d{2}$/;
      const roomPattern = /^[a-zA-Z ]+\s\d{2,3}[a-zA-Z]?$/;
      const creditPattern = /^([0-4])(\.0)?$/;
      const namePattern = /^[a-zA-Z ]+$/;
      const enrollmentCapPattern = /^\d{2}$/;

      // Validation checks
      if (!year.match(yearPattern) || parseInt(year) < 2025) {
        isValid = false;
        errorMessage += "Year must be four digits and not before 2025.\n";
      }
      if (!coursePrefix.match(coursePrefixPattern)) {
        isValid = false;
        errorMessage += "Course Prefix must be 3 or 4 capital letters.\n";
      }
      if (!courseNumber.match(courseNumberPattern) || parseInt(courseNumber) > 499) {
        isValid = false;
        errorMessage += "Course Number must be 3 digits and not greater than 499.\n";
      }
      if (!courseSection.match(courseSectionPattern)) {
        isValid = false;
        errorMessage += "Course Section must be exactly 2 digits.\n";
      }
      if (room && !room.match(roomPattern)) {
        isValid = false;
        errorMessage += "Room must follow the format: BuildingName 123 or 123A.\n";
      }
      if (!credits.match(creditPattern)) {
        isValid = false;
        errorMessage += "Credit Hours must be between 0 and 4.\n";
      }
      if (!instructorFirstName.match(namePattern)) {
        isValid = false;
        errorMessage += "Instructor's First Name must contain only letters and spaces.\n";
      }
      if (!instructorLastName.match(namePattern)) {
        isValid = false;
        errorMessage += "Instructor's Last Name must contain only letters and spaces.\n";
      }
      if (!enrollmentCap.match(enrollmentCapPattern)) {
        isValid = false;
        errorMessage += "Enrollment Cap must be a two-digit number.\n";
      }
    });
  }
});