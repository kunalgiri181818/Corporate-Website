<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Seosight_Info_Box_Slider extends \Elementor\Widget_Base {
    public function get_name() {
		return 'seosight_info_box_slider';
	}

	public function get_title() {
		return esc_html__( 'Feature Box Slider', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-clients-slider';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {
		$button_colors = es_button_colors();

        $this->start_controls_section(
			'seosight_info_box_slider',
			[
				'label' => esc_html__( 'Feature Box Slider', 'elementor-seosight' ),
			]
		);

        $this->add_control(
			'number_of_items',
			[
                'type'        => \Elementor\Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Items per page', 'elementor-seosight' ),
                'description' => esc_html__( 'Number of items displayed on one screen', 'elementor-seosight' ),
                'size_units'  => [ 'px' ],
                'range'       => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 10,
                        'step' => 1
                    ]
                ],
                'default'     => [
                    'unit' => 'px',
                    'size' => 4
                ]
			]
        );

        $this->add_control(
            'arrows',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Show Arrows', 'elementor-seosight' ),
                'description' => esc_html__( 'Previous/ Next Slider buttons', 'elementor-seosight' ),
                'default'     => 'yes',
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'dots',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Show Dots', 'elementor-seosight' ),
                'description' => esc_html__( 'Pagination dots', 'elementor-seosight' ),
                'default'     => 'no',
                'condition'   => [
                    'arrows!' => 'yes'
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'autoscroll',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Autoslide', 'elementor-seosight' ),
                'description' => esc_html__( 'Automatic auto scroll slides', 'elementor-seosight' ),
                'default'     => 'no',
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'time',
            [
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'label'       => esc_html__( 'Delay between scroll', 'elementor-seosight' ),
                'size_units'  => [ 'px' ],
                'range'       => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 30,
                        'step' => 1
                    ]
                ],
                'default'     => [
                    'unit' => 'px',
                    'size' => 5
                ],
                'condition'   => [
                    'autoscroll' => 'yes'
                ],
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
			'items',
			[
				'label' => esc_html__( 'Slider items', 'elementor-seosight' ),
			]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->start_controls_tabs( 'featured_boxs' );

		$repeater->start_controls_tab(
			'box_content',
			[
				'label' => __( 'Сontent', 'elementor-seosight' ),
			]
		);

        $repeater->add_control(
			'media',
			[
				'type'      => \Elementor\Controls_Manager::SELECT,
				'label'     => esc_html__( 'Picture type', 'elementor-seosight' ),
				'options'   => [
					'icon'  => esc_html__( 'Icon', 'elementor-seosight' ),
					'image' => esc_html__( 'Image', 'elementor-seosight' )
				],
				'default'   => 'icon',
				'separator' => 'before'
			]
		);

        $repeater->add_control(
			'image',
			[
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'label'     => esc_html__( 'Upload image', 'elementor-seosight' ),
				'condition' => [
					'media' => 'image',
				],
				'separator' => 'before'
			]

		);

		$repeater->add_control(
			'icon',
			[
				'type'        => \Elementor\Controls_Manager::ICONS,
				'label'       => esc_html__( 'Select icon', 'elementor-seosight' ),
				'description' => esc_html__( 'Select icon display in box', 'elementor-seosight' ),
				'default'     => [
					'value'   => 'fas fa-trophy',
					'library' => 'fa-solid',
				],
				'condition'   => [
					'media' => 'icon'
				],
				'separator'   => 'before'
			]
		);

        $repeater->add_control(
			'title',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Title', 'elementor-seosight' ),
				'default'   => 'Text Title',
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'desc',
			[
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'label'     => esc_html__( 'Description', 'elementor-seosight' ),
				'separator' => 'before'
			]
		);

        $repeater->add_control(
			'show_link',
			[
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label'     => esc_html__( 'Display Link', 'elementor-seosight' ),
				'default'   => 'no',
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'link_name',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Link Button ( Name )', 'elementor-seosight' ),
				'condition' => [
					'show_link' => 'yes'
				],
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'link',
			[
				'type'      => \Elementor\Controls_Manager::URL,
				'label'     => esc_html__( 'Link Button ( Url )', 'elementor-seosight' ),
				'condition' => [
					'show_link' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'link_button',
			[
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label'     => esc_html__( 'Display Link as button', 'elementor-seosight' ),
				'default'   => 'no',
				'condition' => [
					'show_link' => 'yes'
				],
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'btn_color',
			[
				'type'      => \Elementor\Controls_Manager::SELECT,
				'label'     => esc_html__( 'Color', 'elementor-seosight' ),
				'options'   => $button_colors,
				'default'   => key( $button_colors ),
				'condition' => [
					'show_link'   => 'yes',
					'link_button' => 'yes'
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'btn_size',
			[
				'type'      => \Elementor\Controls_Manager::SELECT,
				'label'     => esc_html__( 'Button size', 'elementor-seosight' ),
				'options'   => [
					'small'  => esc_html__( 'Small', 'elementor-seosight' ),
					'medium' => esc_html__( 'Medium', 'elementor-seosight' ),
					'large'  => esc_html__( 'Large', 'elementor-seosight' ),
				],
				'default'   => 'small',
				'condition' => [
					'show_link'   => 'yes',
					'link_button' => 'yes'
				],
				'separator' => 'before'
			]
		);

        $repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'css',
			[
				'label' => __( 'Style', 'elementor-seosight' )
			]
		);

        $repeater->add_control(
            'content-padding',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Box Padding', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$repeater->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'content-background',
                'label'      => __( 'Box Background', 'elementor-seosight' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
			]
		);

        $repeater->add_group_control(
			'border',
			[
				'name'      => 'content-border',
				'label'     => esc_html__( 'Box Border', 'elementor-seosight' ),
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
				'separator' => 'before',
			]
		);

        $repeater->add_control(
			'content-border-radius',
			[
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'label'      => __( 'Box Border Radius', 'elementor-seosight' ),
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after'
			]
		);

        $repeater->add_control(
			'image-font-size',
			[
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Image Icon Size', 'elementor-seosight' ),
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 200,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .info-box-image i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .info-box-image img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_control(
			'image-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Image Icon Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .info-box-image i' => 'color: {{SCHEME}};'
				],
			]
		);

        $repeater->add_control(
			'image-width',
			[
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'label'      => __( 'Image Background Width', 'elementor-seosight' ),
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
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .info-box-image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_control(
			'image-height',
			[
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'label'      => __( 'Image Background Height', 'elementor-seosight' ),
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
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .info-box-image' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'image-background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}} .info-box-image',
			]
		);

		$repeater->add_control(
			'image-border-radius',
			[
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'label'      => __( 'Image Background Border Radius', 'elementor-seosight' ),
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .info-box-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after'
			]
		);

        $repeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
                'label' => __( 'Title Typography', 'elementor-seosight' ),
				'name'     => 'title-typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .info-box-title',
			]
		);

        $repeater->add_control(
			'title-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .info-box-title' => 'color: {{SCHEME}};'
				],
				'separator' => 'after'
			]
		);

        $repeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'text-typography',
                'label'     => esc_html__( 'Text Typography', 'elementor-seosight' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .info-box-text',
			]
		);

		$repeater->add_control(
			'text-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Text Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .info-box-text' => 'color: {{SCHEME}};'
				],
				'separator' => 'after'
			]
		);

        $repeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
                'label' => __( 'Link Typography', 'elementor-seosight' ),
				'name'     => 'link-typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .read-more, {{WRAPPER}} {{CURRENT_ITEM}} .read-more i',
			]
		);

        $repeater->add_control(
			'link-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Link Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .read-more' => 'color: {{SCHEME}};'
				],
				'separator' => 'after'
			]
		);

        $repeater->end_controls_tab();

        $this->add_control(
			'options',
			[
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'label'       => esc_html__( 'Slider items', 'elementor-seosight' ),
				'fields'      => $repeater->get_controls(),
                'description' => esc_html__( 'Repeat this fields with each item created, Each item corresponding slider element.', 'lementor-seosight' ),
			]
		);
    
        $this->end_controls_section();

    }

    protected function render() {
        global $allowedposttags;
        $slider_attr = ['data-centered-slider="true"', 'data-loop="false"', 'data-auto-height="true"', 'data-initial="1"', 'data-scroll-items="1"'];
		$show_items_attr = '';

        $settings = $this->get_settings_for_display();

        $wrap_class = [ 'features-slider-module', 'crumina-module', 'crumina-module-slider' ];
        if ( ! empty( $settings['custom_class'] ) ) {
            $wrap_class[] = $settings['custom_class'];
        }

        if ( ! empty( $settings['number_of_items']['size'] ) ) {
	        $show_items_attr = 'data-show-items="' . esc_attr( $settings['number_of_items']['size'] ) . '"';
        }

        if ( ! empty( $settings['autoscroll'] ) && $settings['autoscroll'] == 'yes' ) {
            $time = ! empty( $settings['time']['size'] ) ? $settings['time']['size'] : 0;
            $slider_attr[] = 'data-autoplay="' . esc_attr( intval( $time ) * 1000 ) . '"';
        }
        
        if ( ! empty( $settings['arrows'] ) && $settings['arrows'] == 'yes' ) {
            $pagination_class = 'pagination-bottom-large';
	        $slider_attr[] = 'data-prev-next="1"';
        } elseif ( ! empty( $settings['dots'] ) && $settings['dots'] == 'yes' ) {
            $pagination_class = 'pagination-bottom';
        } else {
            $pagination_class = '';
        } 
        ?>
        <div class="<?php echo implode( ' ', $wrap_class ); ?>">
            <?php if ( ! empty( $settings['options'] ) ) {
                $slides_count = intval(count($settings['options']));
	            if ( $slides_count < $settings['number_of_items']['size'] ) {
		            $show_items_attr = 'data-show-items="' . esc_attr( $slides_count ) . '"';
                }

	            $slider_attr[] = $show_items_attr;
                ?>
                <div class="swiper-container <?php echo esc_attr( $pagination_class ) ?>" <?php echo implode( ' ', $slider_attr ); ?>>
                    <div class="swiper-wrapper">
                        <?php
                        foreach ( $settings['options'] as $option ) {
                            $wrap_elem_class = [
                                'swiper-slide',
                                'elementor-repeater-item-' . $option['_id'],
                                'crumina-module',
                                'crumina-info-box'
                            ];

                            $title = ! empty( $option['title'] ) ? $option['title'] : '';
                            $desc = ! empty( $option['desc'] ) ? $option['desc'] : '';

                            $data_img = $data_button = '';

                            if ( ! empty( $option['media'] ) && $option['media'] == 'image' && ! empty( $option['image']['url'] ) ) {
                                $data_img .= wp_get_attachment_image( $option['image']['id'], 'full' );
                            } else {
                                if( isset($option['icon']['library']) && $option['icon']['library'] == 'svg' ){
                                    $data_img .= wp_get_attachment_image( $option['icon']['value']['id'], 'full' );
                                } else {
                                    $data_img .= '<i class="es-icon-2 ' . ( ! empty( $option['icon']['value'] ) ? $option['icon']['value'] : 'fas fa-trophy' ) . '"></i>';
                                }
                            }

                            if ( ! empty( $option['show_link'] ) && $option['show_link'] == 'yes' ) {
                                if ( ! empty( $option['link']['url'] ) ) {
                                    $button_href     = $option['link']['url'];
                                    $button_title    = ! empty( $option['link_name'] ) ? $option['link_name'] : '';
                                    $button_target   = ! empty( $option['link']['is_external'] ) ? '_blank' : '_self';
                                    $button_nofollow = ! empty( $option['link']['nofollow'] ) ? 'rel="nofollow"' : '';
                    
                                    if ( ! empty( $option['link_button'] ) && $option['link_button'] == 'yes' ) {
                                        $btn_class = [ 'btn', ' btn-hover-shadow', 'btn-small' ];
                                        $btn_class[] = 'btn--' . esc_attr( ! empty( $option['btn_color'] ) ? $option['btn_color'] : '' );
                    
                                        $data_button .= '<a href="' . esc_url( $button_href ) . '" target="' . $button_target . '" title="' . $button_title . '" class="' . esc_attr( implode( ' ', $btn_class ) ) . '" ' . $button_nofollow . '>';
                                        $data_button .= '<span class="text">' . esc_html( $button_title );
                                        $data_button .= '</a>';
                                    } else {
                                        $data_button .= '<a class="read-more" href="' . esc_url( $button_href ) . '" target="' . $button_target . '" title="' . $button_title . '" ' . $button_nofollow . '>' . $button_title . ' <i class="seoicon-right-arrow"></i></a>';
                                    }
                                    if ( $title ) {
                                        $title = '<a href="' . esc_url( $button_href ) . '" target="' . $button_target . '" title="' . $button_title . '" ' . $button_nofollow . '>' . esc_html( $title ) . '</a>';
                                    }
                                }
                            }
                        ?>
                        <div class="<?php echo implode( ' ', $wrap_elem_class ); ?>">
                            <div class="info-box-image-cont">
                                <div class="info-box-image">
                                    <?php es_render( $data_img ); ?>
                                </div>
                            </div>
                            <?php if ( $title ) { ?>
                                <h5 class="info-box-title"><?php echo wp_kses( $title, $allowedposttags ) ?></h5>
                            <?php } ?>
                            <?php if ( $desc ) { ?>
                                <p class="info-box-text"><?php echo wp_kses( $desc, $allowedposttags ); ?></p>
                            <?php } ?>
                            <?php es_render( $data_button ); ?>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php if ( ! empty( $settings['arrows'] ) && $settings['arrows'] == 'yes' ) { ?>
                        <svg class="btn-next swiper-btn-next">
                            <use xlink:href="#arrow-right"></use>
                        </svg>
                        <svg class="btn-prev swiper-btn-prev">
                            <use xlink:href="#arrow-left"></use>
                        </svg>
                    <?php } elseif ( ! empty( $settings['dots'] ) && $settings['dots'] == 'yes' ) { ?>
                        <div class="swiper-pagination"></div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <?php
        if(is_admin()) { ?>
            <script>
                jQuery( function ( $ ) {
                    CRUMINA.Swiper.init();
                });
            </script>
        <?php }
    }
}