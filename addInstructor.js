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


    // ---- Form validation ----

    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        let isValid = true;
        let errorMessage = '';

        // Get input values
        const firstName = document.getElementById('instructorFirstName').value.trim();
        const lastName = document.getElementById('instructorLastName').value.trim();
        const department = document.getElementById('instructorDept').value.trim();
        const email = document.getElementById('instructorEmail').value.trim();

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

        // Validate department
        if (department && !/^[a-zA-Z\s]*$/.test(department)) {
            isValid = false;
            errorMessage += 'Department must contain only letters and spaces.\n';
        }

        // Validate email
        const emailValidation = /^[a-zA-Z]{3}\d{3}@marietta\.edu$/;
        if (!email.match(emailValidation)) {
            isValid = false;
            errorMessage += 'Email must follow the format: abc123@marietta.edu\n';
        }

        // Display values
        //if (isValid) {
        //    alert(`First Name: ${firstName}\nLast Name: ${lastName}\nDepartment: ${department}\nEmail: ${email}`);
        //}

        // Validation failure message
        if (!isValid) {
            event.preventDefault();
            alert(errorMessage);
        }
    })
});

