<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Seosight_Info_Box extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_info_box';
	}

	public function get_title() {
		return esc_html__( 'Feature Box', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-featured-box';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$button_colors = es_button_colors();

		$this->start_controls_section(
			'seosight_info_box',
			[
				'label' => esc_html__( 'Feature Box', 'elementor-seosight' ),
			]
		);

		$this->add_control(
			'layout',
			[
				'type'    => \Elementor\Controls_Manager::SELECT,
				'label'   => esc_html__( 'Select Template', 'elementor-seosight' ),
				'options' => [
					'standard-nofloat'      => esc_html__( 'Standard no float', 'elementor-seosight' ),
					'standard'              => esc_html__( 'Standard', 'elementor-seosight' ),
					'standard-centered'     => esc_html__( 'Standard Centered', 'elementor-seosight' ),
					'standard-bg'           => esc_html__( 'Standard BG', 'elementor-seosight' ),
					'modern'                => esc_html__( 'Modern', 'elementor-seosight' ),
					'standard-centered-big' => esc_html__( 'Standard Centered Big', 'elementor-seosight' ),
					'standard-hover'        => esc_html__( 'Standard Hover', 'elementor-seosight' ),
				],
				'default' => 'standard-nofloat'
			]
		);

		$this->add_control(
			'title',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Title', 'elementor-seosight' ),
				'default'   => 'Text Title',
				'separator' => 'before'
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

		$this->add_control(
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

		$this->add_control(
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

		$this->add_control(
			'show_link',
			[
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label'     => esc_html__( 'Display Link', 'elementor-seosight' ),
				'default'   => 'no',
				'separator' => 'before'
			]
		);

		$this->add_control(
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

		$this->add_control(
			'link',
			[
				'type'      => \Elementor\Controls_Manager::URL,
				'label'     => esc_html__( 'Link Button ( Url )', 'elementor-seosight' ),
				'condition' => [
					'show_link' => 'yes'
				]
			]
		);

		$this->add_control(
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

		$this->add_control(
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

		$this->add_control(
			'outlined',
			[
				'type'        => \Elementor\Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Outlined button', 'elementor-seosight' ),
				'description' => esc_html__( 'Button with border and tranparent background', 'elementor-seosight' ),
				'default'     => 'no',
				'condition'   => [
					'show_link'   => 'yes',
					'link_button' => 'yes'
				],
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'decor',
			[
				'type'        => \Elementor\Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Button decor', 'elementor-seosight' ),
				'default'     => 'yes',
				'condition'   => [
					'show_link'   => 'yes',
					'link_button' => 'yes'
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
				'label' => esc_html__( 'Title', 'elementor-seosight' ),
			]
		);

		$this->add_control(
            'title-margin',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Margin', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .info-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

		$this->add_control(
            'title-min-height',
            [
				'type' => \Elementor\Controls_Manager::NUMBER,
                'label'      => __( 'Min height', 'elementor-seosight' ),
				'selectors'  => [
                    '{{WRAPPER}} .info-box-title' => 'min-height: {{VALUE}}px;',
                ],
                'separator'  => 'before'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title-typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .info-box-title',
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
					'{{WRAPPER}} .info-box-title' => 'color: {{SCHEME}};'
				],
				'separator' => 'before'
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
            'text-margin',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Margin', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .info-box-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'text-typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .info-box-text',
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
					'{{WRAPPER}} .info-box-text' => 'color: {{SCHEME}};'
				],
				'separator' => 'before'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'link-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Link', 'elementor-seosight' ),
				'condition'  => [
					'link_button!' => 'yes',
				],
			]
		);

		$this->add_control(
			'link-font-size',
			[
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Link Size', 'elementor-seosight' ),
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 200,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .read-more, {{WRAPPER}} .read-more i' => 'font-size: {{SIZE}}{{UNIT}};'
				],
				'separator'  => 'before'
			]
		);

		$this->add_control(
			'link-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Link Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .read-more' => 'color: {{SCHEME}};'
				],
				'separator' => 'before'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'image-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Image', 'elementor-seosight' ),
			]
		);

		$this->add_control(
            'image-padding',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Padding', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .info-box-image-cont' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
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
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .info-box-image, {{WRAPPER}} .info-box-image img' => 'width: {{SIZE}}{{UNIT}};',
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
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .info-box-image' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before'
			]
		);

		$this->add_control(
			'image-font-size',
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
					'{{WRAPPER}} .info-box-image i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .info-box-image img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before'
			]
		);

		$this->add_control(
			'image-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .info-box-image i' => 'color: {{SCHEME}};'
				],
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'image-background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .info-box-image',
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			'border',
			[
				'name'      => 'image-border',
				'label'     => esc_html__( 'Border', 'elementor-seosight' ),
				'selector'  => '{{WRAPPER}} .info-box-image',
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
					'{{WRAPPER}} .info-box-image, {{WRAPPER}} .info-box-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Content', 'elementor-seosight' ),
			]
		);

		$this->add_control(
            'content-padding',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Padding', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .info-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'content-background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .info-box-content',
			]
		);

		$this->add_group_control(
			'border',
			[
				'name'      => 'content-border',
				'label'     => esc_html__( 'Border', 'elementor-seosight' ),
				'selector'  => '{{WRAPPER}} .info-box-content',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'content-border-radius',
			[
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'label'      => __( 'Border Radius', 'elementor-seosight' ),
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .info-box-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'content-border_border!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'box-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Box style', 'elementor-seosight' ),
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

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box-shadow',
				'label' => __( 'Box Shadow', 'elementor-seosight' ),
				'selector' => '{{WRAPPER}}',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'box-background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}}',
				
			]
		);

		$this->add_group_control(
			'border',
			[
				'name'      => 'box-border',
				'label'     => esc_html__( 'Border', 'elementor-seosight' ),
				'selector'  => '{{WRAPPER}}',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'box-border-radius',
			[
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'label'      => __( 'Border Radius', 'elementor-seosight' ),
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$data_img = $data_button = '';

		$settings = $this->get_settings_for_display();

		$layout = ! empty( $settings['layout'] ) ? $settings['layout'] : 'standard';
		$title  = ! empty( $settings['title'] ) ? $settings['title'] : '';
		$desc   = ! empty( $settings['desc'] ) ? $settings['desc'] : '';

		$wrap_class = [ 'crumina-module', 'crumina-info-box', 'info-box--' . $layout ];
		if ( ! empty( $settings['custom_class'] ) ) {
			$wrap_class[] = $settings['custom_class'];
		}

		if ( ! empty( $settings['boxabs-orientation'] ) ) {
			$wrap_class[] = 'v-' . $settings['boxabs-orientation'];
		}

		if ( ! empty( $settings['media'] ) && $settings['media'] == 'image' && ! empty( $settings['image']['url'] ) ) {
			$data_img .= wp_get_attachment_image( $settings['image']['id'], 'full' );
		} else {
			if( isset($settings['icon']['library']) && $settings['icon']['library'] == 'svg' ){
				$data_img .= wp_get_attachment_image( $settings['icon']['value']['id'], 'full' );
			} else {
				$data_img .= '<i class="es-icon-2 ' . ( ! empty( $settings['icon']['value'] ) ? $settings['icon']['value'] : 'fas fa-trophy' ) . '"></i>';
			}
		}

		if ( ! empty( $settings['show_link'] ) && $settings['show_link'] == 'yes' ) {
			if ( ! empty( $settings['link']['url'] ) ) {
				$button_href     = $settings['link']['url'];
				$button_title    = ! empty( $settings['link_name'] ) ? $settings['link_name'] : '';
				$button_target   = ! empty( $settings['link']['is_external'] ) ? '_blank' : '_self';
				$button_nofollow = ! empty( $settings['link']['nofollow'] ) ? 'rel="nofollow"' : '';

				if ( ! empty( $settings['link_button'] ) && $settings['link_button'] == 'yes' ) {
					$btn_class = [ 'btn', ' btn-hover-shadow' ];
					if ( ! empty( $settings['outlined'] ) && $settings['outlined'] == 'yes' ) {
						$btn_class[] = 'btn-border';
					}
					$btn_class[] = 'btn-' . esc_attr( ! empty( $settings['btn_size'] ) ? $settings['btn_size'] : '' );
					$btn_class[] = 'btn--' . esc_attr( ! empty( $settings['btn_color'] ) ? $settings['btn_color'] : '' );

					$data_button .= '<a href="' . esc_url( $button_href ) . '" target="' . $button_target . '" title="' . $button_title . '" class="' . esc_attr( implode( ' ', $btn_class ) ) . '" ' . $button_nofollow . '>';
					$data_button .= '<span class="text">' . esc_html( $button_title );

					if ( ! empty( $settings['decor'] ) && $settings['decor'] == 'yes' ) {
						$data_button .= ' </span><span class="semicircle"></span>';
					}

					$data_button .= '</a>';
				} else {
					$data_button .= '<a class="read-more" href="' . esc_url( $button_href ) . '" target="' . $button_target . '" title="' . $button_title . '" ' . $button_nofollow . '>' . $button_title . '<i class="seoicon-right-arrow"></i></a>';
				}
				if ( $title ) {
					$title = '<a href="' . esc_url( $button_href ) . '" target="' . $button_target . '" title="' . $button_title . '" ' . $button_nofollow . '>' . esc_html( $title ) . '</a>';
				}
			}
		} ?>
        <div class="<?php echo implode( ' ', $wrap_class ); ?>">
			<div class="info-box-image-cont">
				<div class="info-box-image">
					<?php es_render( $data_img ); ?>
				</div>
            </div>
            <div class="info-box-content">
				<?php if ( $title ) { ?>
                    <h5 class="info-box-title"><?php echo wp_kses( $title, $allowedposttags ) ?></h5>
				<?php } ?>
				<?php if ( $desc ) { ?>
                    <div class="info-box-text"><?php echo wp_kses( $desc, $allowedposttags ); ?></div>
				<?php } ?>
				<?php es_render( $data_button ); ?>
            </div>
        </div>
		<?php
	}
}