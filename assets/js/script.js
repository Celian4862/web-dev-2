document.addEventListener("DOMContentLoaded", function() {
    const element = document.querySelector('nav');
    const elementHeight = element.offsetHeight;
    const newHeight = `calc(100vh - ${elementHeight}px)`;
    const backgroundHalf = document.querySelector('.background-half');
    backgroundHalf.style.height = newHeight;
});

function validateForm() {
    var email = document.getElementById("email").value;
    var username = document.getElementById("username").value;
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var usernamePattern = /^[a-zA-Z0-9_]+$/;

    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    if (!usernamePattern.test(username)) {
        alert("Username can only contain letters, numbers, and underscores.");
        return false;
    }
    return true;
}