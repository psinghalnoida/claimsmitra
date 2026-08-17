$(document).ready(function(){
    $("#assessment_modal").click(function(){
        $("#assessmentModal").modal("show");
    });


   
});

$(document).ready(function () {
    // Add row before
    $("#addRowBefore").click(function () {
        let newRow = "<tr>";
        newRow += '<td contenteditable="true">New</td>';
        $("#editableTable thead tr:eq(1) th").each(function () {
            newRow += '<td contenteditable="true">New Cell</td>';
        });
        newRow += `<td><button class="removeRow">❌ Remove</button></td>`;
        newRow += "</tr>";
        $("tbody").prepend(newRow);
    });

    // Add row after
    $("#addRowAfter").click(function () {
        let newRow = "<tr>";
        newRow += '<td contenteditable="true">New</td>';
        $("#editableTable thead tr:eq(1) th").each(function () {
            newRow += '<td contenteditable="true">New Cell</td>';
        });
        newRow += `<td><button class="removeRow">❌ Remove</button></td>`;
        newRow += "</tr>";
        $("tbody").append(newRow);
    });

    // Remove row
    $(document).on("click", ".removeRow", function () {
        $(this).closest("tr").remove();
    });

    // Add column dynamically
    $("#addColumn").click(function () {
        let columnName = prompt("Enter column name:");
        if (columnName) {
            $("#editableTable thead tr:eq(0)").append(`<th>${columnName}</th>`);
            $("#editableTable thead tr:eq(1)").append(`<th>${columnName}</th>`);
            $("#editableTable tbody tr").each(function () {
                $(this).append('<td contenteditable="true">0</td>');
            });
        }
    });
});