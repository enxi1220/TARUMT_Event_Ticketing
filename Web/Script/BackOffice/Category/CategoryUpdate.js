//author: Ong Yi Chween

$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlCategory/Read.php',
        { categoryId: new URLSearchParams(window.location.search).get('categoryId') },
        function (success) {
            var category = JSON.parse(success);
            display(category);
        }
    );

    $(`#form-edit-category`).submit(function (event) {
        event.preventDefault();
        if ($(`#form-edit-category`)[0].checkValidity()) {
            var category = preparePostData();
            console.log(category);
            post(
                '/TARUMT_Event_Ticketing/Controller/CtrlCategory/Update.php',
                [
                    submitData('category', category)
                ],
                null,
                function () {
                    location.href = "CategorySummary.php";
                }
            );
        }
    });
});

function preparePostData() {
    var category = JSON.stringify({
        categoryId: new URLSearchParams(window.location.search).get('categoryId'),
        name: $('#txt-name').val(),
        description: $('#txt-description').val()
    });

    return category;
}

function display(category) {
    
    $('#txt-name').val(category.name);
    $('#txt-description').val(category.description);
    
}