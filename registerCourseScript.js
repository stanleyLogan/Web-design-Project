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

    // Form validation and display
  const form = document.querySelector("form");
  if (form) {
    form.addEventListener("submit", function (event) {
      let isValid = true;
      let errorMessage = "";

      // Get values
      const firstName = document.getElementById("studentFirstName").value.trim();
      const lastName = document.getElementById("studentLastName").value.trim();
      const semester = document.getElementById("semester").value;
      const year = document.getElementById("year").value.trim();
      const prefix = document.getElementById("coursePrefix").value.trim();
      const number = document.getElementById("courseNumber").value.trim();
      const section = document.getElementById("courseSection").value.trim();

      // Define Patterns
      const namePattern = /^[a-zA-Z ]+$/;
      const yearPattern = /^\d{4}$/;
      const prefixPattern = /^[A-Z]{3,4}$/;
      const numberPattern = /^\d{3}$/;
      const sectionPattern = /^\d{2}$/;

      // Validation
      if (!firstName.match(namePattern)) {
        isValid = false;
        errorMessage += "First Name is required and must contain only letters and spaces.\n";
      }

      if (!lastName.match(namePattern)) {
        isValid = false;
        errorMessage += "Last Name is required and must contain only letters and spaces.\n";
      }

      if (!year.match(yearPattern) || parseInt(year) < 2025) {
        isValid = false;
        errorMessage += "Year must be 4 digits and not before 2025.\n";
      }

      if (!prefix.match(prefixPattern)) {
        isValid = false;
        errorMessage += "Course Prefix must be 3–4 uppercase letters.\n";
      }

      if (!number.match(numberPattern) || parseInt(number) > 499) {
        isValid = false;
        errorMessage += "Course Number must be 3 digits and ≤ 499.\n";
      }

      if (!section.match(sectionPattern)) {
        isValid = false;
        errorMessage += "Course Section must be exactly 2 digits.\n";
      }
    });
  }
});


