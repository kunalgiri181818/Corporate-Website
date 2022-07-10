<?php

if ( !defined( 'ABSPATH' ) ) {
    die( 'Direct access forbidden.' );
}

function seosight_default_elementor_options() {

	//if exists, assign to $cpt_support var
	$cpt_support = get_option( 'elementor_cpt_support' );

	//check if option DOESN'T exist in db
	if( ! $cpt_support ) {
		$cpt_support = [ 'page', 'post', 'fw-portfolio' ]; //create array of our default supported post types
		update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
	}

	//if it DOES exist, but portfolio is NOT defined
	else if( ! in_array( 'fw-portfolio', $cpt_support ) ) {
		$cpt_support[] = 'fw-portfolio'; //append to array
		update_option( 'elementor_cpt_support', $cpt_support ); //update database
	}

	//otherwise do nothing, portfolio already exists in elementor_cpt_support option

    // Add support for FontAwesome4
	update_option( 'elementor_load_fa4_shim', 'no' ); //write it to the database

	// Update Default options
	update_option( 'elementor_disable_typography_schemes', 'yes' );
	update_option( 'elementor_disable_color_schemes', 'yes' );

	update_option( 'elementor_scheme_typography', 'a:4:{i:1;a:2:{s:11:"font_family";s:0:"";s:11:"font_weight";s:0:"";}i:2;a:2:{s:11:"font_family";s:0:"";s:11:"font_weight";s:0:"";}i:3;a:2:{s:11:"font_family";s:0:"";s:11:"font_weight";s:0:"";}i:4;a:2:{s:11:"font_family";s:0:"";s:11:"font_weight";s:0:"";}}' );

}
add_action( 'after_switch_theme', 'seosight_default_elementor_options' );
add_action( 'upgrader_process_complete', 'seosight_default_elementor_options', 10, 2);

function seosight_elementor_add_ref_links( $settings ){

	$settings = array_replace_recursive( $settings, [
		'icons'                => [
			'goProURL' => 'https://trk.elementor.com/3814',
		],
		'elementor_site'       => 'https://trk.elementor.com/3814',
		'docs_elementor_site'  => 'https://trk.elementor.com/3814',
		'help_the_content_url' => 'https://trk.elementor.com/3814',
		'help_right_click_url' => 'https://trk.elementor.com/3814',
		'help_flexbox_bc_url'  => 'https://trk.elementor.com/3814',
		'elementPromotionURL'  => 'https://trk.elementor.com/3814',
		'dynamicPromotionURL'  => 'https://trk.elementor.com/3814',
	] );

	return $settings;
};

add_filter( 'elementor/editor/localize_settings', 'seosight_elementor_add_ref_links' );

/*  */
add_filter( 'elementor/frontend/print_google_fonts', '__return_false' );
