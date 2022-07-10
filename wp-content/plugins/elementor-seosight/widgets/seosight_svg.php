<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_SVG extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_svg';
	}

	public function get_title() {
		return esc_html__( 'Animated SVG', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'eicon-alert';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_svg',
			[
				'label' => esc_html__( 'Animated SVG', 'elementor-seosight' )
			]
		);
        
        $this->add_control(
            'image',
            [
                'type'  => \Elementor\Controls_Manager::MEDIA,
                'label' => esc_html__( 'Upload Image', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'svg-animation', 
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Enable stroke animation', 'elementor-seosight' ),
                'description' => esc_html__( 'Animation of svg line strokes', 'elementor-seosight' ),
                'default'     => 'yes',
                'separator'   => 'before'
            ]
        );
        
        $this->add_control(
            'class',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Extra class name', 'elementor-seosight' ),
                'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'elementor-seosight' ),
                'separator'   => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Main params', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'style-width',
            [
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'label'      => __( 'Width', 'elementor-seosight' ),
                'size_units' => [ 'px', 'em', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_control(
            'style-height',
            [
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'label'      => __( 'Height', 'elementor-seosight' ),
                'size_units' => [ 'px', 'em', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_control(
            'style-padding',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Padding', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_control(
            'style-margin',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Margin', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'style-background-color',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} svg',
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            'border',
            [
                'name'      => 'style-border',
                'label'     => esc_html__( 'Border', 'elementor-seosight' ),
                'selector'  => '{{WRAPPER}} svg',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'style-border-radius',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Border Radius', 'elementor-seosight' ),
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'style-border_border!' => '',
                ],
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();

        $svg_url = ! empty( $settings['image']['url'] ) ? $settings['image']['url'] : '';

		if ( $svg_url ) {
			$css_classes = [ 'crumina-module', 'animated-svg' ];

			if ( ! empty( $settings['svg-animation'] ) && $settings['svg-animation'] == 'yes' && ! is_admin() ) {
				$css_classes[] = 'js-animate-icon';
			} ?>
            <div class="<?php echo esc_attr( trim( implode( ' ', $css_classes ) ) ); ?>">
				<?php
				$svg_file = wp_remote_get( esc_url_raw( $svg_url ) );
				$svg_file = wp_remote_retrieve_body( $svg_file );

				$position     = strpos( $svg_file, '<svg' );
				$svg_file_new = substr( $svg_file, $position );
				es_render( $svg_file_new );
				?>
            </div>
			<?php
		}
    }
}