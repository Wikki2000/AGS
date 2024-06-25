$(document).ready(function () {
    loadTable();

    // Event delegation for dynamically loaded delete buttons
    $("body").on("click", ".delBtn", function(event) {
        event.preventDefault();
        const form = $(this).closest("form"); // Get the closest form element
        deleteTable(form); // Pass the form to the deleteTable function
    });

    $("#form").submit(function (event) {
        event.preventDefault();
        notifyUser(this, "../back_end/create_table.php"); // Pass the form context to the function
    });
});

function deleteTable(form) {
    $.ajax({
        url: form.attr("action"), // Get the action URL from the form
        method: "POST",
        dataType: "json",
        data: form.serialize(), // Serialize the form data
        success: function(data) {
            alert(data.message);
            loadTable(); // Reload the table after deletion
        },
        error: function(xhr, status, error) {
            console.error("Error:", status, error);
        }
    });
}

function loadTable() {
    $.ajax({
        url: "../back_end/display_table.php",
        method: "POST",
        dataType: "json",
        success: function (arrayObject) {
            const tb = $("tbody");
            tb.empty(); // Clear existing data in the table body
            
            // Iterate over each student in the received array
            $.each(arrayObject, function (index, table) {
                const name = table.table_name.split("_")[2];
                const row = `<tr>
                    <td>${index + 1}.</td>
                    <td>${name}</td>
                    <td>
                        <div>
                            <button href='#' class='btn btn-primary'>Select</button>
                            <a href='../back_end/edit_tb_name.php?tb_name=${table.table_name}' class='btn btn-primary'>Edit</a>
                            <form action='../back_end/table_operation.php' method='POST'>
                                <input name='tb_name' value='${table.table_name}' type='hidden'>
                                <input name='action' value='delete' type='hidden'>
                                <button type='submit' class='btn btn-danger delBtn'>Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>`;

                // Append the new row to the table body
                tb.append(row);
            });
        },
        error: function (xhr, status, error) {
            console.error("Error fetching data:", error);
        }
    });
}

function notifyUser(form, url) {
    $.ajax({
        url: url,
        method: "POST",
        data: $(form).serialize(), // Serialize the form data passed as an argument
        dataType: "json",
        success: function (response) {
            alert(response.message);
            loadTable(); // Reload the table after creation
        },
        error: function (xhr, status, error) {
            alert("Error: " + error);
        }
    });
}
