<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Seosight_Maps extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_maps';
	}

	public function get_title() {
		return esc_html__( 'Maps module', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-map';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$all_styles    = es_google_map_custom_styles();
		$style_options = [];
		foreach ( $all_styles as $key => $value ) {
			$style_options[ $key ] = $value[0];
		}

		$this->start_controls_section(
			'seosight_maps',
			[
				'label' => esc_html__( 'Maps module', 'elementor-seosight' ),
			]
		);

		$this->add_control(
            'google_js',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Show JS Google Map', 'elementor-seosight' ),
                'description' => esc_html__( 'Extended options section for show javascript google map.', 'elementor-seosight' ),
                'default'     => 'no',
            ]
        );
        
        $this->add_control(
            'map_location',
            [
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'label'       => esc_html__( 'Map Embed code', 'elementor-seosight' ),
                'description' => sprintf( wp_kses( __( 'Go to <a href="%s" target=_blank>Google Maps</a> and search your Location. Click on menu near search text => Share or embed map => Embed map. Next copy iframe to this field', 'elementor-seosight' ), ['a' => [ 'href' => [] ] ] ), 'https://www.google.com/maps/' ),
                'condition'   => [
					'google_js!' => 'yes',
				],
				'separator'   => 'before'
            ]
        );

		$this->add_control(
			'api_key',
			[
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'API KEY for google maps service', 'elementor-seosight'),
				'description' => sprintf( wp_kses( __( 'Go to <a href="%s">Instruction to create API key</a>', 'elementor-seosight' ), [ 'a' => [ 'href' => [] ] ] ), 'https://developers.google.com/maps/documentation/javascript/get-api-key' ),
				'condition'   => [
					'google_js' => 'yes',
				],
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'address',
			[
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'label'     => esc_html__( 'Type address', 'elementor-seosight' ),
				'condition' => [
					'google_js' => 'yes',
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'map_zoom',
			[
				'type'        => \Elementor\Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Map zoom', 'elementor-seosight' ),
				'description' => esc_html__( 'Work for one address only!', 'elementor-seosight' ),
				'size_units'  => [ 'px' ],
				'range'       => [
					'px' => [
						'min'  => 1,
						'max'  => 21,
						'step' => 1
					]
				],
				'default'     => [
					'size' => 14,
				],
				'condition' => [
					'google_js' => 'yes',
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'map_style',
			[
				'type'      => \Elementor\Controls_Manager::SELECT,
				'label'     => esc_html__( 'Select map style', 'elementor-seosight' ),
				'options'   => $style_options,
				'condition' => [
					'google_js' => 'yes',
				],
				'default' => key( $style_options ),
				'separator' => 'before'
			]
		);

		$this->add_control(
			'map_type',
			[
				'type'      => \Elementor\Controls_Manager::SELECT,
				'label'     => esc_html__( 'Map Type', 'elementor-seosight' ),
				'options'   => [
					'roadmap'   => esc_html__( 'Roadmap', 'elementor-seosight' ),
					'terrain'   => esc_html__( 'Terrain', 'elementor-seosight' ),
					'satellite' => esc_html__( 'Satellite', 'elementor-seosight' ),
					'hybrid'    => esc_html__( 'Hybrid', 'elementor-seosight' )
				],
				'condition' => [
					'google_js' => 'yes',
				],
				'default' => 'roadmap',
				'separator' => 'before'
			]
		);

		$this->add_control(
            'disable_scrolling',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Disable zoom on scroll', 'elementor-seosight' ),
                'description' => esc_html__( 'Prevent the map from zooming when scrolling until clicking on the map', 'elementor-seosight' ),
                'default'     => 'no',
				'condition'   => [
					'google_js' => 'yes',
				],
				'separator'   => 'before'
            ]
        );

        $this->add_control(
            'custom_marker',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Custom map marker', 'elementor-seosight' ),
                'description' => esc_html__( 'Replace default map marker with custom image', 'elementor-seosight' ),
                'default'     => 'no',
				'condition'   => [
					'google_js' => 'yes',
				],
				'separator'   => 'before'
            ]
        );

        $this->add_control(
			'marker',
			[
                'type'        => \Elementor\Controls_Manager::MEDIA,
				'label'       => esc_html__( 'Marker Image', 'elementor-seosight' ),
				'description' => esc_html__( 'Add marker image', 'elementor-seosight' ),
				'condition'   => [
					'google_js'     => 'yes',
					'custom_marker' => 'yes'
				],
				'separator'   => 'before'
			]
        );

        $this->add_control(
			'map_height',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Map Height (px)', 'elementor-seosight'),
				'default'   => 350,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'custom_class',
			[
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Extra class', 'elementor-seosight'),
				'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'elementor-seosight' ),
				'separator'   => 'before'
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$random_id = uniqid( 'gmap-' );
		
		$settings = $this->get_settings_for_display();

		$language   = substr( get_locale(), 0, 2 );
		$api_key    = ! empty( $settings['api_key'] ) ? $settings['api_key'] : '';
		$map_width  = '100%';
		$map_height = ! empty( $settings['map_height'] ) ? $settings['map_height'] : '350px';

		$css_classes = [ 'google-map' ];
		if ( ! empty( $settings['custom_class'] ) ) {
			$css_classes[] = $settings['custom_class'];
		}

		if ( ! empty( $settings['google_js'] ) && $settings['google_js'] == 'yes' ) {
			wp_enqueue_script(
				'google-maps-api-v3',
				'https://maps.googleapis.com/maps/api/js?key=' . $api_key . '&libraries=places&language=' . $language,
				array(),
				'3.15',
				false
			);
			wp_enqueue_script(
				'seosight-shortcode-map-script',
				get_template_directory_uri() . '/js/map-shortcode.js',
				array( 'jquery' ),
				'',
				true
			);
		}

		$map_location = preg_replace( array( '/width="\d+"/i', '/height="\d+"/i' ), array(
			sprintf( 'width="%s"', $map_width ),
			sprintf( 'height="%d"', intval( $map_height ) )
		), ! empty( $settings['map_location'] ) ? $settings['map_location'] : '' );

		$output = '';
		if ( ! empty( $settings['google_js'] ) && $settings['google_js'] == 'yes' ) {
			$map_style = ! empty( $settings['map_style'] ) ? $settings['map_style'] : '';
			$address   = ! empty( $settings['address'] ) ? $settings['address'] : '';

			$all_styles    = es_google_map_custom_styles();
			$map_data_attr = [
				'data-map-style'         => trim( $all_styles[ $map_style ][1] ),
				'data-locations'         => str_replace( '\\', '', $address ),
				'data-zoom'              => ! empty( $settings['map_zoom']['size'] ) ? $settings['map_zoom']['size'] : '',
				'data-key'               => $api_key,
				'data-map-type'          => ! empty( $settings['map_type'] ) ? $settings['map_type'] : '',
				'data-disable-scrolling' => ! empty( $settings['disable_scrolling'] ) ? $settings['disable_scrolling'] : '',
			];

			if ( ! empty( $settings['custom_marker'] ) && $settings['custom_marker'] == 'yes' && ! empty( $settings['marker']['url'] ) ) {
				$map_data_attr['data-custom-marker'] = $settings['marker']['url'];
			}

			$output.= '<div id="' . esc_attr( $random_id ) . '" class="' . esc_attr( implode( ' ', $css_classes ) ) . '" ' . es_attr_to_html( $map_data_attr ) . '>';
			$output.= '<div class="map-canvas" style="height: ' . esc_attr( $map_height ) . 'px"></div>';
			$output.= '</div>';
		} else {
			$output.= '<div style="height: ' . esc_attr( $map_height ) . 'px">' . $map_location . '</div>';
		}

		es_render( $output );
	}
}