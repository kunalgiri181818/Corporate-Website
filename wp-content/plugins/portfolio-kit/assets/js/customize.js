( function( $ ) {
    // Post loop
    wp.customize(
        'pk_settings_loop_primary',
        function ( value ) {
            value.bind(function (newval) {
                $('html:root').css({"--pk-main-color": newval});
            });
        }
    );
    wp.customize(
        'pk_settings_loop_secondary',
        function ( value ) {
            value.bind(function (newval) {
                $('html:root').css({"--pk-single-bg": newval});
            });
        }
    );

    // Single post
    wp.customize(
        'pk_settings_single_padding_top',
        function ( value ) {
            value.bind(function (newval) {
                $('.pk-single-cont').css('padding-top', newval + 'px');
            });
        }
    );

    wp.customize(
        'pk_settings_single_padding_bottom',
        function ( value ) {
            value.bind(function (newval) {
                $('.pk-single-cont').css('padding-bottom', newval + 'px');
            });
        }
    );

    wp.customize(
        'pk_settings_single_background',
        function ( value ) {
            value.bind(function (newval) {
                $('.pk-single-cont').css({"backgroundColor": newval});
            });
        }
    );
}(jQuery));
