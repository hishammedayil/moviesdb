(function($) {
    $('#movie_genres').multiselect({
        nonSelectedText: 'Select genre',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth: '100%',
        buttonClass: 'border form-control text-left',
        maxHeight: '200',
        numberDisplayed: 6,
        buttonTextAlignment: 'left'
    });
})(jQuery);
