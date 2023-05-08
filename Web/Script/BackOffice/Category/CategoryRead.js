//author: Ong Yi Chween

$(document).ready(function () {
    get(
        '/TARUMT_Event_Ticketing/Controller/CtrlCategory/Read.php',
        { categoryId: new URLSearchParams(window.location.search).get('categoryId') },
        function (success) {
            var category = JSON.parse(success);
            display(category);
        }
    )
});

function display(category) {
    $('#txt-name').val(category.name);
    $('#txt-description').val(category.description);
}
