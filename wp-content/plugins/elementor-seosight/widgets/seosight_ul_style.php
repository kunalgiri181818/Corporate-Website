<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_UL_Style extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_ul_style';
	}

	public function get_title() {
		return esc_html__( 'Styled UL list', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-styled-ul-list';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_ul_style',
			[
				'label' => esc_html__( 'Styled UL list', 'elementor-seosight' )
			]
		);

        $this->add_control(
            'desc',
            [
                'type'  => \Elementor\Controls_Manager::WYSIWYG,
                'label' => esc_html__( 'Text', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'list_icon', 
            [
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label'       => esc_html__( 'List icon', 'elementor-seosight' ),
                'description' => esc_html__( 'Icon will display before each list item', 'elementor-seosight' ),
                'options'     => [
                    'seoicon-check'       => esc_html__( 'Check', 'elementor-seosight' ),
                    'seoicon-right-arrow' => esc_html__( 'Arrow', 'elementor-seosight' ),
                    'custom'              => esc_html__( 'Custom', 'elementor-seosight' ),
                ],
                'default'     => 'seoicon-check',
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'icon',
            [
                'type'        => \Elementor\Controls_Manager::ICONS,
                'label'       => esc_html__( 'Select Icon', 'elementor-seosight' ),
                'description' => esc_html__( 'Choose an icon to display', 'elementor-seosight' ),
                'default'     => [
                    'value'   => 'fas fa-leaf',
                    'library' => 'fa-solid',
                ],
                'condition'   => [
                    'list_icon' => 'custom'
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
                'selector' => '{{WRAPPER}} li',
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
                    '{{WRAPPER}} li' => 'color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'text-color-hover',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'On Hover', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} li:hover, {{WRAPPER}} li:hover a' => 'color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'icon-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Icon', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'icon-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color Icon', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} li i' => 'color: {{SCHEME}};'
                ]
            ]
        );

        $this->add_control(
            'icon-font-size',
            [
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'label'      => esc_html__( 'Size Icon', 'elementor-seosight' ),
                'size_units' => [ 'px', 'em', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} li i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} li .list-icn' => 'width: {{SIZE}}{{UNIT}};'
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
        
        $this->add_control(
            'box-margin',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Margin', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'box-padding',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Padding', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();
        $wrap_class = [ 'crumina-module', 'list' ];
        $list_icon  = ! empty( $settings['list_icon'] ) ? $settings['list_icon'] : '';
        $icon       = ! empty( $settings['icon']['value'] ) ? $settings['icon']['value'] : '';
        $desc       = ! empty( $settings['desc'] ) ? $settings['desc'] : '';
        if ( 'seoicon-check' == $list_icon || 'seoicon-right-arrow' == $list_icon ) {
            $wrap_class[] = 'list--secondary';
            $icon = $list_icon;
        } else {
            $wrap_class[] = 'list--primary icon-url';
            $icon = ! empty( $settings['icon']['value']['url'] ) ? $settings['icon']['value']['url'] : '';
        }

        if ( ! empty( $settings['custom_class'] ) ){
            $wrap_class[] = $settings['custom_class'];
        }
        ?>
        <div class="<?php echo esc_attr( implode( ' ', $wrap_class ) ); ?>" data-icon="<?php echo esc_attr( $icon ); ?>">
            <?php echo do_shortcode( $desc ); ?>
        </div>
        <?php if(is_admin()) { ?>
        <script>
            jQuery( function ( $ ) {
                CRUMINA.notGruppedInit();
            });
        </script>
        <?php
        }
    }
}