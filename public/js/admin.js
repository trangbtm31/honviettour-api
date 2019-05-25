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

// upload image to storage, return the image url
function preprocesImage(img) {
    var data = new FormData(),
        $this = $(this);
    data.append('image', img[0]);
    $.ajax({
        headers: {
             'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        type: 'POST',
        url: baseUrl + '/uploadImage',
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        success: function(url) {
            var img = $('<img>').attr('src', url);
            $this.summernote("insertNode", img[0]);
        },
        error: function(err) {
            console.log(err);
        }
    });
}

function bindSelect2() {
    if(!$('.select2-element').length) {
        console.log('No select2 element.');
        return false;
    }
    $('.select2-element').show().select2({
        allowClear: true,
        placeholder: {
            id: '',
            // text: 'Plans',
        },
        formatResult: function(data) {
            var originalOption = data.element;
            return '<img class="select2-option-image" src="' + $(originalOption).data('img') + '"/><span>' + $(originalOption).text() + '</span>';
        },
        formatSelection: function(data) {
            var originalOption = data.element;
            // var value = $(originalOption).val();
            var formatted = '<div class="select2-selected-item">';
            formatted += '<img class="select2-selected-image" src="' + $(originalOption).data('img') + '"/>';
            formatted += '<span>' + $(originalOption).text() + '</span>';
            formatted += '<span class="fa fa-times remove"></span>';
            formatted += '</div>';
            formatted += '<div class="select2-selected-description collapse clearfix">';
            formatted += '<img class="select2-selected-image big" src="' + $(originalOption).data('img') + '"/>';
            formatted += '<div class="meta-wrapper">';
            formatted += '<div class="heading clearfix"><b> ' + $(originalOption).data('date') + ' </b></div>';
            formatted += '<div class="des-item">';
            formatted += '<b>' + $(originalOption).data('title-en') + '</b><p>' + $(originalOption).data('des-en') + '</p>';
            formatted += '</div>';
            formatted += '<div class="des-item">';
            formatted += '<b>' + $(originalOption).data('title-vi') + '</b><p>' + $(originalOption).data('des-vi') + '</p>';
            formatted += '</div>';
            formatted += '</div>';

            return formatted;
        }
    })

    $('.select2-selected-item .remove').click(function() {
        var target = $(this).closest('.select2-search-choice').find('.select2-search-choice-close');
        target.trigger('click');
        return false;
    })
}