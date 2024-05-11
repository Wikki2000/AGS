/**
 * Validates password fields to ensure they match.
 * 
 * @returns {boolean} Returns true if passwords match, otherwise false.
 */
function validatePassword () {
    var pwd1 = document.getElementById("pwd1").value;
    var pwd2 = document.getElementById("pwd2").value;
    if (pwd1 !== pwd2) {
        alert("Invalid password");
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