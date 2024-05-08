function clearDefaultText(input) {
    if (input.value === input.defaultValue) {
        input.value = '';
    }
}

function changeTextColor(input) {
    input.style.color = 'black';
}
function togglePassword(password) {
    const passwordInput = document.getElementById(password);
    const toggleIcon = document.getElementById('toggle' + password);
  
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      toggleIcon.classList.remove('fa-eye');
      toggleIcon.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      toggleIcon.classList.remove('fa-eye-slash');
      toggleIcon.classList.add('fa-eye');
    }
  }