<?php
/**
 * Elementor Seosight Functions
 *
 * Functions for determining the current query/page.
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* List of button color variations for options;
*
* @return array
*/
function es_button_colors() {
	$colors = [
		'primary'     => esc_html__( 'Primary color', 'elementor-seosight' ),
		'secondary'   => esc_html__( 'Secondary color', 'elementor-seosight' ),
		'white'       => esc_html__( 'White', 'elementor-seosight' ),
		'dark'        => esc_html__( 'Dark', 'elementor-seosight' ),
		'gray'        => esc_html__( 'Gray', 'elementor-seosight' ),
		'blue'        => esc_html__( 'Blue', 'elementor-seosight' ),
		'purple'      => esc_html__( 'Purple', 'elementor-seosight' ),
		'breez'       => esc_html__( 'Breez', 'elementor-seosight' ),
		'orange'      => esc_html__( 'Orange', 'elementor-seosight' ),
		'yellow'      => esc_html__( 'Yellow', 'elementor-seosight' ),
		'green'       => esc_html__( 'Green', 'elementor-seosight' ),
		'dark-gray'   => esc_html__( 'Dark gray', 'elementor-seosight' ),
		'brown'       => esc_html__( 'Brown', 'elementor-seosight' ),
		'rose'        => esc_html__( 'Rose', 'elementor-seosight' ),
		'violet'      => esc_html__( 'Violet', 'elementor-seosight' ),
		'olive'       => esc_html__( 'Olive', 'elementor-seosight' ),
		'light-green' => esc_html__( 'Light green', 'elementor-seosight' ),
		'dark-blue'   => esc_html__( 'Dark blue', 'elementor-seosight' ),
	];

	return $colors;
}

/**
* Echo data
*/
function es_render() {
	foreach ( func_get_args() as $arg ) {
		echo "{$arg}";
	}
}

/**
*
*/
function es_post_taxonomy(){
	$post_types = get_post_types( [ 'public' => true, '_builtin' => false ] );
	$post_types = array_merge( [ 'post' => 'post' ], $post_types );

	$args = [];
	foreach ( $post_types as $post_type ) {
		$taxonomy_objects = get_object_taxonomies( $post_type, 'objects' );
		$taxonomy         = key( $taxonomy_objects );
		$args[ $post_type ] = es_get_terms( $taxonomy, 'slug' );
	}
	return $args;
}

/**
*
*/
function es_get_terms( $tax = 'category', $key = 'id' ) {
	$terms = [];
	
	$get_terms = (array) get_terms( $tax, [ 'hide_empty' => false ] );
	if ( $key == 'id' ){
		foreach ( $get_terms as $term ){
			if ( isset( $term->term_id ) && isset( $term->name ) ) {
				$terms[ $term->term_id ] = $term->name;
			}
		}
	} else if ( $key == 'slug' ){
		foreach ( $get_terms as $term ){
			if ( isset( $term->slug ) && isset( $term->name ) ) {
				$terms[ $term->slug ] = $term->name;
			}
		}
	}
	return $terms;
}

/*
*
*/
function es_get_fw_options( $post_id = '', $key = '', $metadata = 'post' ){
	if ( ! $post_id || ! $key ) {
		return false;
	}
	if ( $metadata = 'post' ) {
		$options = get_post_meta( $post_id, 'fw_options', true );
		return isset( $options[ $key ] ) ? $options[ $key ] : false;
	}
	return false;
}

/*
*
*/
function es_resize( $url, $width = false, $height = false, $crop = false ) {
	$es_resize = ES_Resize::getInstance();
	$response  = $es_resize->process( $url, $width, $height, $crop );

	return ( ! is_wp_error( $response ) && ! empty( $response['src'] ) ) ? $response['src'] : $url;
}

/*
*
*/
function es_get_align( $align = 'center' ) {
	if ( $align == 'left') {
		$return = 'align="left"';
	} else if ( $align == 'right') {
		$return = 'align="right"';
	} else if ( $align == 'justify') {
		$return = 'align="justify"';
	} else {
		$return = 'align="center"';
	}
    return $return;
}

