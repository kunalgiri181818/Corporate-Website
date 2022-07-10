<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Seosight_Counter extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_counter';
	}

	public function get_title() {
		return esc_html__( 'Counter Box', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-counter-box';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_counter',
			[
				'label' => esc_html__( 'Counter Box', 'elementor-seosight' ),
			]
		);

		$this->add_control(
			'layout',
			[
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label'       => esc_html__( 'Select layout', 'elementor-seosight' ),
				'description' => esc_html__( 'Select format of module', 'elementor-seosight' ),
				'options'     => [
					'default' => esc_html__( 'Default', 'elementor-seosight' ),
					'modern'  => esc_html__( 'Modern', 'elementor-seosight' )
				],
				'default'	  => 'default'
			]
		);

		$this->add_control(
            'icon_show',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Display Icon', 'elementor-seosight' ),
                'description' => esc_html__( 'Display icon in box counter', 'elementor-seosight' ),
                'default'     => 'no',
                'separator'   => 'before'
            ]
        );

		$this->add_control(
			'icon',
			[
				'type'        => \Elementor\Controls_Manager::ICONS,
				'label'       => esc_html__( 'Select Icon', 'elementor-seosight' ),
				'description' => esc_html__( 'Choose an icon to display', 'elementor-seosight' ),
                'default'     => [
					'value'   => 'fas fa-puzzle-piece',
					'library' => 'fa-solid',
                ],
				'condition'     => [
					'icon_show' => 'yes'
				],
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'number',
			[
				'type'        => \Elementor\Controls_Manager::NUMBER,
				'label'       => esc_html__( 'Targeted number', 'elementor-seosight' ),
				'description' => esc_html__( 'The targeted number to count up to (From zero).', 'elementor-seosight' ),
			    'default'     => 100,
			    'separator'   => 'before'
            ]
		);

		$this->add_control(
			'units',
			[
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Units', 'elementor-seosight' ),
				'description' => esc_html__( 'Type unit near counter numbers ( % , + , etc. )', 'elementor-seosight' ),
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'label',
			[
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Label', 'elementor-seosight' ),
				'description' => esc_html__( 'The text description of the counter.', 'elementor-seosight' ),
                'default'     => 'Percent number',
                'separator'   => 'before'
			]
		);

		$this->add_control(
            'line_show',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Title underline', 'elementor-seosight' ),
                'description' => esc_html__( 'Underline Title Text', 'elementor-seosight' ),
                'default'     => 'no',
                'separator'   => 'before'
            ]
        );

        $this->add_control(
			'wrap_class',
			[
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Extra class', 'elementor-seosight' ),
				'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'elementor-seosight' ),
				'separator'   => 'before'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'text-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Text', 'elementor-seosight' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'text-typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .counter-title'
			]
		);

		$this->add_control(
			'text-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'elementor-seosoght' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors'	=> [
					'{{WRAPPER}} .counter-title' => 'color: {{SCHEME}}'
				],
				'separator' => 'before'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'number-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Number', 'elementor-seosight' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'number-typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .counter-numbers'
			]
		);

		$this->add_control(
			'number-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'elementor-seosoght' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors'	=> [
					'{{WRAPPER}} .counter-numbers' => 'color: {{SCHEME}}'
				],
				'separator' => 'before'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Icon', 'elementor-seosight' ),
			]
		);

		$this->add_control(
			'icon-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color Icon', 'elementor-seosoght' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors'	=> [
					'{{WRAPPER}} .element-icon i' => 'color: {{SCHEME}}'
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
            'icon-font-size',
            [
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'label'      => esc_html__( 'Size Icon', 'elementor-seosight' ),
                'size_units' => [ 'px', 'em', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .element-icon i' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
                'separator'  => 'before'
            ]
        );
		
		$this->add_control(
			'icon-background-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'elementor-seosoght' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors'	=> [
					'{{WRAPPER}} .element-icon' => 'background-color: {{SCHEME}}'
				],
				'separator' => 'before'
			]
		);

        $this->add_control(
            'icon-padding',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Padding', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .element-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

		$this->add_control(
            'icon-margin',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Margin', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .element-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_group_control(
			'border',
			[
                'name'      => 'icon-border',
				'label'     => esc_html__( 'Border', 'elementor-seosight' ),
				'selector'  => '{{WRAPPER}} .element-icon',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'icon-border-radius',
			[
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'label'      => __( 'Border Radius', 'elementor-seosight' ),
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .element-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'icon-border_border!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'delimiter-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Delimiter', 'elementor-seosight' ),
			]
		);

		$this->add_control(
			'delimiter-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'elementor-seosoght' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors'	=> [
					'{{WRAPPER}} .counter-line *' => 'background-color: {{SCHEME}}'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
            'box-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Box Style', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'box-align', 
            [
                'type'    => \Elementor\Controls_Manager::CHOOSE,
                'label'   => esc_html__( 'Text Align', 'elementor-seosight' ),
                'options' => [
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
                'default' => 'center'
            ]
        );
        
        $this->add_control(
            'box-padding',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Padding', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_control(
            'box-margin',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Margin', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

        $label     = ! empty( $settings['label'] ) ? '<h5 class="counter-title">' . esc_html( $settings['label'] ) . '</h5>' : '';
		$layout    = ! empty( $settings['layout'] ) ? $settings['layout'] : 'default';
		$units     = ! empty( $settings['units'] ) ? '<div class="units">' . esc_attr( $settings['units'] ) . '</div>' :  '';
		$number    = ! empty( $settings['number'] ) ? $settings['number'] : '';
		$box_align = ! empty( $settings['box-align'] ) ? es_get_align( $settings['box-align'] ) : '';
		
		$wrap_class = [ 'crumina-module', 'crumina-counter-item', 'counter-item-' . $layout ];
		if ( ! empty( $settings['wrap_class'] ) ) {
            $wrap_class[] = $settings['wrap_class'];
        }

		if( ! empty( $settings['icon_show'] ) && $settings['icon_show'] == 'yes' ) {
			$icon = '<div class="element-icon"><i class="es-icon-2 ' . esc_html( ! empty( $settings['icon']['value'] ) ? $settings['icon']['value'] : 'fas fa-puzzle-piece' ) . '"></i></div>';
		} else {
			$icon = '';
		} ?>
		<div class="<?php echo esc_attr( implode( ' ', $wrap_class ) ); ?>" <?php echo $box_align; ?>>
		    <?php es_render( $icon ) ; ?>
		    <div class="counter-numbers counter">
		        <span data-to="<?php echo esc_attr( $number ); ?>"><?php echo esc_html( $number ); ?></span>
		        <?php es_render( $units ) ; ?>
		    </div>
		    <?php es_render( $label ) ; ?>
		    <?php if ( ! empty( $settings['line_show'] ) && $settings['line_show'] == 'yes' ) { ?>
		        <div class="counter-line"><span class="first"></span><span class="second"></span></div>
		    <?php } ?>
		</div>
		<style>.es-icon-2:before{font-family: inherit;}</style>
		<?php
	}
}