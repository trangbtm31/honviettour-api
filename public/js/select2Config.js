$(function() {
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
                var formatted = '<div class="select2-selected-item">';
                formatted += '<img class="select2-selected-image" src="' + $(originalOption).data('img') + '"/>';
                formatted += '<span>' + $(originalOption).text() + '</span>';
                formatted += '</div>';
                formatted += '<div class="select2-selected-description clearfix">';
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
                // return '<div class="select2-selected-item"><img class="select2-selected-image" src="' + $(originalOption).data('img') + '"/><span>' + $(originalOption).text() + '</span></div><div class="select2-selected-description clearfix"><img class="select2-selected-image big" src="' + $(originalOption).data('img') + '"/><div class="meta-wrapper"> <div class="des-item"><b>' + $(originalOption).data('title-en') + '</b><p>' + $(originalOption).data('des-en') + '</p></div> <div class="des-item"><b>' + $(originalOption).data('title-vi') + '</b><p>' + $(originalOption).data('des-vi') + '</p></div> </div>';
            }
        })
        // $('.select2-element').show();
});