/*
*
*/
function es_show_oembed( $video_link = '' ) {
	$youtube_id = $vimeo_id = '';
	if ( preg_match( "/(youtube.com)/", $video_link ) ) {
		$video_id   = explode( "v=", preg_replace( "/(&)+(.*)/", null, $video_link ) );
		$youtube_id = $video_id[1];
	} elseif ( preg_match( "/(youtu.be)/", $video_link ) ) {
		$video_id   = explode( "/", preg_replace( "/(&)+(.*)/", null, $video_link ) );
		$youtube_id = $video_id[3];
	} elseif ( preg_match( "/(vimeo.com)/", $video_link ) ) {
		$regexstr = '/https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/';
		preg_match( $regexstr, $video_link, $matches );
		$vimeo_id = $matches[3];
	}

	if ( $youtube_id ) {
		echo '<div data-video-id="' . $youtube_id . '" data-type="youtube"></div>';
	} elseif ( $vimeo_id ) {
		echo '<div data-video-id="' . $vimeo_id . '" data-type="vimeo"></div>';
	}
}

/**
* Custom styles for map shortcode
*/
function es_google_map_custom_styles() {
	return [
		'default' => [
			esc_html__( 'Default', 'elementor-seosight' ),
			""
		],
		'dark' => [
			esc_html__( 'Dark', 'elementor-seosight' ),
			"[{'featureType':'all','elementType':'labels.text.fill','stylers':[{'saturation':36},{'color':'#000000'},{'lightness':40}]},{'featureType':'all','elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#000000'},{'lightness':16}]},{'featureType':'all','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':17},{'weight':1.2}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':21}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':17}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':29},{'weight':0.2}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':18}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':16}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':19}]},{'featureType':'water','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':17}]}]"
		],
		'omni' => [
			esc_html__( 'Omni', 'elementor-seosight' ),
			"[{'featureType':'landscape','stylers':[{'saturation':-100},{'lightness':65},{'visibility':'on'}]},{'featureType':'poi','stylers':[{'saturation':-100},{'lightness':51},{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'saturation':-100},{'visibility':'simplified'}]},{'featureType':'road.arterial','stylers':[{'saturation':-100},{'lightness':30},{'visibility':'on'}]},{'featureType':'road.local','stylers':[{'saturation':-100},{'lightness':40},{'visibility':'on'}]},{'featureType':'transit','stylers':[{'saturation':-100},{'visibility':'simplified'}]},{'featureType':'administrative.province','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'labels','stylers':[{'visibility':'on'},{'lightness':-25},{'saturation':-100}]},{'featureType':'water','elementType':'geometry','stylers':[{'hue':'#ffff00'},{'lightness':-25},{'saturation':-97}]}]"
		],
		'coy-beauty' => [
			esc_html__( 'Coy Beauty', 'elementor-seosight' ),
			"[{'featureType':'all','elementType':'geometry.stroke','stylers':[{'visibility':'simplified'}]},{'featureType':'administrative','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'labels','stylers':[{'visibility':'simplified'},{'color':'#a31645'}]},{'featureType':'landscape','elementType':'all','stylers':[{'weight':'3.79'},{'visibility':'on'},{'color':'#ffecf0'}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'visibility':'on'}]},{'featureType':'landscape','elementType':'geometry.stroke','stylers':[{'visibility':'on'}]},{'featureType':'poi','elementType':'all','stylers':[{'visibility':'simplified'},{'color':'#a31645'}]},{'featureType':'poi','elementType':'geometry','stylers':[{'saturation':'0'},{'lightness':'0'},{'visibility':'off'}]},{'featureType':'poi','elementType':'geometry.stroke','stylers':[{'visibility':'off'}]},{'featureType':'poi.business','elementType':'all','stylers':[{'visibility':'simplified'},{'color':'#d89ca8'}]},{'featureType':'poi.business','elementType':'geometry','stylers':[{'visibility':'on'}]},{'featureType':'poi.business','elementType':'geometry.fill','stylers':[{'visibility':'on'},{'saturation':'0'}]},{'featureType':'poi.business','elementType':'labels','stylers':[{'color':'#a31645'}]},{'featureType':'poi.business','elementType':'labels.icon','stylers':[{'visibility':'simplified'},{'lightness':'84'}]},{'featureType':'road','elementType':'all','stylers':[{'saturation':-100},{'lightness':45}]},{'featureType':'road.highway','elementType':'all','stylers':[{'visibility':'simplified'}]},{'featureType':'road.arterial','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'all','stylers':[{'color':'#d89ca8'},{'visibility':'on'}]},{'featureType':'water','elementType':'geometry.fill','stylers':[{'visibility':'on'},{'color':'#fedce3'}]},{'featureType':'water','elementType':'labels','stylers':[{'visibility':'off'}]}]"
		],
		'subtle-grayscale' => [
			esc_html__( 'Subtle Grayscale', 'elementor-seosight' ),
			"[{'featureType':'landscape','stylers':[{'saturation':-100},{'lightness':65},{'visibility':'on'}]},{'featureType':'poi','stylers':[{'saturation':-100},{'lightness':51},{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'saturation':-100},{'visibility':'simplified'}]},{'featureType':'road.arterial','stylers':[{'saturation':-100},{'lightness':30},{'visibility':'on'}]},{'featureType':'road.local','stylers':[{'saturation':-100},{'lightness':40},{'visibility':'on'}]},{'featureType':'transit','stylers':[{'saturation':-100},{'visibility':'simplified'}]},{'featureType':'administrative.province','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'labels','stylers':[{'visibility':'on'},{'lightness':-25},{'saturation':-100}]},{'featureType':'water','elementType':'geometry','stylers':[{'hue':'#ffff00'},{'lightness':-25},{'saturation':-97}]}]"
		],
		'pale-dawn' => [
			esc_html__( 'Pale Dawn', 'elementor-seosight' ),
			"[{'featureType':'water','stylers':[{'visibility':'on'},{'color':'#acbcc9'}]},{'featureType':'landscape','stylers':[{'color':'#f2e5d4'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'color':'#c5c6c6'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#e4d7c6'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#fbfaf7'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#c5dac6'}]},{'featureType':'administrative','stylers':[{'visibility':'on'},{'lightness':33}]},{'featureType':'road'},{'featureType':'poi.park','elementType':'labels','stylers':[{'visibility':'on'},{'lightness':20}]},{},{'featureType':'road','stylers':[{'lightness':20}]}]"
		],
		'blue-water' => [
			esc_html__( 'Blue water', 'elementor-seosight' ),
			"[{'featureType':'water','stylers':[{'color':'#46bcec'},{'visibility':'on'}]},{'featureType':'landscape','stylers':[{'color':'#f2f2f2'}]},{'featureType':'road','stylers':[{'saturation':-100},{'lightness':45}]},{'featureType':'road.highway','stylers':[{'visibility':'simplified'}]},{'featureType':'road.arterial','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'labels.text.fill','stylers':[{'color':'#444444'}]},{'featureType':'transit','stylers':[{'visibility':'off'}]},{'featureType':'poi','stylers':[{'visibility':'off'}]}]"
		],
		'shades-of-grey' => [
			esc_html__( 'Shades of Grey', 'elementor-seosight' ),
			"[{'featureType':'water','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':17}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':17}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':29},{'weight':0.2}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':18}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':16}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':21}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#000000'},{'lightness':16}]},{'elementType':'labels.text.fill','stylers':[{'saturation':36},{'color':'#000000'},{'lightness':40}]},{'elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':19}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':17},{'weight':1.2}]}]"
		],
		'midnight-commander' => [
			esc_html__( 'Midnight Commander', 'elementor-seosight' ),
			"[{'featureType':'water','stylers':[{'color':'#021019'}]},{'featureType':'landscape','stylers':[{'color':'#08304b'}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#0c4152'},{'lightness':5}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#000000'}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#0b434f'},{'lightness':25}]},{'featureType':'road.arterial','elementType':'geometry.fill','stylers':[{'color':'#000000'}]},{'featureType':'road.arterial','elementType':'geometry.stroke','stylers':[{'color':'#0b3d51'},{'lightness':16}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#000000'}]},{'elementType':'labels.text.fill','stylers':[{'color':'#ffffff'}]},{'elementType':'labels.text.stroke','stylers':[{'color':'#000000'},{'lightness':13}]},{'featureType':'transit','stylers':[{'color':'#146474'}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#000000'}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#144b53'},{'lightness':14},{'weight':1.4}]}]"
		],
		'retro' => [
			esc_html__( 'Retro', 'elementor-seosight' ),
			"[{'featureType':'administrative','stylers':[{'visibility':'off'}]},{'featureType':'poi','stylers':[{'visibility':'simplified'}]},{'featureType':'road','elementType':'labels','stylers':[{'visibility':'simplified'}]},{'featureType':'water','stylers':[{'visibility':'simplified'}]},{'featureType':'transit','stylers':[{'visibility':'simplified'}]},{'featureType':'landscape','stylers':[{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'visibility':'off'}]},{'featureType':'road.local','stylers':[{'visibility':'on'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'visibility':'on'}]},{'featureType':'water','stylers':[{'color':'#84afa3'},{'lightness':52}]},{'stylers':[{'saturation':-17},{'gamma':0.36}]},{'featureType':'transit.line','elementType':'geometry','stylers':[{'color':'#3f518c'}]}]"
		],
		'light-monochrome' => [
			esc_html__( 'Light Monochrome', 'elementor-seosight' ),
			"[{'featureType':'water','elementType':'all','stylers':[{'hue':'#e9ebed'},{'saturation':-78},{'lightness':67},{'visibility':'simplified'}]},{'featureType':'landscape','elementType':'all','stylers':[{'hue':'#ffffff'},{'saturation':-100},{'lightness':100},{'visibility':'simplified'}]},{'featureType':'road','elementType':'geometry','stylers':[{'hue':'#bbc0c4'},{'saturation':-93},{'lightness':31},{'visibility':'simplified'}]},{'featureType':'poi','elementType':'all','stylers':[{'hue':'#ffffff'},{'saturation':-100},{'lightness':100},{'visibility':'off'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'hue':'#e9ebed'},{'saturation':-90},{'lightness':-8},{'visibility':'simplified'}]},{'featureType':'transit','elementType':'all','stylers':[{'hue':'#e9ebed'},{'saturation':10},{'lightness':69},{'visibility':'on'}]},{'featureType':'administrative.locality','elementType':'all','stylers':[{'hue':'#2c2e33'},{'saturation':7},{'lightness':19},{'visibility':'on'}]},{'featureType':'road','elementType':'labels','stylers':[{'hue':'#bbc0c4'},{'saturation':-93},{'lightness':31},{'visibility':'on'}]},{'featureType':'road.arterial','elementType':'labels','stylers':[{'hue':'#bbc0c4'},{'saturation':-93},{'lightness':-2},{'visibility':'simplified'}]}]"
		],
		'paper' => [
			esc_html__( 'Paper', 'elementor-seosight' ),
			"[{'featureType':'administrative','stylers':[{'visibility':'off'}]},{'featureType':'poi','stylers':[{'visibility':'simplified'}]},{'featureType':'road','stylers':[{'visibility':'simplified'}]},{'featureType':'water','stylers':[{'visibility':'simplified'}]},{'featureType':'transit','stylers':[{'visibility':'simplified'}]},{'featureType':'landscape','stylers':[{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'visibility':'off'}]},{'featureType':'road.local','stylers':[{'visibility':'on'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'visibility':'on'}]},{'featureType':'road.arterial','stylers':[{'visibility':'off'}]},{'featureType':'water','stylers':[{'color':'#5f94ff'},{'lightness':26},{'gamma':5.86}]},{},{'featureType':'road.highway','stylers':[{'weight':0.6},{'saturation':-85},{'lightness':61}]},{'featureType':'road'},{},{'featureType':'landscape','stylers':[{'hue':'#0066ff'},{'saturation':74},{'lightness':100}]}]"
		],
		'gowalla' => [
			esc_html__( 'Gowalla', 'elementor-seosight' ),
			"[{'featureType':'road','elementType':'labels','stylers':[{'visibility':'simplified'},{'lightness':20}]},{'featureType':'administrative.land_parcel','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'landscape.man_made','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'road.local','elementType':'labels','stylers':[{'visibility':'simplified'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'visibility':'simplified'}]},{'featureType':'road.highway','elementType':'labels','stylers':[{'visibility':'simplified'}]},{'featureType':'poi','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'road.arterial','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'all','stylers':[{'hue':'#a1cdfc'},{'saturation':30},{'lightness':49}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'hue':'#f49935'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'hue':'#fad959'}]}]"
		],
		'greyscale' => [
			esc_html__( 'Greyscale', 'elementor-seosight' ),
			"[{'featureType':'all','stylers':[{'saturation':-100},{'gamma':0.5}]}]"
		],
		'apple-maps-esque' => [
			esc_html__( 'Apple Maps-esque', 'elementor-seosight' ),
			"[{'featureType':'water','elementType':'geometry','stylers':[{'color':'#a2daf2'}]},{'featureType':'landscape.man_made','elementType':'geometry','stylers':[{'color':'#f7f1df'}]},{'featureType':'landscape.natural','elementType':'geometry','stylers':[{'color':'#d0e3b4'}]},{'featureType':'landscape.natural.terrain','elementType':'geometry','stylers':[{'visibility':'off'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#bde6ab'}]},{'featureType':'poi','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'poi.medical','elementType':'geometry','stylers':[{'color':'#fbd3da'}]},{'featureType':'poi.business','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'geometry.stroke','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#ffe15f'}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#efd151'}]},{'featureType':'road.arterial','elementType':'geometry.fill','stylers':[{'color':'#ffffff'}]},{'featureType':'road.local','elementType':'geometry.fill','stylers':[{'color':'black'}]},{'featureType':'transit.station.airport','elementType':'geometry.fill','stylers':[{'color':'#cfb2db'}]}]"
		],
		'subtle' => [
			esc_html__( 'Subtle', 'elementor-seosight' ),
			"[{'featureType':'poi','stylers':[{'visibility':'off'}]},{'stylers':[{'saturation':-70},{'lightness':37},{'gamma':1.15}]},{'elementType':'labels','stylers':[{'gamma':0.26},{'visibility':'off'}]},{'featureType':'road','stylers':[{'lightness':0},{'saturation':0},{'hue':'#ffffff'},{'gamma':0}]},{'featureType':'road','elementType':'labels.text.stroke','stylers':[{'visibility':'off'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'lightness':20}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'lightness':50},{'saturation':0},{'hue':'#ffffff'}]},{'featureType':'administrative.province','stylers':[{'visibility':'on'},{'lightness':-50}]},{'featureType':'administrative.province','elementType':'labels.text.stroke','stylers':[{'visibility':'off'}]},{'featureType':'administrative.province','elementType':'labels.text','stylers':[{'lightness':20}]}]"
		],
		'neutral-blue' => [
			esc_html__( 'Neutral Blue', 'elementor-seosight' ),
			"[{'featureType':'water','elementType':'geometry','stylers':[{'color':'#193341'}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'color':'#2c5a71'}]},{'featureType':'road','elementType':'geometry','stylers':[{'color':'#29768a'},{'lightness':-37}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#406d80'}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#406d80'}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#3e606f'},{'weight':2},{'gamma':0.84}]},{'elementType':'labels.text.fill','stylers':[{'color':'#ffffff'}]},{'featureType':'administrative','elementType':'geometry','stylers':[{'weight':0.6},{'color':'#1a3541'}]},{'elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#2c5a71'}]}]"
		],
		'flat-map' => [
			esc_html__( 'Flat Map', 'elementor-seosight' ),
			"[{'stylers':[{'visibility':'off'}]},{'featureType':'road','stylers':[{'visibility':'on'},{'color':'#ffffff'}]},{'featureType':'road.arterial','stylers':[{'visibility':'on'},{'color':'#fee379'}]},{'featureType':'road.highway','stylers':[{'visibility':'on'},{'color':'#fee379'}]},{'featureType':'landscape','stylers':[{'visibility':'on'},{'color':'#f3f4f4'}]},{'featureType':'water','stylers':[{'visibility':'on'},{'color':'#7fc8ed'}]},{},{'featureType':'road','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'poi.park','elementType':'geometry.fill','stylers':[{'visibility':'on'},{'color':'#83cead'}]},{'elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'landscape.man_made','elementType':'geometry','stylers':[{'weight':0.9},{'visibility':'off'}]}]"
		],
		'shift-worker' => [
			esc_html__( 'Shift Worker', 'elementor-seosight' ),
			"[{'stylers':[{'saturation':-100},{'gamma':1}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'off'}]},{'featureType':'poi.business','elementType':'labels.text','stylers':[{'visibility':'off'}]},{'featureType':'poi.business','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'poi.place_of_worship','elementType':'labels.text','stylers':[{'visibility':'off'}]},{'featureType':'poi.place_of_worship','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'geometry','stylers':[{'visibility':'simplified'}]},{'featureType':'water','stylers':[{'visibility':'on'},{'saturation':50},{'gamma':0},{'hue':'#50a5d1'}]},{'featureType':'administrative.neighborhood','elementType':'labels.text.fill','stylers':[{'color':'#333333'}]},{'featureType':'road.local','elementType':'labels.text','stylers':[{'weight':0.5},{'color':'#333333'}]},{'featureType':'transit.station','elementType':'labels.icon','stylers':[{'gamma':1},{'saturation':50}]}]"
		],
	];
}

