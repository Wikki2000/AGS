/**
 * Validates password fields to ensure they match.
 * 
 * @returns {boolean} Returns true if passwords match, otherwise false.
 */
function validatePassword(password1, password2) {
    const pwd1 = document.getElementById(password1).value;
    const pwd2 = document.getElementById(password2).value;
    const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]).{8,}$/;
    
    if (pwd1 !== pwd2) {
        alert("Passwords must match");
        return false;
    } else if (!pattern.test(pwd1)) {
        alert("Password must be at least 8 characters long.\nContain a lowercase letter, an uppercase letter.\nContain digit, and a special character.");
        return false;
    }
    return true;
}

/**
 * Toggles the visibility of a password input field
 * and updates the associated eye icon.
 * 
 * @param {string} pwdId - The ID of the password input field.
 * @param {string} iconId - The ID of the eye icon.
 */
function togglePassword (pwdId, iconId) {
    const pwdObject = document.getElementById(pwdId);

    /* Toggle between password and text type, then set the value. */
    const type = pwdObject.getAttribute('type') === 'password' ? 'text' : 'password';
    pwdObject.setAttribute('type', type);

    /* Toggle the eye icon between open and closed */
    iconId.classList.toggle('fa-eye-slash');
}
