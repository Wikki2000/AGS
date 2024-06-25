/**
 * Checks if the user is already logged in.
 * @param {string} url - The URL of the PHP file that checks session.
 */
function check_session(url) {
    $.ajax({
        url: url,
        method: "POST",
        dataType: "json",
        success: function (response) {
            if (response.loggedIn) {
                window.location.href = response.redirect;
            }
        },
        error: function (xhr, status, error) {
            alert(`Error: ${error}`);
        }
    });
}

/**
 * Sends an AJAX request for login.
 * @param {string} url - The URL of the PHP file that handles login.
 */
function ajax_request(url) {
    $("#form").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: url,
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                alert(response.message);
                if (response.redirect) {
                    window.location.href = response.redirect;
                }
            },
            error: function (xhr, status, error) {
                alert(`Error: ${error}`);
            }
        });
    });
}
