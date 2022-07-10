<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Seosight_Dropcaps extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_dropcaps';
	}

	public function get_title() {
		return __( 'Dropcaps', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-dropcaps';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_dropcaps',
			[
				'label' => __( 'Dropcaps', 'elementor-seosight' ),
			]
		);

		$this->add_control(
            'desc',
            [
                'type'  => \Elementor\Controls_Manager::WYSIWYG,
                'label' => esc_html__( 'Text Paragraph', 'elementor-seosight' )
            ]
        );
        
        $this->add_control(
            'style',
            [
                'type'      => \Elementor\Controls_Manager::SELECT,
                'label'     => esc_html__( 'Base dropcap style', 'elementor-seosight' ),
                'options'   => [
                    'squared'    => esc_html__( 'Square', 'elementor-seosight' ),
                    'dark-round' => esc_html__( 'Rounded', 'elementor-seosight' ),
                    'primary'    => esc_html__( 'Simple', 'elementor-seosight' ),
                ],
                'default'   => 'squared',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'custom_class',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Extra class', 'elementor-seosight' ),
                'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'elementor-seosight' ),
                'separator'   => 'before'
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'dropcaps-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Dropcaps', 'elementor-seosight' ),
			]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'dropcaps-typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .dropcaps-text',
			]
		);

		$this->add_control(
	        'dropcaps-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
					'{{WRAPPER}} .dropcaps-text' => 'color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

		$this->add_control(
	        'dropcaps-background-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Background Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .dropcaps-text' => 'background-color: {{SCHEME}};'
				],
                'separator' => 'before'
            ]
        );

		$this->add_control(
            'dropcaps-align', 
            [
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'label'     => esc_html__( 'Text Align', 'elementor-seosight' ),
                'options'   => [
					'left'    => [
						'title' => esc_html__( 'Left', 'elementor-seosight' ),
						'icon'  => 'fa fa-align-left',
                    ],
                    'center'  => [
						'title' => esc_html__( 'Centered', 'elementor-seosight' ),
						'icon'  => 'fa fa-align-center',
                    ],
					'right'   => [
						'title' => esc_html__( 'Right', 'elementor-seosight' ),
						'icon'  => 'fa fa-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justify', 'elementor-seosight' ),
						'icon'  => 'fa fa-align-justify',
					]
                ],
                'default'   => 'center',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'dropcaps-width',
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
                    '{{WRAPPER}} .dropcaps-text' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_control(
            'dropcaps-height',
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
                    '{{WRAPPER}} .dropcaps-text' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_group_control(
            'border',
            [
                'name'      => 'dropcaps-border',
                'label'     => esc_html__( 'Border', 'elementor-seosight' ),
                'selector'  => '{{WRAPPER}} .dropcaps-text',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'dropcaps-border-radius',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Border Radius', 'elementor-seosight' ),
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .dropcaps-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'dropcaps-border_border!' => '',
                ],
            ]
        );

        $this->add_control(
            'dropcaps-margin',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Margin', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .dropcaps-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

		$this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();

        $style = ! empty( $settings['style'] ) ? $settings['style'] : '';
        $desc  = ! empty( $settings['desc'] ) ? $settings['desc'] : '';

        $wrap_class = [ 'first-letter--' . $style ];
        if ( ! empty( $settings['custom_class'] ) ) {
            $wrap_class[] = $settings['custom_class'];
        }

        $check = trim( strip_tags( $desc ) );

        if( $check ){
			$ch     = mb_substr( $check, 0, 1 );
			$pos    = strpos( $desc, $ch );
			$str_re = '<span class="dropcaps-text">' . $ch . '</span>';
			$desc   = substr_replace( $desc, $str_re, $pos, $pos + 1 );
		} else {
		    $desc = esc_html__( 'Dropcap: Text not found', 'elementor-seosight' );
		} ?>
		<div class="<?php echo esc_attr( implode( ' ', $wrap_class ) ); ?>">
			<?php echo do_shortcode( $desc ); ?>
		</div>
		<?php
	}
}