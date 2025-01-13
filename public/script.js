document.addEventListener('DOMContentLoaded', function() {
    const passwordField = document.getElementById('password');
    const showPassword = document.querySelector('.show-password');

    showPassword.addEventListener('click', function() {
        if (passwordField.type === "password") {
            passwordField.type = "text";
            showPassword.textContent = "Hide";
        } else {
            passwordField.type = "password";
            showPassword.textContent = "Show";
        }
    });

    document.getElementById('login-form').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Login attempt with email: ' + document.getElementById('email').value);
        // Here you would typically send data to a server for authentication
    });
});