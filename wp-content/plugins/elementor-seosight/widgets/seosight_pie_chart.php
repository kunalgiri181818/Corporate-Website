<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_Pie_Chart extends \Elementor\Widget_Base {

    public function get_name() {
		return 'seosight_pie_chart';
	}

	public function get_title() {
		return esc_html__( 'Pie Chart', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-pie-chart';
	}
	
	public function get_categories() {
		return [ 'elementor-seosight' ];
	}
	
	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_pie_chart',
			[
				'label' => esc_html__( 'Pie Chart', 'elementor-seosight' ),
			]
		);

        $this->add_control(
			'layout',
			[
				'type'    => \Elementor\Controls_Manager::SELECT,
				'label'   => esc_html__( 'Select Template', 'elementor-seosight' ),
				'options' => [
					'standard' => esc_html__( 'Standard', 'elementor-seosight' ),
					'centered' => esc_html__( 'Centered', 'elementor-seosight' ),
				],
				'default' => 'standard'
			]
		);

		$this->add_control(
			'percent',
			[
                'type'        => \Elementor\Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Percent number', 'elementor-seosight' ),
                'description' => esc_html__( 'Drag slider to select the percentage number displayed', 'elementor-seosight' ),
                'size_uints'  => [ '%' ],
                'range'       => [
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'default'     => [
					'unit' => '%',
					'size' => 50,
				],
                'separator'   => 'before'
			]
        );

        $this->add_control(
            'icon_option',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Use Icon ?', 'elementor-seosight' ),
                'description' => esc_html__( 'Display an icon instead the number', 'elementor-seosight' ),
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
                    'value'   => 'fas fa-layer-group',
                    'library' => 'fa-solid',
                ],
                'condition'   => [
                    'icon_option' => 'yes',
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'title',
            [
                'type'      => \Elementor\Controls_Manager::TEXT,
                'label'     => esc_html__( 'Title', 'elementor-seosight' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'description',
            [
                'type'      => \Elementor\Controls_Manager::TEXTAREA,
                'label'     => esc_html__( 'Description', 'elementor-seosight' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'link_name',
            [
                'type'      => \Elementor\Controls_Manager::TEXT,
                'label'     => esc_html__( 'Link Name', 'elementor-seosight' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'link',
            [
                'type'        => \Elementor\Controls_Manager::URL,
                'label'       => esc_html__( 'Link', 'elementor-seosight' ),
                'description' => esc_html__( 'Additional link after description', 'elementor-seosight' ),
            ]
        );

        $this->add_control(
            'startcolor',
            [
                'type'        => \Elementor\Controls_Manager::COLOR,
                'label'       => esc_html__( 'Circle Color start', 'elementor-seosight' ),
                'description' => esc_html__( 'Color of the circle bar gradient', 'elementor-seosight' ),
                'scheme'      => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
                'default'     => '#3b8d8c',
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'endcolor',
            [
                'type'        => \Elementor\Controls_Manager::COLOR,
                'label'       => esc_html__( 'Circle Color finish', 'elementor-seosight' ),
                'description' => esc_html__( 'Color of the circle bar gradient', 'elementor-seosight' ),
                'scheme'      => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
                'default'     => '#4cc3c1',
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'emptyfill',
            [
                'type'        => \Elementor\Controls_Manager::COLOR,
                'label'       => esc_html__( 'Circle Emptyfill Color', 'elementor-seosight' ),
                'scheme'      => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
                'default'     => '#fff',
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'wrap_class',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Wrapper class name', 'elementor-seosight' ),
                'description' => esc_html__( 'Custom class for wrapper of the shortcode widget.', 'elementor-seosight' ),
                'separator'   => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'chart-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Chart', 'elementor-seosight' ),
            ]
        );

        $this->add_control(
			'chart-width',
			[
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Width', 'elementor-seosight' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 170,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .pie-chart' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pie-chart:after' => 'width: calc({{SIZE}}{{UNIT}} - 25px);height: calc({{SIZE}}{{UNIT}} - 25px);',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'value-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Value', 'elementor-seosight' ),
            ]
        );

        $this->add_control(
            'value-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pie-chart .content' => 'color: {{SCHEME}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'value-typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .pie-chart .content',
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
                'label'     => esc_html__( 'Color Icon', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pie-chart .icon' => 'color: {{SCHEME}};'
                ]
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
                    '{{WRAPPER}} .pie-chart .icon' => 'font-size: {{SIZE}}{{UNIT}};'
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
                    '{{WRAPPER}} .pie-chart .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Title', 'elementor-seosight' ),
            ]
        );

        $this->add_control(
            'title-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pie-chart-content-title' => 'color: {{SCHEME}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title-typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .pie-chart-content-title',
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

        $this->add_control(
            'text-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pie-chart-content-text, {{WRAPPER}} .pie-chart-content-text p' => 'color: {{SCHEME}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'text-typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .pie-chart-content-text, {{WRAPPER}} .pie-chart-content-text p',
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        
        $layout = ! empty( $settings['layout'] ) ? $settings['layout'] : 'standard';
        $css_classes = [ 'crumina-module', 'crumina-pie-chart-item', 'pie-chart--' . $layout ];
        if ( ! empty( $settings['wrap_class'] ) ) {
            $css_classes[] = $settings['wrap_class'];
        }

        $percent    = ! empty( $settings['percent']['size'] ) ? $settings['percent']['size'] : 50;
        $startcolor = ! empty( $settings['startcolor'] ) ? $settings['startcolor'] : '';
        $endcolor   = ! empty( $settings['endcolor'] ) ? $settings['endcolor'] : '';
        $emptyfill   = ! empty( $settings['emptyfill'] ) ? $settings['emptyfill'] : '';
        $icon       = ! empty( $settings['icon']['value'] ) ? $settings['icon']['value'] : '';

        $element_attributes = [
            'data-value="' . esc_attr( $percent / 100 ) . '"',
            'data-startcolor="' . esc_attr( $startcolor ) . '"',
            'data-endcolor="' . esc_attr( $endcolor ) . '"',
            'data-emptyfill="' . esc_attr( $emptyfill ) . '"'
        ];

        if( ! empty( $settings['chart-width']['size'] ) ){
            $element_attributes[] = 'data-chartsize="' . esc_attr( $settings['chart-width']['size'] ) . '"';
        } else {
            $element_attributes[] = 'data-chartsize="320"';
        }

        $link = '';
        if ( ! empty( $settings['link']['url'] ) ) {
            $link = '<a href="' . esc_attr( $settings['link']['url'] ) . '" class="more" target="' . esc_attr( ! empty( $settings['link']['is_external'] ) ? '_blank' : '_self' ) . '" title="' . esc_attr( ! empty( $settings['link_name'] ) ? $settings['link_name'] : '' ) . '" ' . ( ! empty( $settings['link']['nofollow'] ) ? 'rel="nofollow"' : '' ) . '>' . esc_html( ! empty( $settings['link_name'] ) ? $settings['link_name'] : '' ) . '<i class="seoicon-right-arrow"></i></a>';
        }
        ?>
        <div class="<?php echo esc_attr( implode( ' ', $css_classes ) ); ?>">
            <div class="pie-chart js-run-pie-chart" <?php echo implode( ' ', $element_attributes ); ?> >
                <?php if ( ! empty( $settings['icon_option'] ) && $settings['icon_option'] == 'yes' ) { ?>
                    <div class="icon es-icon"><i class="<?php es_render( $icon ); ?> pie_chart_icon"></i></div>
                <?php } else { ?>
                    <div class="content"><?php echo esc_html( $percent ) ?><span>%</span></div>
                <?php } ?>
            </div>
            <div class="pie-chart-content">
                <?php
                    if ( ! empty( $settings['title'] ) ) {
                        echo '<h4 class="pie-chart-content-title">' . esc_html( $settings['title'] ) . '</h4>';
                    }
                    if ( ! empty ( $settings['description'] ) ) {
                        echo '<div class="pie-chart-content-text">' . wpautop( $settings['description'] ) . '</div>';
                    }
                    echo $link;
                ?>
            </div>
        </div>
        <?php
    }
}