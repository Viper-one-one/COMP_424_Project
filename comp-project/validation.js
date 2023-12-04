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
    if (password1.length < 6) {
        alert("Password must be at least 6 characters long.");
        return false;
    }

    // Validate password match
    if (password1 !== password2) {
        alert("Passwords do not match.");
        return false;
    }

    validatePassword(password1);

    return true;
}

function validatePassword(password) {
    if (username.length >= 8) {
        var regex = /^(?=.*\\d)(?=.*\\W).{8,}$/; // the regex to test against
        var isValid = regex.test(password);
        return isValid;
    } else {
        return false;
    }
}