<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Seosight_Form extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_form';
	}

	public function get_title() {
		return esc_html__( 'Custom Form', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-form';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {
        $this->start_controls_section(
			'seosight_form',
			[
				'label' => esc_html__( 'Form', 'elementor-seosight' ),
			]
		);

        $this->add_control(
			'layout',
			[
				'type'    => \Elementor\Controls_Manager::SELECT,
				'label'   => esc_html__( 'Select Template', 'elementor-seosight' ),
				'options' => [
					'standard' => esc_html__( 'Standard', 'elementor-seosight' ),
					'agency' => esc_html__( 'Agency', 'elementor-seosight' ),
					'consultant' => esc_html__( 'Consultant', 'elementor-seosight' ),
					'copywriter' => esc_html__( 'Copywriter', 'elementor-seosight' ),
					'newsletter' => esc_html__( 'Newsletter', 'elementor-seosight' ),
				],
				'default' => 'standard'
			]
		);

        $this->add_control(
			'shortcode',
			[
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'label'       => esc_html__( 'Form shortcode', 'elementor-seosight' ),
				'separator'   => 'before'
			]
		);

		$this->add_control(
            'show_icon', 
            [
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label'     => esc_html__( 'Show Icon?', 'elementor-seosight' ),
                'default'   => 'no',
                'separator' => 'before',
				'condition' => [
					'layout' => 'newsletter',
				],
            ]
        );

        $this->add_control(
            'icon', 
            [
                'type'        => \Elementor\Controls_Manager::ICONS,
                'label'       => esc_html__( 'Icon', 'elementor-seosight' ),
                'description' => esc_html__( 'Select icon for button', 'elementor-seosight' ),
				'default'     => [
                    'value'   => 'fas fa-leaf',
                    'library' => 'fa-solid',
                ],
                'condition'   => [
					'layout' => 'newsletter',
                    'show_icon' => 'yes'
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'title',
            [
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Title', 'elementor-seosight'),
                'separator' => 'before'
            ]
		);

		$this->add_control(
			'title_delim',
			[
				'type'        => \Elementor\Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Title decoration', 'elementor-seosight' ),
				'description' => esc_html__( 'Visual decoration lines below title text', 'elementor-seosight' ),
                'default'     => 'no',
                'separator'   => 'before',
				'condition' => [
					'layout!' => 'newsletter',
				],
			]
		);

		$this->add_control(
			'title_delim_type',
			[
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label'       => esc_html__( 'Title decoration type', 'elementor-seosight' ),
				'options' => [
					'lines' => esc_html__( 'Lines', 'elementor-seosight' ),
					'sm_lines' => esc_html__( 'Small Lines', 'elementor-seosight' ),
					'diagonal_lines' => esc_html__( 'Diagonal Lines', 'elementor-seosight' ),
					'color_dots' => esc_html__( 'Color dots', 'elementor-seosight' ),
					'wave_1' => esc_html__( 'Wave 1', 'elementor-seosight' ),
					'wave_2' => esc_html__( 'Wave 2', 'elementor-seosight' ),
					'shapes' => esc_html__( 'Shapes', 'elementor-seosight' ),
					'dots_lines' => esc_html__( 'Dots & Lines', 'elementor-seosight' ),
					'zigzag' => esc_html__( 'Zigzag', 'elementor-seosight' ),
				],
				'default' => 'lines',
                'separator'   => 'before',
				'condition' => [
					'title_delim' => 'yes',
					'layout!' => 'newsletter',
				],
			]
		);

		$this->add_control(
			'title_delim_type_position',
			[
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label'       => esc_html__( 'Title decoration position', 'elementor-seosight' ),
				'options' => [
					'top' => esc_html__( 'Top', 'elementor-seosight' ),
					'bottom' => esc_html__( 'Bottom', 'elementor-seosight' ),
				],
				'default' => 'bottom',
                'separator'   => 'before',
				'condition' => [
					'title_delim' => 'yes',
					'layout!' => 'newsletter',
				],
			]
		);

        $this->add_control(
            'subtitle',
            [
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'label'     => esc_html__( 'Subtitle', 'elementor-seosight'),
                'separator' => 'before',
				'condition' => [
					'layout!' => 'newsletter',
				],
            ]
		);

		$this->add_control(
            'align', 
            [
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'label'     => esc_html__( 'Content align', 'elementor-seosight' ),
                'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'elementor-seosight' ),
						'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
						'title' => esc_html__( 'Centered', 'elementor-seosight' ),
						'icon'  => 'fa fa-align-center',
                    ],
					'right'  => [
						'title' => esc_html__( 'Right', 'elementor-seosight' ),
						'icon'  => 'fa fa-align-right',
					]
                ],
                'default'   => 'left',
				'selectors'  => [
					'{{WRAPPER}} .seo-el-form-block' => 'text-align: {{VALUE}};',
				],
                'separator' => 'before'
            ]
        );

		$this->add_control(
            'class',
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
					'{{WRAPPER}} .title-text-wrap h2' => 'color: {{SCHEME}};'
				],
				'separator' => 'after'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .title-text-wrap h2',
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'subtitle-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Subtitle', 'elementor-seosight' ),
				'condition' => [
					'layout!' => 'newsletter',
				],
			]
        );

        $this->add_control(
			'subtitle-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .heading-text' => 'color: {{SCHEME}};'
				],
				'separator' => 'after'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .heading-text',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		    'button-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Button', 'elementor-seosight' ),
            ]
        );

		$this->add_control(
            'bttn-color', 
            [
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} form .wpcf7-submit' => 'background-color: {{SCHEME}};',
					'{{WRAPPER}} form input[type="submit"]' => 'background-color: {{SCHEME}};',
				],
				'separator' => 'after'
			]
        );

		$this->add_control(
            'bttn-hover-color', 
            [
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover background', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} form .wpcf7-submit:hover' => 'background-color: {{SCHEME}};',
					'{{WRAPPER}} form input[type="submit"]:hover' => 'background-color: {{SCHEME}};',
				],
				'separator' => 'after'
			]
        );

		$this->end_controls_section();

		$this->start_controls_section(
		    'labels-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Labels', 'elementor-seosight' ),
            ]
        );

		$this->add_control(
            'labels-color', 
            [
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} form label' => 'color: {{SCHEME}};',
					'{{WRAPPER}} form a' => 'color: {{SCHEME}}; text-decoration: underline;',
				],
				'separator' => 'after'
			]
        );

		$this->end_controls_section();

        $this->start_controls_section(
		    'box-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Box', 'elementor-seosight' ),
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box-background',
				'label' => __( 'Background', 'elementor-seosight' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .seo-el-form-block',
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box-box-shadow',
                'selector' => '{{WRAPPER}} .seo-el-form-block',
            ]
        );

		$this->add_group_control(
			'border',
			[
                'name'      => 'box-border',
				'label'     => esc_html__( 'Border', 'elementor-seosight' ),
				'selector'  => '{{WRAPPER}} .seo-el-form-block',
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
					'{{WRAPPER}} .seo-el-form-block' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box-padding',
			[
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'label'      => __( 'Padding', 'elementor-seosight' ),
				'size_units' => [ 'px', '%', 'em' ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'selectors'  => [
					'{{WRAPPER}} .seo-el-form-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before'
			]
		);

		$this->end_controls_section();
    }

	protected function render() {
		global $allowedposttags;
		$settings = $this->get_settings_for_display();

        $wrap_class = ['crumina-module seo-el-form-block'];
        $shortcode  = ! empty( $settings['shortcode'] ) ? $settings['shortcode'] : '';
        $title  = ! empty( $settings['title'] ) ? $settings['title'] : '';
        $subtitle  = ! empty( $settings['subtitle'] ) ? $settings['subtitle'] : '';

		$delim_html = '';
		ob_start();
		$delim_type = ( ! empty( $settings['title_delim_type'] ) ) ? $settings['title_delim_type'] : 'lines';
			if( $delim_type == 'lines' ){
			?>
		    <span class="first"></span><span class="second"></span>
			<?php } else if( $delim_type == 'sm_lines' ) { ?>
			<svg id="seo_title_sm_lines" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 4"><path id="line" d="M2,0h9a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H2A2,2,0,0,1,0,2H0A2,2,0,0,1,2,0Z"/><path id="line-2" d="M21,0h9a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H21a2,2,0,0,1-2-2h0A2,2,0,0,1,21,0Z"/><path id="line-3" d="M40,0h9a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H40a2,2,0,0,1-2-2h0A2,2,0,0,1,40,0Z"/><path id="line-4" d="M59,0h9a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H59a2,2,0,0,1-2-2h0A2,2,0,0,1,59,0Z"/></svg>
			<?php
			} else if( $delim_type == 'diagonal_lines' ) { ?>
			<svg id="seo_title_diagonal_lines" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 69.96 5.96"><path id="_1" data-name=" 1" class="cls-1" d="M5.64.53a1.53,1.53,0,0,1-.16,2L2.14,5.65A1.24,1.24,0,0,1,.4,5.6L.29,5.47a1.54,1.54,0,0,1,.17-2L3.8.35A1.24,1.24,0,0,1,5.54.4Z" transform="translate(0.01 -0.02)"/><path id="_2" data-name=" 2" class="cls-1" d="M21.64.53a1.53,1.53,0,0,1-.16,2L18.14,5.65A1.24,1.24,0,0,1,16.4,5.6l-.11-.13a1.54,1.54,0,0,1,.17-2L19.8.35A1.24,1.24,0,0,1,21.54.4Z" transform="translate(0.01 -0.02)"/><path id="_3" data-name=" 3" class="cls-1" d="M37.64.53a1.53,1.53,0,0,1-.16,2L34.14,5.65A1.24,1.24,0,0,1,32.4,5.6l-.11-.13a1.54,1.54,0,0,1,.17-2L35.8.35A1.24,1.24,0,0,1,37.54.4Z" transform="translate(0.01 -0.02)"/><path id="_4" data-name=" 4" class="cls-1" d="M53.64.53a1.53,1.53,0,0,1-.16,2L50.14,5.65A1.24,1.24,0,0,1,48.4,5.6l-.11-.13a1.54,1.54,0,0,1,.17-2L51.8.35A1.24,1.24,0,0,1,53.54.4Z" transform="translate(0.01 -0.02)"/><path id="_5" data-name=" 5" class="cls-1" d="M69.64.53a1.53,1.53,0,0,1-.16,2L66.14,5.65A1.24,1.24,0,0,1,64.4,5.6l-.11-.13a1.54,1.54,0,0,1,.17-2L67.8.35A1.24,1.24,0,0,1,69.54.4Z" transform="translate(0.01 -0.02)"/></svg>
			<?php
			} else if( $delim_type == 'wave_1' ) { ?>
			<svg id="seo_title_wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 6"><path d="M374.06,342.61a7.74,7.74,0,0,1-5.47-2.22,6,6,0,0,0-8.52,0,7.84,7.84,0,0,1-10.93,0,6,6,0,0,0-8.51,0,7.85,7.85,0,0,1-10.94,0,6,6,0,0,0-8.5,0,7.85,7.85,0,0,1-10.94,0,5.89,5.89,0,0,0-4.25-1.78,1,1,0,0,1,0-2,7.76,7.76,0,0,1,5.47,2.22,6,6,0,0,0,8.5,0,7.85,7.85,0,0,1,10.94,0,6,6,0,0,0,8.5,0,7.85,7.85,0,0,1,10.94,0,6,6,0,0,0,8.51,0,7.85,7.85,0,0,1,10.94,0,6,6,0,0,0,4.26,1.78,1,1,0,0,1,0,2Z" transform="translate(-305.03 -336.61)"/></svg>
			<?php
			} else if( $delim_type == 'color_dots' ) { ?>
			<svg id="seo_title_dots" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70.06 6.06"><defs><style>.cls-1{fill:#6c6ff2;}.cls-2{fill:#4cc2c0;}.cls-3{fill:#f15b26;}.cls-4{fill:#fcb03b;}.cls-5{fill:#3cb878;}</style></defs><circle class="cls-1" cx="3.03" cy="3.03" r="3.03"/><circle class="cls-2" cx="19.03" cy="3.03" r="3.03"/><circle class="cls-3" cx="35.03" cy="3.03" r="3.03"/><circle class="cls-4" cx="51.03" cy="3.03" r="3.03"/><circle class="cls-5" cx="67.03" cy="3.03" r="3.03"/></svg>
			<?php
			} else if( $delim_type == 'wave_2' ) { ?>
			<svg id="seo_title_wave_2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70.06 6.01"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><path id="line" class="cls-1" d="M69,6A30.33,30.33,0,0,1,57.38,3.94a32.17,32.17,0,0,0-22.06,0A34.08,34.08,0,0,1,12,3.94,28.29,28.29,0,0,0,1,2,1,1,0,0,1,1,0,30.22,30.22,0,0,1,12.64,2.05a32.26,32.26,0,0,0,22,0A34.11,34.11,0,0,1,58,2.05,28.47,28.47,0,0,0,69,4a1,1,0,0,1,0,2Z" transform="translate(0.02 0.02)"/></svg>
			<?php
			} else if( $delim_type == 'shapes' ) { ?>
			<svg id="seo_title_shapes_b" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 10"><rect class="cls-1" x="34" width="2" height="10" rx="1"/><rect class="cls-1" x="34" width="2" height="10" rx="1" transform="translate(40 -30) rotate(90)"/><path class="cls-1" d="M18.5,8.5A.66.66,0,0,1,18,8.31L15.19,5.47a.68.68,0,0,1,0-.94L18,1.69a.68.68,0,0,1,.94,0l2.84,2.84a.68.68,0,0,1,0,.94L19,8.31A.66.66,0,0,1,18.5,8.5ZM16.6,5l1.9,1.9L20.4,5,18.5,3.1Z" transform="translate(0 0)"/><path class="cls-1" d="M51.5,8.5A.66.66,0,0,1,51,8.31L48.19,5.47a.68.68,0,0,1,0-.94L51,1.69a.68.68,0,0,1,.94,0l2.84,2.84a.68.68,0,0,1,0,.94L52,8.31A.66.66,0,0,1,51.5,8.5ZM49.6,5l1.9,1.9L53.4,5,51.5,3.1Z" transform="translate(0 0)"/><circle class="cls-1" cx="2" cy="5" r="2"/><circle class="cls-1" cx="68" cy="5" r="2"/></svg>
			<?php
			} else if( $delim_type == 'dots_lines' ) { ?>
			<svg id="seo_title_dots_lines_b" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 4"><path id="_1" data-name=" 1" d="M2,0H2A2,2,0,0,1,4,2H4A2,2,0,0,1,2,4H2A2,2,0,0,1,0,2H0A2,2,0,0,1,2,0Z"/><path id="_2" data-name=" 2" d="M11,0H26a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H11A2,2,0,0,1,9,2H9A2,2,0,0,1,11,0Z"/><path id="_3" data-name=" 3" d="M35,0h0a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2h0a2,2,0,0,1-2-2h0A2,2,0,0,1,35,0Z"/><path id="_4" data-name=" 4" d="M44,0H59a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H44a2,2,0,0,1-2-2h0A2,2,0,0,1,44,0Z"/><path id="_5" data-name=" 5" d="M68,0h0a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2h0a2,2,0,0,1-2-2h0A2,2,0,0,1,68,0Z"/></svg>
			<?php
			} else if( $delim_type == 'zigzag' ) { ?>
			<svg id="seo_title_zigzag" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 6"><polygon points="8.24 6 0 1.45 1.2 0.33 8.24 4.22 15.88 0 23.52 4.22 31.17 0 38.81 4.22 46.46 0 54.1 4.22 61.75 0 70 4.55 68.8 5.67 61.75 1.78 54.1 6 46.46 1.78 38.81 6 31.17 1.78 23.52 6 15.88 1.78 8.24 6"/></svg>
			<?php
			}
		$delim_html = ob_get_clean();
		$title_delim_type_position = ( ! empty( $settings['title_delim_type_position'] ) ) ? $settings['title_delim_type_position'] : 'bottom';

		$layout = ! empty( $settings['layout'] ) ? $settings['layout'] : 'standard';
		$wrap_class[] = 'seo-el-form-block-' . $layout;

		if ( ! empty( $settings['class'] ) ) {
			$wrap_class[] = $settings['class'];
		}
		
		?>
        <div class="<?php echo implode( ' ', $wrap_class ); ?>">
			<?php
			if ( ! empty( $settings['title_delim'] ) && $settings['title_delim'] == 'yes' && $title_delim_type_position == 'top' && $layout != 'newsletter' ) {
				echo '<div class="heading-decoration top">'.$delim_html.'</div>';
			}
			?>
			<?php if( isset($settings['show_icon']) && $settings['show_icon'] == 'yes' ){ ?>
			<?php 
				if( isset($settings['icon']['library']) && $settings['icon']['library'] == 'svg' ){
					?>
					<img class="seo-el-newsletter-img" src="<?php echo esc_url($settings['icon']['value']['url']); ?>" />
					<?php
				} else {
					$icon_class = (isset($settings['icon']['value'])) ? $settings['icon']['value'] : '';
					?>
					<i class="seo-el-newsletter-img <?php echo esc_attr($icon_class); ?>"></i>
					<?php
				}
			?>
			<?php } ?>
            <?php if( $title != '' ){ ?>
            <div class="title-text-wrap">
                <h2><?php echo esc_html($title); ?></h2>
            </div>
            <?php } ?>
            <?php if( $subtitle != '' && $layout != 'newsletter' ){ ?>
		    <div class="h5 heading-text"><?php echo html_entity_decode( wp_kses( $settings['subtitle'], $allowedposttags ) ); ?></div>
            <?php } ?>
			<?php
			if ( ! empty( $settings['title_delim'] ) && $settings['title_delim'] == 'yes' && $title_delim_type_position == 'bottom' && $layout != 'newsletter' ) {
				echo '<div class="heading-decoration">'.$delim_html.'</div>';
			}
			?>
			<?php
			if( $layout == 'newsletter' ){echo '<div class="form-wrap">';}
				echo do_shortcode($shortcode);
			if( $layout == 'newsletter' ){echo '</div>';}
			?>
        </div>
        <?php
    }
}