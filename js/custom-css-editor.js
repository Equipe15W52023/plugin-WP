jQuery(document).ready(function($) {
    $('#custom-css').on('change keyup', function() {
        var customCss = $(this).val();
        $('style#custom-css-styles').remove();
        $('head').append('<style id="custom-css-styles">' + customCss + '</style>');
    });
});