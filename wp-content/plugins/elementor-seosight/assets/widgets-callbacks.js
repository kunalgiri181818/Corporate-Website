
elementor.hooks.addAction( 'panel/open_editor/widget', function( panel, model, view ) {
    if ( 'section' !== model.elType && 'column' !== model.elType ) {
        return;
    }
    var $element = view.$el.find( '.pie-chart' );

    if ( $element.length ) {
        CRUMINA.pieCharts();
    }
} );