/**
* Generate attributes string for html tag
*
*/
function es_attr_to_html( array $attr_array ) {
	$html_attr = '';
	foreach ( $attr_array as $attr_name => $attr_val ) {
		if ( $attr_val === false ) {
			continue;
		}
		$html_attr.= $attr_name . '="' . es_htmlspecialchars( $attr_val ) . '" ';
	}
	return $html_attr;
}

/**
* Use this id do not want to enter every time same last two parameters
* Info: Cannot use default parameters because in php 5.2 encoding is not UTF-8 by default
*/
function es_htmlspecialchars( $string ) {
	return htmlspecialchars( $string, ENT_QUOTES, 'UTF-8' );
}

/**
* List of social networks names with file names for options;
*
*/
function es_social_network_icons() {
	$networks = array(
		'amazon.svg'          => 'Amazon',
		'behance.svg'         => 'Behance',
		'bing.svg'            => 'Bing',
		'creative-market.svg' => 'Creative Market',
		'deviantart.svg'      => 'Deviantart',
		'dribbble.svg'        => 'Dribbble',
		'dropbox.svg'         => 'Dropbox',
		'envato.svg'          => 'Envato',
		'facebook.svg'        => 'Facebook',
		'flickr.svg'          => 'Flickr',
		'google-plus.svg'     => 'Google+',
		'instagram.svg'       => 'Instagram',
		'kickstarter.svg'     => 'Kickstarter',
		'linkedin.svg'        => 'Linkedin',
		'medium.svg'          => 'Medium',
		'periscope.svg'       => 'Periscope',
		'pinterest.svg'       => 'Pinterest',
		'quora.svg'           => 'Quora',
		'reddit.svg'          => 'Reddit',
		'shutterstock.svg'    => 'Shutterstock',
		'skype.svg'           => 'Skype',
		'slack.svg'           => 'Slack',
		'snapchat.svg'        => 'Snapchat',
		'soundcloud.svg'      => 'Soundcloud',
		'spotify.svg'         => 'Spotify',
		'trello.svg'          => 'Trello',
		'telegram.svg'        => 'Telegram',
		'tumblr.svg'          => 'Tumblr',
		'twitter.svg'         => 'Twitter',
		'vimeo.svg'           => 'Vimeo',
		'vk.svg'              => 'VK.com',
		'whatsapp.svg'        => 'Whatsapp',
		'wikipedia.svg'       => 'Wikipedia',
		'wordpress.svg'       => 'WordPress',
		'youtube.svg'         => 'Youtube',
	);
	return $networks;
}

