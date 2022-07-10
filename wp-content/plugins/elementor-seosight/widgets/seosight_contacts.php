<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Seosight_Contacts extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_contacts';
	}

	public function get_title() {
		return esc_html__( 'Address block', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-address-block';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_contacts',
			[
				'label' => esc_html__( 'Address block', 'elementor-seosight' )
			]
		);

        $this->add_control(
			'image',
			[
                'type'  => \Elementor\Controls_Manager::MEDIA,
				'label' => esc_html__( 'Image', 'elementor-seosight' )
			]
        );

        $this->add_control(
            'title',
            [
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Title', 'elementor-seosight'),
				'description' => esc_html__( 'Enter title for block', 'elementor-seosight' ),
				'default'     => 'Country, Some City',
				'separator'   => 'before'
            ]
		);

        $this->add_control(
            'link', 
            [
                'type'        => \Elementor\Controls_Manager::URL,
                'label'       => esc_html__( 'Text Link', 'elementor-seosight' ),
                'description' => esc_html__( 'Add link to title text.', 'elementor-seosight' ),
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'subtitle',
            [
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Subitle', 'elementor-seosight'),
				'description' => esc_html__( 'Enter subtitle for block', 'elementor-seosight' ),
				'default'     => 'Some street address',
				'separator'   => 'before'
            ]
		);

		$this->add_control(
            'custom_class',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Custom class', 'elementor-seosight' ),
                'description' => esc_html__( 'Enter extra custom class', 'elementor-seosight' ),
                'separator'   => 'before'
            ]
        );

		$this->end_controls_section();

        $this->start_controls_section(
            'title-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Title', 'elementor-seosight' )
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .content .title',
            ]
        );

        $this->add_control(
            'title-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Title Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .content .title' => 'color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'title-color-hover',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Title Color on hover', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .content .title:hover' => 'color: {{SCHEME}};'
				],
				'condition' => [
					'link[url]!' => '',
				],
				'separator' => 'before'
            ]
        );

        $this->add_control(
            'title_align', 
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

        $this->end_controls_section();

        $this->start_controls_section(
            'sub-title-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Sub Title', 'elementor-seosight' )
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'sub_title_typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .content .sub-title',
            ]
        );

        $this->add_control(
            'sub-title-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Sub Title Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .content .sub-title' => 'color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'sub_title_align', 
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

        $this->end_controls_section();

        $this->start_controls_section(
            'image-box',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Image box', 'elementor-seosight' )
            ]
        );

		$this->add_control(
			'image-width',
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
			'image-height',
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

        $this->add_group_control(
			'border',
			[
                'name'      => 'border',
				'label'     => esc_html__( 'Border', 'elementor-seosight' ),
				'selector'  => '{{WRAPPER}} .icon',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'border_radius',
			[
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'label'      => __( 'Border Radius', 'elementor-seosight' ),
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .icon, {{WRAPPER}} .icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'border_border!' => '',
				],
			]
		);

		$this->add_control(
			'padding',
			[
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'label'      => __( 'Padding', 'elementor-seosight' ),
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before'
			]
		);

		$this->add_control(
			'margin',
			[
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'label'      => __( 'Margin', 'elementor-seosight' ),
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before'
			]
		);

        $this->end_controls_section();
	}

	protected function render() {
		$image_html = '';
		$link_att   = [];

        $settings   = $this->get_settings_for_display();

		$css_class  = [ 'crumina-module', 'contacts-item' ];
		if ( ! empty( $settings['custom_class'] ) ) {
            $css_class[] = $settings['custom_class'];
        }

        if ( ! empty( $settings['image'] ) ) {
        	$image_url = es_resize( $settings['image']['url'], 140, 140, false );
		}

		if ( ! empty( $settings['link']['url'] ) ) {
	        $link_att[] = 'href="' . esc_attr( $settings['link']['url'] ) . '"';
	        $link_att[] = 'target="' . esc_attr( ! empty( $settings['link']['is_external'] ) ? '_blank' : '_self' ) . '"';
	        $link_att[] = 'title="' . esc_attr( ! empty( $settings['title'] ) ? $settings['title'] : '' ) . '"';
		    $link_att[] = 'class="h5 title"';
		    $link_att[] = ! empty( $settings['link']['nofollow'] ) ? 'rel="nofollow"' : '';
		}

		$title_align     = ! empty( $settings['title_align'] ) ? es_get_align( $settings['title_align'] ) : '';
        $sub_title_align = ! empty( $settings['sub_title_align'] ) ? es_get_align( $settings['sub_title_align'] ) : '';
    ?>
        <div class="<?php echo esc_attr( implode( " ", $css_class ) ); ?>">
		    <?php if ( ! empty( $settings['image'] ) ) {
		        echo '<div class="icon"><img src="' . esc_url( $image_url ) . '" width="140" height="140" alt="icon" loading="lazy"></div>';
            } ?>
		    <div class="content">
		        <?php if ( ! empty( $settings['title'] ) ) {
		            if ( ! empty( $link_att ) ) { ?>
		                <a <?php echo implode( ' ', $link_att ); ?> <?php echo $title_align; ?>><?php echo esc_html( $settings['title'] ); ?></a>
		            <?php } else { ?>
		                <span class="h5 title" <?php echo $title_align; ?>><?php echo esc_html( $settings['title'] ); ?></span>
		            <?php }
		        } ?>
		        <?php if ( ! empty( $settings['subtitle'] ) ) { ?>
		            <div class="sub-title" <?php echo $sub_title_align; ?>><?php echo esc_html( $settings['subtitle'] ); ?></div>
		        <?php } ?>
		    </div>
		</div>
	<?php
    }
}