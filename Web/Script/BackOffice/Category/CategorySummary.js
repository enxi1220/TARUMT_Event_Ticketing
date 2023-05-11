//author: Ong Yi Chween

$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlCategory/Summary.php',
        null,
        function (success) {
            //console.log(success);
            var category = JSON.parse(success);
            buildDataTable(category);
        }
    )
});

function exportCategoryInCSV(){
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlCategory/ExportCSV.php',
    );
}

function exportCategoryInPDF(){
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlCategory/ExportPDF.php',
    );
}

function preparePostData(categoryId) {
    var category = JSON.stringify({
        categoryId: categoryId
    });
    return category;
}

function buildDataTable(category) {
    $('#category-summary').DataTable({
        //show in desc according to date
        order: [[3, 'desc']],
        data: category,
        columns: [
            {data: "name"},
            {data: "description"},
            {data: "createdBy"},
            {data: "createdDate"},
            {data: "updatedBy"},
            {data: "updatedDate"},
            {
                render: function (data, type, row, meta) {
                    var html = `
                            <a class="btn btn-secondary btn-floating" title="View" href="CategoryRead.php?categoryId=${row.categoryId}" role="button">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn btn-secondary btn-floating" title="Update" href="CategoryUpdate.php?categoryId=${row.categoryId}" role="button">
                                <i class="fas fa-pen-to-square"></i>
                            </a>`;
                    return html;
                },
                orderable: false
            }
        ]
    });
}

