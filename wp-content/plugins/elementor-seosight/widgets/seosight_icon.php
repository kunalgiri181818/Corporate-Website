<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Seosight_Icon extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_icon';
	}

	public function get_title() {
		return esc_html__( 'Icon', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-icon';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_icon',
			[
				'label' => esc_html__( 'Icon', 'elementor-seosight' ),
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
			]
		);

		$this->add_control(
			'title',
			[
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Title', 'elementor-seosight' ),
				'description' => esc_html__( 'Enter title (Note: It is located after icon).', 'elementor-seosight' ),
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'use_link',
			[
				'type'        => \Elementor\Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Add Link ?', 'elementor-seosight' ),
				'description' => esc_html__( 'Add a link for icon.', 'elementor-seosight' ),
				'default'     => 'no',
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'link_name',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Link Name', 'elementor-seosight' ),
				'condition' => [
                    'use_link' => 'yes'
                ],
                'separator' => 'before'
			]
		);

		$this->add_control(
			'link',
			[
				'type'        => \Elementor\Controls_Manager::URL,
				'label'       => esc_html__( 'Link', 'elementor-seosight' ),
				'description' => esc_html__( 'Add your relative URL. Each URL contains link, anchor text and target attributes.', 'elementor-seosight' ),
                'condition'   => [
                    'use_link' => 'yes'
                ]
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
				'label'     => esc_html__( 'Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .icon i' => 'color: {{SCHEME}};'
				]
			]
		);

		$this->add_control(
	        'icon-color-hover',
            [
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'elementor-seosight' ),
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .icon i:hover' => 'color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'icon-font-size',
            [
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'label'      => esc_html__( 'Icon Size', 'elementor-seosight' ),
                'size_units' => [ 'px', 'em', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .icon i' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
                'separator'  => 'before'
            ]
        );

		$this->add_control(
            'icon-line-height',
            [
                'type'            => \Elementor\Controls_Manager::SLIDER,
                'label'           => esc_html__( 'Line Height', 'elementor-seosight' ),
				'size_units'      => [ 'px', 'em' ],
				'responsive'      => true,
				'range'           => [
					'px'   => [
						'min' => 1,
					],
				],
                'desktop_default' => [
					'unit' => 'em',
				],
				'tablet_default'  => [
					'unit' => 'em',
				],
				'mobile_default'  => [
					'unit' => 'em',
				],
                'selectors'       => [
                    '{{WRAPPER}} .icon i' => 'line-height: {{SIZE}}{{UNIT}};'
                ],
                'separator'       => 'before'
            ]
        );

		$this->add_control(
            'icon-align', 
            [
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'label'     => esc_html__( 'Alignment', 'elementor-seosight' ),
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
                'default'   => 'left',
                'separator' => 'before'
            ]
        );

        $this->add_control(
			'icon-width',
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
					'{{WRAPPER}} .icon' => 'width: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before'
			]
		);

		$this->add_control(
			'icon-height',
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
					'{{WRAPPER}} .icon' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before'
			]
		);

		$this->add_control(
			'icon-padding',
			[
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'label'      => __( 'Icon Padding', 'elementor-seosight' ),
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before'
			]
		);

		$this->add_control(
			'icon-background-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .icon' => 'background-color: {{SCHEME}};'
				],
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
					'{{WRAPPER}} .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .module-title' => 'color: {{SCHEME}};'
				],
				'separator' => 'after'
			]
		);

		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title-typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .module-title',
            ]
        );

        $this->add_control(
            'title-align', 
            [
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'label'     => esc_html__( 'Alignment', 'elementor-seosight' ),
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
                'default'   => 'left',
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		$link_att = [];
		$has_link = false;
		$icon     = ! empty( $settings['icon']['value'] ) ? $settings['icon']['value'] : 'fas fa-layer-group';
		$title    = ! empty( $settings['title'] ) ? $settings['title'] : '';

		$css_class = [ 'crumina-module', 'crum-icon-module' ];
		if ( ! empty( $settings['custom_class'] ) ) {
            $css_class[] = $settings['custom_class'];
        }

        if( ! empty( $settings['use_link'] ) && $settings['use_link'] == 'yes' ) {
			if ( ! empty( $settings['link']['url'] ) ) {
				$has_link = true;
				$link_att[] = 'href="' . esc_attr( $settings['link']['url'] ) . '"';
				$link_att[] = 'target="' . esc_attr( ! empty( $settings['link']['is_external'] ) ? '_blank' : '_self' ) . '"';
				$link_att[] = 'title="' . esc_attr( ! empty( $settings['link_name'] ) ? $settings['link_name'] : '' ) . '"';
				$link_att[] = ! empty( $settings['link']['nofollow'] ) ? 'rel="nofollow"' : '';
			}
		}

		$icon_align  = ! empty( $settings['icon-align'] ) ? es_get_align( $settings['icon-align'] ) : '';
		$title_align = ! empty( $settings['title-align'] ) ? es_get_align( $settings['title-align'] ) : '';
        ?>
        <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
			<?php if ( $has_link ) { ?>
				<a <?php echo implode( ' ', $link_att ); ?>>
			<?php } ?>
					<span class="icon es-icon" <?php echo $icon_align; ?>><i class="<?php echo esc_attr( $icon ); ?>"></i></span>
			        <?php
			        	if ( $title ) {
			            	echo '<span class="h5 module-title" ' . $title_align . '>' . esc_html( $title ) . '</span>';
			        	}
			        ?>
			<?php if( $has_link ) { ?>
				</a>
			<?php } ?>
		</div>
		<style>.es-icon i{font-family: "Font Awesome 5 Free";}.es-icon i:before{font-family: inherit;}</style>
		<?php
	}
}