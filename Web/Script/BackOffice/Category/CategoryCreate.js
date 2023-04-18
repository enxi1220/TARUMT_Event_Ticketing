//author: Ong Yi Chween

$(document).ready(function () {
    $(`#form-add-category`).submit(function (event) {
        event.preventDefault();
        if ($(`#form-add-category`)[0].checkValidity()) {
            var category = preparePostData();
            console.log(category);
            post(
                '/TARUMT_Event_Ticketing/Controller/CtrlCategory/Create.php',
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
        name: $('#txt-name').val(),
        description: $('#txt-description').val()
    });

    return category;
}


