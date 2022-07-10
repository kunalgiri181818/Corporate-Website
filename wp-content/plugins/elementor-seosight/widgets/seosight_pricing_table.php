<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Seosight_Pricing_Table extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_pricing_table';
	}

	public function get_title() {
		return esc_html__( 'Pricing table', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-pricing-table';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_pricing_table',
			[
				'label' => esc_html__( 'Pricing Table Settings', 'elementor-seosight' ),
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
						'max'  => 6,
						'step' => 1
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 3
				]
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
			'style',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Style', 'elementor-seosight' ),
			]
		);

		$this->add_control(
			'box_bg_color',
			[
				'type'        => \Elementor\Controls_Manager::COLOR,
				'label'       => esc_html__( 'Background Color', 'elementor-seosight' ),
				'scheme'      => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-tables-wrap' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box-shadow',
				'label' => __( 'Box Shadow', 'elementor-seosight' ),
				'selector' => '{{WRAPPER}}  .pricing-tables-wrap',
			]
		);

		$this->add_control(
			'box-aligment',
			[
				'type'      => \Elementor\Controls_Manager::SELECT,
				'label'     => esc_html__( 'Items vertical aligment', 'elementor-seosight' ),
				'options'   => [
					'flex-start'    => esc_html__( 'Top', 'elementor-seosight' ),
					'center' => esc_html__( 'Center', 'elementor-seosight' ),
					'flex-end'  => esc_html__( 'Bottom', 'elementor-seosight' )
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-tables-wrap' => 'display: flex; align-items: {{VALUE}};'
				],
				'default'   => 'flex-start',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'box-direction',
			[
				'type'      => \Elementor\Controls_Manager::SELECT,
				'label'     => esc_html__( 'Items direction', 'elementor-seosight' ),
				'options'   => [
					'row'    => esc_html__( 'Row', 'elementor-seosight' ),
					'column' => esc_html__( 'Column', 'elementor-seosight' ),
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-tables-wrap' => 'flex-direction: {{VALUE}};',
					'{{WRAPPER}} .seo-el-pricing-table-item' => 'width: 100%;',
				],
				'default'   => 'row',
				'separator' => 'before'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'pricing_boxs',
			[
				'label' => __( 'Pricing Boxs', 'elementor-seosight' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->start_controls_tabs( 'pricing_boxs' );

		$repeater->start_controls_tab(
			'pricing_box_content',
			[
				'label' => __( 'Сontent', 'elementor-seosight' ),
			]
		);

		$repeater->add_control(
			'layout',
			[
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label'       => esc_html__( 'Select layout', 'elementor-seosight' ),
				'description' => esc_html__( 'Select format of module', 'elementor-seosight' ),
				'options'     => [
					'classic' => esc_html__( 'Сlassic', 'elementor-seosight' ),
					'head'    => esc_html__( 'Head', 'elementor-seosight' ),
					'colored' => esc_html__( 'Colored', 'elementor-seosight' ),
					'academy' => esc_html__( 'Academy', 'elementor-seosight' ),
					'business' => esc_html__( 'Business', 'elementor-seosight' ),
					'saas' => esc_html__( 'SaaS', 'elementor-seosight' ),
					'courses' => esc_html__( 'Courses', 'elementor-seosight' ),
				],
				'default'     => 'classic'
			]
		);

		$repeater->add_control(
			'show_icon',
			[
				'type'      => \Elementor\Controls_Manager::SELECT,
				'label'     => esc_html__( 'Show Icon In Header', 'elementor-seosight' ),
				'options'   => [
					'no'    => esc_html__( 'No icon', 'elementor-seosight' ),
					'image' => esc_html__( 'Image', 'elementor-seosight' ),
					'icon'  => esc_html__( 'Icon', 'elementor-seosight' )
				],
				'default'   => 'no',
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'image_header',
			[
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'label'     => esc_html__( 'Image', 'elementor-seosight' ),
				'condition' => [
					'show_icon' => 'image',
				],
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'icon_header',
			[
				'type'        => \Elementor\Controls_Manager::ICONS,
				'label'       => esc_html__( 'Select Icon', 'elementor-seosight' ),
				'description' => esc_html__( 'Choose an icon to display', 'elementor-seosight' ),
				'default'     => [
					'value'   => 'fas fa-cloud-upload-alt',
					'library' => 'fa-solid',
				],
				'condition'   => [
					'show_icon' => 'icon',
				],
				'separator'   => 'before'
			]
		);

		$repeater->add_control(
			'title',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Label', 'elementor-seosight' ),
				'default'   => 'Text Title',
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'action_word',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Action word', 'elementor-seosight' ),
				'default'   => 'Popular',
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'desc',
			[
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'label'       => esc_html__( 'Atributes', 'elementor-seosight' ),
				'description' => wp_kses( __( 'Insert tag &lt;strong&gt; when you want highlight text.<br> Example: &lt;strong&gt;<strong>24/7</strong>&lt;/strong&gt; Support', 'elementor-seosight' ), [
					'br',
					'strong'
				] ),
				'separator'   => 'before'
			]
		);

		$repeater->add_control(
			'price',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Price', 'elementor-seosight' ),
				'default'   => '99',
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'currency',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Currency', 'elementor-seosight' ),
				'default'   => '$',
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'show_on_top',
			[
				'type'       => \Elementor\Controls_Manager::SWITCHER,
				'label'      => esc_html__( 'Price format', 'elementor-seosight' ),
				'descripton' => wp_kses( __( 'Price format default <strong>$99</strong>.<br> When turn on price format <strong>99$</strong>', 'elementor-seosight' ), [
					'br',
					'strong'
				] ),
				'default'    => 'no',
				'separator'  => 'before'
			]
		);

		$repeater->add_control(
			'duration',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Per', 'elementor-seosight' ),
				'default'   => '/month',
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'show_button',
			[
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label'     => esc_html__( 'Display button', 'elementor-seosight' ),
				'default'   => 'yes',
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Button text', 'elementor-seosight' ),
				'default'   => 'Purchase',
				'condition' => [
					'show_button' => 'yes',
				],
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'button_link_name',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Link Name', 'elementor-seosight' ),
				'condition' => [
					'show_button' => 'yes',
				],
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'button_link',
			[
				'type'      => \Elementor\Controls_Manager::URL,
				'label'     => esc_html__( 'Link', 'elementor-seosight' ),
				'condition' => [
					'show_button' => 'yes',
				]
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
			'icon-css',
			[
				'type'  => \Elementor\Controls_Manager::HEADING,
				'label' => __( 'Icon', 'elementor-seosight' )
			]
		);

		$repeater->add_control(
			'icon-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .pricing-tables-icon i' => 'color: {{VALUE}};'
				]
			]
		);

		$repeater->add_control(
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
					'{{WRAPPER}} {{CURRENT_ITEM}} .pricing-tables-icon i' => 'font-size: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$repeater->add_group_control(
			'border',
			[
				'name'     => 'icon-border',
				'label'    => esc_html__( 'Border', 'elementor-seosight' ),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .pricing-tables-icon'
			]
		);

		$repeater->add_control(
			'title-css',
			[
				'type'      => \Elementor\Controls_Manager::HEADING,
				'label'     => __( 'Title', 'elementor-seosight' ),
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'title-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .pricing-title' => 'color: {{VALUE}};'
				]
			]
		);

		$repeater->add_control(
			'title-color-hover',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color Hover', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .pricing-title:hover' => 'color: {{VALUE}};'
				]
			]
		);

		$repeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title-typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .pricing-title',
			]
		);

		$repeater->add_control(
			'action-css',
			[
				'type'      => \Elementor\Controls_Manager::HEADING,
				'label'     => __( 'Action', 'elementor-seosight' ),
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'action-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .pricing-title .pricing-action' => 'color: {{VALUE}};'
				]
			]
		);

		$repeater->add_control(
			'action-bg-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .pricing-title .pricing-action' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}}.pricing-tables-item:not(.pricing-tables-item-courses, .pricing-tables-item-academy) .pricing-title .pricing-action:before' => 'border-right: 6px solid {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}}.pricing-tables-item-courses .pricing-title .pricing-action:before' => 'border-top: 6px solid {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}}.pricing-tables-item-academy .pricing-title .pricing-action:before' => 'border-bottom: 6px solid {{VALUE}};',
				]
			]
		);

		$repeater->add_control(
			'text-css',
			[
				'type'      => \Elementor\Controls_Manager::HEADING,
				'label'     => __( 'Text', 'elementor-seosight' ),
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'text-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .pricing-tables-position' => 'color: {{VALUE}};'
				]
			]
		);

		$repeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'text-typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .pricing-tables-position',
			]
		);

		$repeater->add_control(
			'price-css',
			[
				'type'      => \Elementor\Controls_Manager::HEADING,
				'label'     => __( 'Price', 'elementor-seosight' ),
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'price-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .content-price' => 'color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .content-currency' => 'color: {{VALUE}};'
				]
			]
		);

		$repeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'price-typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .content-price, {{WRAPPER}} {{CURRENT_ITEM}} .content-currency',
			]
		);

		$repeater->add_control(
			'button-css',
			[
				'type'      => \Elementor\Controls_Manager::HEADING,
				'label'     => __( 'Button', 'elementor-seosight' ),
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'button-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Text Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .btn' => 'color: {{VALUE}};'
				]
			]
		);

		$repeater->add_control(
			'button-background-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_2,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .btn' => 'background-color: {{VALUE}};'
				]
			]
		);

		$repeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'button-typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .btn',
			]
		);

		$repeater->add_group_control(
			'border',
			[
				'name'     => 'button-border',
				'label'    => esc_html__( 'Border', 'elementor-seosight' ),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .btn',
			]
		);

		$repeater->add_control(
			'button-border-radius',
			[
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'label'      => __( 'Border Radius', 'elementor-seosight' ),
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'button-border_border!' => '',
				],
			]
		);

		$repeater->add_control(
			'button-color-hover',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Text Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .btn:hover' => 'color: {{VALUE}};'
				]
			]
		);

		$repeater->add_control(
			'button-background-color-hover',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Background Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_2,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .btn:hover' => 'background-color: {{VALUE}};'
				]
			]
		);

		$repeater->add_group_control(
			'border',
			[
				'name'     => 'button-hover-border',
				'label'    => esc_html__( 'Hover Border', 'elementor-seosight' ),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .btn:hover',
			]
		);

		$repeater->add_control(
			'button-hover-border-radius',
			[
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'label'      => __( 'Hover Border Radius', 'elementor-seosight' ),
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'button-hover-border_border!' => '',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'pricing_box_settings',
			[
				'label' => __( 'Settings', 'elementor-seosight' )
			]
		);

		$repeater->add_control(
			'primary_color',
			[
				'type'        => \Elementor\Controls_Manager::COLOR,
				'label'       => esc_html__( 'Background Color', 'elementor-seosight' ),
				'description' => esc_html__( 'Primary elements color', 'elementor-seosight' ),
				'scheme'      => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				]
			]
		);

		$repeater->add_control(
			'box_border_radius',
			[
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'label'      => __( 'Border Radius', 'elementor-seosight' ),
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .bg-layer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$repeater->add_control(
			'highlight',
			[
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label'     => esc_html__( 'Always zoomed', 'elementor-seosight' ),
				'default'   => 'no',
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'hover_zoom',
			[
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label'     => esc_html__( 'Zoom on hover', 'elementor-seosight' ),
				'default'   => 'no',
				'condition' => [
					'highlight' => 'no',
				],
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'custom_class',
			[
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Custom class', 'elementor-seosight' ),
				'description' => esc_html__( 'Enter extra custom class', 'elementor-seosight' ),
				'separator'   => 'before'
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'boxs',
			[
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'label'       => __( 'Pricing Box', 'elementor-seosight' ),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$columns    = ! empty( $settings['columns']['size'] ) ? $settings['columns']['size'] : 3;

		$wrap_class = [ 'pricing-tables-wrap' ];
		if ( ! empty( $settings['wrap_class'] ) ) {
			$wrap_class[] = $settings['wrap_class'];
		}

		$column_class = [ 'col-xs-12 no-padding' ];
		if ( $columns == 3 || $columns == 6 ) {
			$column_class[] = 'col-sm-4';
			$column_class[] = 'col-md-4';
		} else {
			$column_class[] = 'col-sm-6';
			$column_class[] = 'col-md-6';
		}

		$column_class[] = 'col-lg-' . intval( 12 / $columns );

		if ( ! empty( $settings['boxs'] ) ) {
			$i   = 1;
			$all = count( $settings['boxs'] ); ?>
            <div class="<?php echo implode( ' ', $wrap_class ); ?>">
				<?php
				foreach ( $settings['boxs'] as $box ) {
					$layout = ! empty( $box['layout'] ) ? $box['layout'] : 'classic';
					if( $layout == 'academy' ){
						$column_class = ['seo-el-pricing-table-item'];
					}
					echo '<div class="' . implode( ' ', $column_class ) . '">';

					// Pricing Box
					$data_price = $data_currency = $data_duration = $default_primary_color = $bg_color_attr = '';
					$action_word = ! empty( $box['action_word'] ) ? $box['action_word'] : '';

					if ( $layout == 'head' ) {
						$default_primary_color = '#4cc2c0';
					} elseif ( $layout != 'colored' ) {
						$default_primary_color = '#fff';
					}

					$layout_b = false;
					if($layout == 'business'){
						$layout = 'courses';
						$layout_b = true;
					}

					$primary_color = ! empty( $box['primary_color'] ) ? $box['primary_color'] : $default_primary_color;
					if ( ! empty( $primary_color ) ) {
						$bg_color_attr = 'style="background-color:' . esc_attr( $primary_color ) . '"';
					}
					$show_icon = ! empty( $box['show_icon'] ) ? $box['show_icon'] : 'no';
					$title     = ! empty( $box['title'] ) ? $box['title'] : '';
					$desc      = ! empty( $box['desc'] ) ? $box['desc'] : '';

					$wrap_class = [
						'elementor-repeater-item-' . $box['_id'],
						'crumina-module',
						'pricing-tables-item',
						'pricing-tables-item-' . $layout
					];

					if($layout_b){
						$wrap_class[] = 'pricing-tables-item-business';
					}

					if ( ! empty( $box['hover_zoom'] ) && $box['hover_zoom'] == 'yes' ) {
						$wrap_class[] = 'hover-zoom';
					}
					if ( ! empty( $box['highlight'] ) && $box['highlight'] == 'yes' ) {
						$wrap_class[] = 'highlight';
					} elseif ( ! empty( $box['hover_zoom'] ) && $box['hover_zoom'] == 'yes' ) {
						$wrap_class[] = 'hover-zoom';
					}
					if ( ! empty( $box['custom_class'] ) ) {
						$wrap_class[] = $box['custom_class'];
					}
					if ( ! empty( $box['show_on_top'] ) && $box['show_on_top'] == 'yes' ) {
						$wrap_class[] = 'kc-price-before-currency';
					}

					$data_icon_header = '';
					if ( $show_icon != 'no' ) {
						$icon_header = '';

						if ( $show_icon == 'icon' ) {
							$icon_header = '<i class="' . esc_attr( ! empty( $box['icon_header']['value'] ) ? $box['icon_header']['value'] : 'fas fa-cloud-upload-alt' ) . '"></i>';
						} elseif ( $show_icon == 'image' ) {
							if ( ! empty( $box['image_header']['id'] ) ) {
								$icon_header = wp_get_attachment_image( $box['image_header']['id'], array(
									'100',
									'100'
								), false );
							}
						}

						if ( $icon_header ) {
							$data_icon_header = '<div class="pricing-tables-icon">' . $icon_header . '</div>';
						}
					} else {
						$wrap_class[] = 'no-icon';
					}

					if ( $box['price'] != '' ) {
						$data_price = '<span class="content-price">' . html_entity_decode( $box['price'] ) . '</span>';
					}

					if ( ! empty( $box['currency'] ) ) {
						$data_currency = '<span class="content-currency">' . $box['currency'] . '</span>';
					}

					if ( ! empty( $box['duration'] ) ) {
						$data_duration = '<span class="content-duration">' . $box['duration'] . '</span>';
					}

					$price_rate = '';
					ob_start();
					echo '<h4 class="rate">';
					if ( ! empty( $box['show_on_top'] ) && $box['show_on_top'] == 'yes' ) {
						es_render( $data_price . $data_currency . $data_duration );
					} else {
						es_render( $data_currency . $data_price . $data_duration );
					}
					echo '</h4>';
					$price_rate = ob_get_contents();
					ob_end_clean();

					$action_button = '';
					ob_start();
					if ( ! empty( $box['show_button'] ) && $box['show_button'] == 'yes' ) {
						$button_text = ! empty( $box['button_text'] ) ? $box['button_text'] : '';

						$button_attr = [
							'class="btn btn-medium ' . esc_attr( $layout === 'colored' ? 'btn-border' : 'btn--dark' ) . '"',
							'href="' . esc_attr( $box['button_link']['url'] ) . '"',
							'target="' . ( ! empty( $box['button_link']['is_external'] ) ? '_blank' : '_self' ) . '"',
							! empty( $box['button_link_name'] ) ? $box['button_link_name'] : $button_text,
							! empty( $box['button_link']['nofollow'] ) ? 'rel="nofollow"' : ''
						];

						echo '<a ' . implode( ' ', $button_attr ) . '><span class="text">' . esc_html( $button_text ) . '</span><span class="semicircle"></span></a>';
					}
					$action_button = ob_get_contents();
					ob_end_clean();

					?>
                    <div class="<?php echo implode( ' ', $wrap_class ); ?>">
						<?php
						if ( $layout === 'head' ) {
							echo '<div class="bg-layer full-block"><div class="pricing-head" ' . $bg_color_attr . ' ></div></div>';
						} else {
							echo '<div class="bg-layer full-block" ' . $bg_color_attr . '></div>';
						}
						?>
                        <div class="pricing-table-content">
							<?php
							es_render( $data_icon_header );

							if ( $title ) {
								$title_txt = esc_html( $title );
								if( $action_word ){
									$title_txt = esc_html( $title ) . '<span class="pricing-action">' . esc_html( $action_word ) . '</span>';
								}
								echo '<div class="pricing-title">' . $title_txt . '</div>';
							}

							if( $layout == 'saas' ){
								echo es_render( $price_rate );
								echo es_render( $action_button ); 
							}

							if( $layout == 'courses' ){
								echo es_render( $price_rate );
							}

							if ( $desc ) {
								$pros = explode( "\n", $desc );
								if ( count( $pros ) ) {
									echo '<ul class="pricing-tables-position">';
									foreach ( $pros as $pro ) {
										$it_cl = (strpos($pro, '<span>') !== false) ? ' dis' : '';
										echo '<li class="position-item'.$it_cl.'">' . do_shortcode( $pro ) . ' </li>';
									}
									echo '</ul>';
								}
							}

							if( $layout != 'saas' && $layout != 'courses' ) { 
								echo es_render( $price_rate ); 
							}
							if( $layout != 'saas' ) {
								echo es_render( $action_button );
							}
							?>
                        </div>
                    </div>
					<?php
					if ( $i < $all && $layout != 'saas' && $layout != 'courses' && $layout != 'academy' ) {
						echo '<img src="' . ES_PLUGIN_URL . '/assets/images/pricing-dots.png" class="dots" alt="dots" width="4" height="334" loading="lazy">';
					}
					echo '</div>';
					$i ++;
				}
				?>
            </div>
			<?php
		}
	}
}