/**
* Custom template tags for this theme. Eventually, some of the functionality here could be replaced by core features.
*/
function es_posted_time( $icon = true ) {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date  updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() )
    );

    $icon_html = true === $icon ? '<i class="seoicon-clock"></i>' : '';

    return sprintf( '<span class="post__date">' . $icon_html . $time_string . '</span>' );
}

/**
* Generate html markup for post author display.
*/
function es_post_author_avatar( $author_id ) {
    $show_author = get_theme_mod( 'blog-author-show', 'yes' );
    if ( is_single() ) {
        $show_author = get_theme_mod( 'single-author-show', 'yes' );
    }

    if ( ! is_author() && 'yes' === $show_author ) { ?>
        <div class="post__author author vcard">
            <?php echo get_avatar( $author_id, 40 ); ?>
            <div class="post__author-name fn">
                <?php esc_html_e( 'Posted by', 'elementor-seosight' ); ?>
                <a href="<?php echo get_author_posts_url( $author_id ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>" class="post__author-link"><?php the_author_meta( 'display_name', $author_id ); ?></a>
            </div>
        </div>
        <?php
    }
}

/*
*
*/
function es_orderby() {
	return [
    	'date'          => esc_html__( 'Date', 'elementor-seosight' ),
        'ID'            => esc_html__( 'ID', 'elementor-seosight' ),
        'author'        => esc_html__( 'Author', 'elementor-seosight' ),
        'title'         => esc_html__( 'Title', 'elementor-seosight' ),
        'modified'      => esc_html__( 'Modified', 'elementor-seosight' ),
        'rand'          => esc_html__( 'Random', 'elementor-seosight' ),
        'comment_count' => esc_html__( 'Comment count', 'elementor-seosight' ),
        'menu_order'    => esc_html__( 'Menu order', 'elementor-seosight' ),
    ];
}

