// validation.js

function validateForm() {
    var firstName = document.forms["registrationForm"]["first_name"].value;
    var lastName = document.forms["registrationForm"]["last_name"].value;
    var dob = document.forms["registrationForm"]["dob"].value;
    var username = document.forms["registrationForm"]["username"].value;
    var email = document.forms["registrationForm"]["email"].value;
    var password1 = document.forms["registrationForm"]["password_1"].value;
    var password2 = document.forms["registrationForm"]["password_2"].value;

    // Regular expressions for validation
    var nameRegex = /^[a-zA-Z]+$/;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Validate first name
    if (!nameRegex.test(firstName.trim())) {
        alert("Please enter a valid first name.");
        return false;
    }

    // Validate last name
    if (!nameRegex.test(lastName.trim())) {
        alert("Please enter a valid last name.");
        return false;
    }

    // Validate date of birth (DOB)
    if (!dob) {
        alert("Please enter a valid date of birth.");
        return false;
    }

    // Validate username
    if (!nameRegex.test(username.trim())) {
        alert("Please enter a valid username.");
        return false;
    }

    // Validate email
    if (!emailRegex.test(email.trim())) {
        alert("Please enter a valid email address.");
        return false;
    }

    // Validate password
    if (password1.length < 8) {
        alert("Password must be at least 8 characters long.");
        return false;
    }

    // Validate password match
    if (password1 !== password2) {
        alert("Passwords do not match.");
        return false;
    }
    
    if (!/[a-z]/.test(text)) {
        alert("Password must contain at least 1 lowercase letter.");
        return false;
    }
    
    if (!/[A-Z]/.test(text)) {
        alert("Password must contain at least 1 uppercase letter.");
        return false;
    }
    
    if (!/[0-9]/.test(text)) {
        alert("Password must contain at least 1 number.");
        return false;
    }
    
    if (!/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(text)) {
        alert("Password must contain at least 1 special character.");
        return false;
    }
    return true;
}