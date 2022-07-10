<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_Promo_Block extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'seosight_promo_block';
	}

	public function get_title() {
		return esc_html__( 'Promo Block', 'elementor-seosight' );
	}
	
	public function get_icon() {
		return 'crum-el-w-promo-block';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}
	
	protected function _register_controls() {

        $button_colors = es_button_colors();

		$this->start_controls_section(
			'seosight_promo_block',
			[
				'label' => esc_html__( 'Promo Block', 'elementor-seosight' ),
			]           
		);

		$this->add_control(
			'image',
			[
				'type'  => \Elementor\Controls_Manager::MEDIA,
				'label' => esc_html__( 'Image', 'elementor-seosight' ),
			]
        );
        
        $this->add_control(
            'image_hover',
            [
                'type'        => \Elementor\Controls_Manager::MEDIA,
                'label'       => esc_html__( 'Image on hover', 'elementor-seosight' ),
                'description' => esc_html__( 'Use only if you want to show different image on block hover', 'elementor-seosight' ),
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'title',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Title', 'elementor-seosight' ),
                'description' => esc_html__( 'Enter title for block', 'elementor-seosight'),
                'default'     => 'Tell Us About Your Project',
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'desc',
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
                'label'     => esc_html__( 'Button URL (Name)', 'elementor-seosight' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'link',
            [
                'type'        => \Elementor\Controls_Manager::URL,
                'label'       => esc_html__( 'Button URL (Link)', 'elementor-seosight' ),
                'description' => esc_html__( 'Add link to button', 'elementor-seosight' ),
            ]
        );

        $this->add_control(
            'link_button',
            [
                'type'       => \Elementor\Controls_Manager::SWITCHER,
                'label'      => esc_html__( 'Show Button', 'elementor-seosight' ),
                'descripton' => esc_html__( 'Display link as button', 'elementor-seosight' ),
                'default'    => 'yes',
                'separator'  => 'before'
            ]
        );

        $this->add_control(
            'btn_color',
            [
                'type'      => \Elementor\Controls_Manager::SELECT,
                'label'     => esc_html__( 'Color', 'elementor-seosight' ),
                'options'   => $button_colors,
                'default'   => key( $button_colors ),
                'condition' => [
                    'link_button' => 'yes',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'btn_size', 
            [
                'type'      => \Elementor\Controls_Manager::SELECT,
                'label'     => esc_html__( 'Button size', 'elementor-seosight' ),
                'options'   =>  [
                    'small'  => esc_html__( 'Small', 'elementor-seosight' ),
                    'medium' => esc_html__( 'Medium', 'elementor-seosight' ),
                    'large'  => esc_html__( 'Large', 'elementor-seosight' ),
                ],
                'default'   => 'medium',
                'condition' => [
                    'link_button' => 'yes',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'outlined', 
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Outlined button', 'elementor-seosight' ),
                'description' => esc_html__( 'Button with border and tranparent background', 'elementor-seosight' ),
                'default'     => 'no',
                'condition'   => [
                    'link_button' => 'yes',
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
			'title-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Title', 'elementor-seosight' )
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title-typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .servises-title',
            ]
        );

		$this->add_control(
			'title-color',
			[
				'label'     => esc_html__( 'Color', 'elementor-seosight' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .servises-title' => 'color: {{SCHEME}};'
				],
                'separator' => 'before'
			]
		);

		$this->add_control(
			'title-color-hover',
			[
				'label'     => esc_html__( 'Color on Hover', 'elementor-seosight' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}}:hover .servises-title, {{WRAPPER}}:hover .promo-link' => 'color: {{SCHEME}};'
				],
                'separator' => 'before'
			]
		);

        $this->add_control(
            'title-align', 
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
            'text-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Text', 'elementor-seosight' )
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'text-typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .servises-text',
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
					'{{WRAPPER}} .servises-text' => 'color: {{SCHEME}};'
				],
                'separator' => 'before'
			]
		);

		$this->add_control(
			'text-color-hover',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color on Hover', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}}:hover .servises-text' => 'color: {{SCHEME}};'
				],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'text-align', 
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
            'image-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Image', 'elementor-seosight' )
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
                    '{{WRAPPER}} .servises-item__thumb img' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .servises-item__thumb img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'image-background',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .servises-item__thumb',
                'separator' => 'before'
            ]
        );

		$this->add_group_control(
            'border',
            [
                'name'      => 'image-border',
                'label'     => esc_html__( 'Border', 'elementor-seosight' ),
                'selector'  => '{{WRAPPER}} .servises-item__thumb',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'image-border-radius',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Border Radius', 'elementor-seosight' ),
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .servises-item__thumb, {{WRAPPER}} .servises-item__thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'image-border_border!' => '',
                ],
            ]
        );

        $this->add_control(
            'image-padding',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Padding', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .servises-item__thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_control(
            'image-margin',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Margin', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .servises-item__thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

		$this->end_controls_section();

        $this->start_controls_section(
            'box-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Box style', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'box-background-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Background Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .crumina-servises-item' => 'background-color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'box-background-color-hover',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color on hover', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}}:hover .crumina-servises-item' => 'background-color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'box-align', 
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
            'box-margin',
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

        $this->add_control(
            'box-padding',
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

        $this->end_controls_section();
    }

    protected function render() {
        global $allowedtags;

        $data_img = $data_button = '';

        $settings = $this->get_settings_for_display();

        $title = ! empty( $settings['title'] ) ? $settings['title'] : '';
        $desc  = ! empty( $settings['desc'] ) ? $settings['desc'] : '';

        $wrap_class = [ 'crumina-module', 'crumina-servises-item', 'bg-border-color', 'servises-item-reverse-color' ];
        if ( ! empty( $settings['custom_class'] ) ) {
            $wrap_class[] = $settings['custom_class'];
        }

        if ( ! empty( $settings['image']['id'] ) || ! empty( $settings['image_hover']['id'] ) ) {
            $data_img.= '<div class="servises-item__thumb">';
                if ( ! empty( $settings['image_hover']['id'] ) ) {
                    $data_img.= wp_get_attachment_image( $settings['image_hover']['id'], 'full', '', array( 'class' => 'hover', 'alt' => $title ) );
                }
                if ( ! empty( $settings['image']['id'] ) ) {
                    $data_img.= wp_get_attachment_image( $settings['image']['id'], 'full', '', array( 'alt' => $title ) );
                }
            $data_img.= '</div>';
        }

        if ( ! empty( $settings['link']['url'] ) ) {
            $button_href     = $settings['link']['url'];
            $button_title    = ! empty( $settings['link_name'] ) ? $settings['link_name'] : '';
            $button_target   = ! empty( $settings['link']['is_external'] ) ? '_blank' : '_self';
            $button_nofollow = ! empty( $settings['link']['nofollow'] ) ? 'rel="nofollow"' : '';

            if ( ! empty( $settings['link_button'] ) && $settings['link_button'] == 'yes' ) {
                $btn_class = [ 'btn', 'btn-hover-shadow', 'btn-reverse-bg-color-dark' ];
                if ( ! empty( $settings['outlined'] ) && $settings['outlined'] == 'yes' ){
                    $btn_class[] = 'btn-border';
                }
                $btn_class[] = 'btn-' . esc_attr( ! empty( $settings['btn_size'] ) ? $settings['btn_size'] : '' );
                $btn_class[] = 'btn--' . esc_attr( ! empty( $settings['btn_color'] ) ? $settings['btn_color'] : '' );

                $data_button.= '<a href="' . esc_url( $button_href ) . '" target="' . $button_target . '" title="' . $button_title . '" class="'. esc_attr( implode(' ', $btn_class ) ) .'" ' . $button_nofollow . '>';
                $data_button.= '<span class="text">' . esc_html( $button_title ) . ' </span><span class="semicircle"></span>';
                $data_button.= '</a>';
            } else {
                $data_button.= '<a class="promo-link" href="' . esc_url( $button_href ) . '" target="' . $button_target . '" title="' . $button_title . '" ' . $button_nofollow . '><span class="text">' . esc_html( $button_title ) . ' </span><i class="seoicon-right-arrow"></i></a>';
            }
            if ( $title ) {
                $title = '<a href="' . esc_url( $button_href ) . '" target="' . $button_target . '" title="' . $button_title . '" ' . $button_nofollow . '>' . esc_html( $title ) . '</a>';
            }
        }

        $title_align = ! empty( $settings['title-align'] ) ? es_get_align( $settings['title-align'] ) : '';
        $text_align  = ! empty( $settings['text-align'] ) ? es_get_align( $settings['text-align'] ) : '';
        $box_align   = ! empty( $settings['box-align'] ) ? $settings['box-align'] : ''; ?>
        
        <div class="<?php echo implode( ' ', $wrap_class ); ?>" <?php echo ( $box_align ? 'style="text-align: ' . $box_align . ';"' : '' ); ?>>
            <?php es_render( $data_img ); ?>
            <?php if ( $title ) { ?>
                <h5 class="servises-title" <?php echo $title_align; ?>><?php echo wp_kses( $title, $allowedtags ); ?></h5>
            <?php } ?>
            <?php if ( $desc ) { ?>
                <p class="servises-text" <?php echo $text_align; ?>><?php echo do_shortcode( $desc ); ?></p>
            <?php } ?>
            <?php es_render( $data_button ); ?>
        </div>
        <?php
    }
}