/*
*
*/
function es_order() {
	return [
        'DESC' => esc_html__( 'Descending', 'elementor-seosight' ),
        'ASC'  => esc_html__( 'Ascending', 'elementor-seosight' ),
    ];
}

/**
* Get lists of categories.
*/
function es_get_category_childs_full( $parent_id, $array, $level, &$dropdown, $param = 'term_id' ) {
    $keys = array_keys( $array );
    $i    = 0;
    while ( $i < count( $array ) ) {
        $key  = $keys[ $i ];
        $item = $array[ $key ];
        $i++;

        if ( $item->category_parent == $parent_id ) {
            $dropdown[ $item->{ $param } ] = str_repeat( '- ', $level ) . __( $item->name ) . ' (' . $item->count . ')';

            unset( $array[ $key ] );
            $array = es_get_category_childs_full( $item->term_id, $array, $level + 1, $dropdown, $param );
            $keys  = array_keys( $array );
            $i     = 0;
        }
    }

    return $array;
}

if ( ! function_exists( 'seosight_html_tag' ) ) {
	/**
	 * Generate html tag
	 *
	 * @param string $tag Tag name.
	 * @param array $attr Tag attributes.
	 * @param bool|string $end Append closing tag. Also accepts body content.
	 *
	 * @return string The tag's html
	 */
	function seosight_html_tag( $tag, $attr = array(), $end = false ) {
		$html = '<' . $tag . ' ' . seosight_attr_to_html( $attr );

		if ( true === $end ) {
			$html .= '></' . $tag . '>';
		} elseif ( false === $end ) {
			$html .= '/>';
		} else {
			$html .= '>' . $end . '</' . $tag . '>';
		}

		return $html;
	}
}