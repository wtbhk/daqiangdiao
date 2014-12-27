$(document).ready(function () {
    //模态框
    var modal = $('#modal');
    if(true) modal.show();
    $('#modalClose').add('#mask').on('click', function () {
        modal.hide();
    });
});