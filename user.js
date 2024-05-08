function clearDefaultText(input) {
    if (input.value === input.defaultValue) {
        input.value = '';
    }
}

function changeTextColor(input) {
    input.style.color = 'black';
}
function togglePassword(id) {
    var passwordField = document.getElementById(id);
    var icon = document.getElementById('toggle' + id);
    if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}

