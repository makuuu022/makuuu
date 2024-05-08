// Open the "Forgot Password" form
function openForm() {
    document.getElementById("myForm").style.display = "block";
}

// Close the "Forgot Password" form
function closeForm() {
    document.getElementById("myForm").style.display = "none";
    document.getElementById("verificationForm").style.display = "none";
    document.getElementById("newPasswordForm").style.display = "none";
}

// Send the verification code
function sendCode() {
    // Validate the email address
    const email = document.getElementById("email").value;
    const emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;

    if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        return;
    }

    // Send the verification code
    // This should be replaced with an AJAX request to server-side code
    // that sends the verification code to the user's email address
    closeForm();
    openVerificationForm();
}

// Verify the verification code
function verifyCode() {
    const verificationCode = document.getElementById("verificationCode").value;

    // Verify the verification code
    // This should be replaced with an AJAX request to server-side code
    // that checks the verification code against the user's email address
    closeForm();
    openNewPasswordForm();
}

// Save the new password
function saveNewPassword() {
    const newPassword = document.getElementById("newpassword").value;

    // Save the new password
    // This should be replaced with an AJAX request to server-side code
    // that updates the user's password in the database
    closeForm();
}

// Open the "Verification Code" form
function openVerificationForm() {
    document.getElementById("verificationForm").style.display = "block";
}

// Open the "Create New Password" form
function openNewPasswordForm() {
    document.getElementById("newPasswordForm").style.display = "block";
}