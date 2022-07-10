<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Seosight_Info_Boxes extends \Elementor\Widget_Base {

    public function get_name() {
		return 'seosight_info_boxes';
	}

	public function get_title() {
		return esc_html__( 'Feature Box Module', 'elementor-seosight' );
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
			'seosight_info_boxes',
			[
				'label' => esc_html__( 'Feature Box Module', 'elementor-seosight' ),
			]
		);

        $this->add_control(
			'layout',
			[
				'type'    => \Elementor\Controls_Manager::SELECT,
				'label'   => esc_html__( 'Select Template', 'elementor-seosight' ),
				'options' => [
					'academy' => esc_html__( 'Academy', 'elementor-seosight' ),
					'circles' => esc_html__( 'Circles', 'elementor-seosight' ),
					'company' => esc_html__( 'Company', 'elementor-seosight' ),
					'copywriter' => esc_html__( 'Copywriter', 'elementor-seosight' ),
				],
				'default' => 'academy'
			]
		);

        $this->add_control(
			'main_title',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Block Title', 'elementor-seosight' ),
				'default'   => 'Text Title',
				'separator' => 'before'
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
			]
		);

        $this->add_control(
			'columns',
			[
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Number of columns', 'elementor-seosight' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 4,
						'step' => 1
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 3
                ],
                'separator'   => 'before',
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
			'items',
			[
				'label' => esc_html__( 'Items', 'elementor-seosight' ),
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
				'label'       => esc_html__( 'Items', 'elementor-seosight' ),
				'fields'      => $repeater->get_controls(),
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
			'decoration-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Decoration', 'elementor-seosight' ),
			]
        );

		$this->add_control(
			'decoration-color',
			[
				'label'     => esc_html__( 'Color', 'elementor-seosight' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .heading-decoration' => 'color: {{SCHEME}};',
					'{{WRAPPER}} .heading-decoration svg' => 'fill: {{SCHEME}};'
				]
			]
		);

		$this->end_controls_section();
    }

    protected function render() {
        global $allowedposttags;

		$settings = $this->get_settings_for_display();

        $wrap_class = [ 'seosight-elem-info-boxes-wrap row' ];
		if ( ! empty( $settings['wrap_class'] ) ) {
			$wrap_class[] = $settings['wrap_class'];
		}

        if ( ! empty( $settings['layout'] ) ) {
			$wrap_class[] = 'layout-' . $settings['layout'];
		}

		$columns = ! empty( $settings['columns']['size'] ) ? $settings['columns']['size'] : 3;

        $column_class = [ 'info-box-column col-xs-12 no-padding' ];
			
		$column_class[] = 'col-sm-6';
		$column_class[] = 'col-lg-' . intval( 12 / $columns );

		if ( ! empty( $settings['layout'] ) && $settings['layout'] == 'circles' ) {
			$column_class[] = 'float-none';
			$column_class[] = 'col-md-4';
		} else {
			$column_class[] = 'col-md-6';
		}

        $main_title = ( isset($settings['main_title'])) ? $settings['main_title'] : '';

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
        ?>
        <div class="<?php echo implode( ' ', $wrap_class ); ?>">
            <?php if( $main_title != '' ){ ?>
            <div class="<?php echo implode( ' ', $column_class ); ?>">
				<?php
				if ( ! empty( $delim_type ) && $title_delim_type_position == 'top' ) {
					echo '<div class="heading-decoration">'.$delim_html.'</div>';
				}
				?>
                <h2 class="heading-title"><?php echo esc_html( $main_title ); ?></h2>
                <?php
				if ( ! empty( $delim_type ) && $title_delim_type_position == 'bottom' ) {
					echo '<div class="heading-decoration">'.$delim_html.'</div>';
				}
				?>
            </div>  
            <?php } ?>
            <?php 
            if ( ! empty( $settings['options'] ) ) {
                foreach ( $settings['options'] as $option ) {
                ?>
                <div class="<?php echo implode( ' ', $column_class ); ?>">
                <?php
                    $wrap_elem_class = [
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
                </div>
                <?php
                }
            }
            ?>
        </div>
        <?php
    }
}

