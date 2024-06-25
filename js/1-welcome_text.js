function typeLetter(text, i) {
    if (i < text.length) {
        $("#welcome").append(text[i]);  // Append each character
        setTimeout(function () {
            typeLetter(text, i + 1);  // Call the function recursively
        }, 200);  // Delay in milliseconds
    }
}

function get_name () {
    $.ajax({
        url: "../back_end/session_data.php",
        method: "POST",
        dataType: "json",
        success: function (response) {
            $("#welcome").append("Welcome " + response.name + "!");
            const text = $("#welcome").text();
            $("#welcome").empty();
            typeLetter(text, 0);
        },
        error: function (xhr, status, error) {
            alert(`Error: ${error}`);
        }
    });
}