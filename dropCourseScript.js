document.addEventListener('DOMContentLoaded', function() {
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


    // ---- Form validation ----

    const form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        let isValid = true;
        let errorMessage = '';

        // Get input values
        const firstName = document.getElementById('studentFirstName').value.trim();
        const lastName = document.getElementById('studentLastName').value.trim();
        const semester = document.getElementById('semester').value.trim();
        const year = document.getElementById('year').value.trim();
        const coursePrefix = document.getElementById('coursePrefix').value.trim();
        const courseNumber = document.getElementById('courseNumber').value.trim();
        const courseSection = document.getElementById('courseSection').value.trim();

        // Validate first name
        const firstNameString = /^[a-zA-Z\s]+$/;
        if (!firstName.match(firstNameString)) {
            isValid = false;
            errorMessage += 'First name must contain only letters and spaces.\n';
        }

        // Validate last name
        const lastNameString = /^[a-zA-Z\s]+$/;
        if (!lastName.match(lastNameString)) {
            isValid = false;
            errorMessage += 'Last name must contain only letters and spaces.\n';
        }

        // Validate semester
        if (semester === '') {
            isValid = false;
            errorMessage += 'Semester is required.\n';
        }

        // Validate year
        const yearNum = /^\d{4}$/;
        if (!yearNum.test(year)) {
            isValid = false;
            errorMessage += 'Year must be a four-digit number.\n';
        } else if (parseInt(year, 10) < 2025) {
            isValid = false;
            errorMessage += 'Year must be 2025 or later.\n';
        }

        // Validate course prefix
        const coursePrefixString = /^[A-Z]{3,4}$/;
        if (!coursePrefix.match(coursePrefixString)) {
            isValid = false;
            errorMessage += 'Course prefix must be 3 or 4 capital letters.\n';
        }

        // Validate course number
        const courseNum = /^\d{3}$/;
        if (!courseNum.test(courseNumber)) {
            isValid = false;
            errorMessage += 'Course number must be a three-digit number.\n';
        } else if (parseInt(courseNumber, 10) > 499) {
            isValid = false;
            errorMessage += 'Course number cannot be greater than 499.\n';
        }

        // Validate course section
        const courseSectionNum = /^\d{2}$/;
        if (!courseSectionNum.test(courseSection)) {
            isValid = false;
            errorMessage += 'Course section must be a two-digit number.\n';
        }


        // Display values
        if (isValid) {
            alert(`First Name: ${firstName}\nLast Name: ${lastName}\nSemester: ${semester}\nYear: ${year}\nCourse Prefix: ${coursePrefix}\nCourse Number: ${courseNumber}\nCourse Section: ${courseSection}`);
        }

        // Validation failure message
        if (!isValid) {
            event.preventDefault();
            alert(errorMessage);
        }
    });
});
