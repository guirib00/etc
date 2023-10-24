function togglePasswordVisibility() {
    var passwordInput = document.getElementById("senha");
    var toggleButton = document.getElementById("toggleIcon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleButton.classList.remove("fa-eye-slash");
        toggleButton.classList.add("fa-eye");
    } else {
        passwordInput.type = "password";
        toggleButton.classList.remove("fa-eye");
        toggleButton.classList.add("fa-eye-slash");
    }
}



function togglePasswordVisibilityConfirmar() {
    var passwordInput = document.getElementById("confirmar_senha");
    var toggleButton = document.getElementById("toggleIcon_confirmar");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleButton.classList.remove("fa-eye-slash");
        toggleButton.classList.add("fa-eye");
    } else {
        passwordInput.type = "password";
        toggleButton.classList.remove("fa-eye");
        toggleButton.classList.add("fa-eye-slash");
    }
}