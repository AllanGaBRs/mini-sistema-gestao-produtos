function togglePassword() {
    const passwordField = document.getElementById('senha');
    const toggleIcon = document.getElementById('toggle-icon');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.innerHTML = '&#128065;';
    } else {
        passwordField.type = 'password';
        toggleIcon.innerHTML = '&#128065;'
    }
}
