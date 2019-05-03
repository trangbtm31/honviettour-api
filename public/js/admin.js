$(function() {

})

function checkCategory() {
    $('#code').closest('.form-group').hide();
    $('#expire_date').closest('.form-group').hide();
    $('.category').on('change', function() {
        if($(this).val() == 1) {
            $('#code').closest('.form-group').show();
            $('#expire_date').closest('.form-group').show();
        } else {
            $('#code').closest('.form-group').hide();
            $('#expire_date').closest('.form-group').hide();
        }
    })
}

