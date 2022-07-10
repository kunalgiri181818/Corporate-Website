<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_Call_To_Action extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_call_to_action';
	}

	public function get_title() {
		return esc_html__( 'Call To Action', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-call-to-action';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_call_to_action',
			[
				'label' => esc_html__( 'Call To Action', 'elementor-seosight' )
			]
		);

        $this->add_control(
            'layout', 
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => esc_html__( 'Select Template', 'elementor-seosight' ),
                'options' => [
                    'standard' => esc_html__( 'Standard', 'elementor-seosight' ),
                    'center'   => esc_html__( 'Center', 'elementor-seosight' ),
                    'business'   => esc_html__( 'Business', 'elementor-seosight' ),
                ],
                'default' => 'standard'
            ]
        );

        $this->add_control(
			'image',
			[
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'label'     => esc_html__( 'Upload Image', 'elementor-seosight' ),
				'separator' => 'before'
			]
		);

		$this->add_control(
			'title',
			[
                'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Title', 'elementor-seosight' ),
                'default'     => 'Tell Us About Your Project',
                'description' => esc_html__( 'Enter title for form.', 'elementor-seosight' ),
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
            'show_link',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Show Button', 'elementor-seosight' ),
                'description' => esc_html__( 'Display button in form.', 'elementor-seosight' ),
                'default'     => 'yes',
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'button', 
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Button', 'elementor-seosight' ),
                'description' => esc_html__( 'Add name to button.', 'elementor-seosight' ),
                'condition'   => [
                    'show_link' => 'yes'
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'link', 
            [
                'type'        => \Elementor\Controls_Manager::URL,
                'label'       => esc_html__( 'Button URL (Link)', 'elementor-seosight' ),
                'description' => esc_html__( 'Add link to button.', 'elementor-seosight' ),
                'condition'   => [
                    'show_link' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'btn_color', 
            [
                'type'      => \Elementor\Controls_Manager::SELECT,
                'label'     => esc_html__( 'Color', 'elementor-seosight' ),
                'options'   => es_button_colors(),
                'default'   => 'primary',
                'condition' => [
                    'show_link' => 'yes'
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
                'default'   => 'medium',
                'condition' => [
                    'show_link' => 'yes'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'outlined',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Outlined button', 'elementor-seosight' ),
                'description' => esc_html__( 'Button with border and transparent background', 'elementor-seosight' ),
                'default'     => 'yes',
                'condition'   => [
                    'show_link' => 'yes'
                ],
                'separator'   => 'before'
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
				'label'      => esc_html__( 'Image Width', 'elementor-seosight' ),
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 500,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .seosight-cta-image' => 'width: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before'
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
                'selector' => '{{WRAPPER}} .heading-title',
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
                    '{{WRAPPER}} .heading-title' => 'color: {{SCHEME}};'
                ],
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
                'selector' => '{{WRAPPER}} .heading-text',
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
                    '{{WRAPPER}} .heading-text' => 'color: {{SCHEME}};'
                ],
                'separator' => 'before'
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
				'name' => 'box-background',
				'label' => __( 'Background', 'elementor-seosight' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .seo-el-call-to-action',
			]
		);

        $this->add_group_control(
			'border',
			[
				'name'     => 'box-border',
				'label'    => esc_html__( 'Box Border', 'elementor-seosight' ),
				'selector' => '{{WRAPPER}} .seo-el-call-to-action'
			]
		);

		$this->add_control(
			'box-border-radius',
			[
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'label'      => __( 'Box Border Radius', 'elementor-seosight' ),
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .seo-el-call-to-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
	}

	protected function render() {
        $data_text = $data_button = '';

        $settings = $this->get_settings_for_display();

        $main_class = [ 'crumina-module', 'seo-el-call-to-action', 'cta-' . $settings['layout'] ];

        $image = ! empty( $settings['image']['url'] ) ? $settings['image']['url'] : '';

        if ( $settings['show_link'] === 'yes' && 'center' !== $settings['layout'] && 'business' !== $settings['layout'] ) {
            $row_class         = 'row table';
            $title_wrap_class  = 'col-lg-9 col-md-9 col-sm-12 col-xs-12 table-cell';
            $button_wrap_class = 'col-lg-3 col-md-3 col-sm-12 col-xs-12 table-cell align-right';
        } elseif( $settings['show_link'] === 'yes' && 'business' === $settings['layout'] ) {
            $row_class         = 'row table';
            $title_wrap_class  = 'col-lg-6 col-md-6 col-sm-12 col-xs-12 table-cell';
            $button_wrap_class = 'col-lg-6 col-md-6 col-sm-12 col-xs-12 table-cell align-right';
        } else {
            $row_class         = 'row';
            $title_wrap_class  = 'col-sm-12 text-center align-center mb30';
            $button_wrap_class = 'col-sm-12 align-center';
        }

        if ( ! empty( $settings['custom_class'] ) ) {
            $main_class[] = $settings['custom_class'];
        }

        if ( ! empty( $settings['title'] ) ) {
            $data_text .= '<h2 class="h1 heading-title no-margin">' . esc_html( $settings['title'] ) . '</h2>';
        }

        if ( ! empty( $settings['desc'] ) ) {
            $data_text .= '<div class="h5 heading-text no-margin">' . esc_html( $settings['desc'] ) . '</div>';
        }

        if ( $settings['show_link'] === 'yes' && ! empty( $settings['link']['url'] ) ) {
            $button_title    = ! empty( $settings['button'] ) ? $settings['button'] : esc_html__( 'Read More', 'elementor-seosight' );
            $button_target   = ! empty( $settings['link']['is_external'] ) ? '_blank' : '_self';
            $button_nofollow = ! empty( $settings['link']['nofollow'] ) ? 'rel="nofollow"' : '';

            $btn_class = [ 'btn', ' btn-hover-shadow', 'btn-' . esc_attr( $settings['btn_size'] ), 'btn--' . esc_attr( $settings['btn_color'] ) ];
            if ( $settings['outlined'] === 'yes' ) {
                $btn_class[] = 'btn-border';
            }

            $data_button .= '<div class="' . esc_attr( $button_wrap_class ) . '">';
            $data_button .= '<a href="' . esc_url( $settings['link']['url'] ) . '" target="' . $button_target . '" title="' . $button_title . '"';
            $data_button .= 'class="' . esc_attr( implode( ' ', $btn_class ) ) . '" ' . $button_nofollow . '>';
            $data_button .= '<span class="text">' . esc_html( $button_title ) . ' </span><span class="semicircle"></span>';
            $data_button .= '</a>';
            $data_button .= '</div>';
        }
    ?>
        <div class="<?php echo implode( ' ', $main_class ); ?>">
            <div class="<?php echo esc_attr( $row_class ); ?>">
                <?php if($image != ''){ ?>
                <img class="seosight-cta-image" src="<?php echo esc_url($image); ?>" />
                <?php } ?>
                <div class="<?php echo esc_attr( $title_wrap_class ); ?>">
                    <?php es_render( $data_text ); ?>
                </div>
                <?php es_render( $data_button ); ?>
            </div>
        </div>
    <?php
    }
}