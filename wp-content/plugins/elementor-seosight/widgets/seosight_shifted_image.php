<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_Shifted_Image extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_shifted_image';
	}

	public function get_title() {
		return esc_html__( 'Shifted image', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-shifted-image';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_shifted_image',
			[
				'label' => esc_html__( 'Shifted image', 'elementor-seosight' )
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
            'title',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Title', 'elementor-seosight' ),
                'description' => esc_html__( 'Enter title (Note: It is located above the content).', 'elementor-seosight' ),
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'desc',
            [
                'type'      => \Elementor\Controls_Manager::WYSIWYG,
                'label'     => esc_html__( 'Text', 'elementor-seosight' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'direction', 
            [
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label'       => esc_html__( 'Content align', 'elementor-seosight' ),
                'description' => esc_html__( 'The horizontal alignment of elements', 'elementor-seosight' ),
                'options'     => [
                    'leftimage'  => esc_html__( 'Image on Left', 'elementor-seosight' ),
                    'rightimage' => esc_html__( 'Image on Right', 'elementor-seosight' )
                ],
                'default'     => 'leftimage',
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
            'title-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Title', 'elementor-seosight' )
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
                    '{{WRAPPER}} .heading-title' => 'color: {{SCHEME}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .heading-title',
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
                    '{{WRAPPER}} .product-description-text' => 'color: {{SCHEME}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .product-description-text',
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

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'selector' => '{{WRAPPER}} .product-description-thumb img',
            ]
        );

        $this->add_group_control(
            'border',
            [
                'name'      => 'image-border',
                'label'     => esc_html__( 'Border', 'elementor-seosight' ),
                'selector'  => '{{WRAPPER}} .product-description-thumb img',
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
                    '{{WRAPPER}} .product-description-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'image-border_border!' => '',
                ],
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
                    '{{WRAPPER}} .product-description-thumb img' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .product-description-thumb img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_control(
            'image-max-width',
            [
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'label'      => __( 'Max Width', 'elementor-seosight' ),
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
                    '{{WRAPPER}} .product-description-thumb img' => 'max-width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .product-description-thumb img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_control(
            'padding',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Padding', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .product-description-thumb img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'box-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Box', 'elementor-seosight' )
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'box-background-color',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .product-description-border',
            ]
        );

        $this->add_group_control(
            'border',
            [
                'name'      => 'box-border',
                'label'     => esc_html__( 'Border', 'elementor-seosight' ),
                'selector'  => '{{WRAPPER}} .product-description-border',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'box-border-radius',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Border Radius', 'elementor-seosight' ),
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .product-description-border' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'box-border_border!' => '',
                ],
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
        global $allowedposttags;
        
        $settings = $this->get_settings_for_display();

        $title   = ! empty( $settings['title'] ) ? $settings['title'] : '';
        $desc    = ! empty( $settings['desc'] ) ? $settings['desc'] : '';
        
        $el_class = [ 'crumina-module', 'crumina-product-description-border' ];
        if ( ! empty( $settings['direction'] ) && $settings['direction'] == 'rightimage' ) {
            $el_class[] = 'even';
        }
        if ( ! empty( $settings['wrap_class'] ) ) {
            $el_class[] = $settings['wrap_class'];
        }
        ?>
        <div class="<?php echo esc_attr( implode( ' ', $el_class ) ) ?>">
	        <?php if ( ! empty( $settings['image'] ) ) { ?>
                <div class="product-description-thumb">
			        <?php echo wp_get_attachment_image( $settings['image']['id'], 'full', '', array( 'class' => 'shadow-image' ) ); ?>
                </div>
	        <?php } ?>
            <div class="product-description-content">
                <div class="crumina-module crumina-heading">
                    <h4 class="h1 heading-title"><?php echo esc_html( $title ) ?></h4>
                    <div class="heading-decoration">
                        <span class="first"></span>
                        <span class="second"></span>
                    </div>
                    <div class="product-description-text"><?php echo wp_kses( $desc, $allowedposttags ); ?></div>
                </div>
            </div>
            <div class="product-description-border"></div>
        </div>
        <?php
    }
}