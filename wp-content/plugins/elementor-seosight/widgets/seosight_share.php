<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_Share extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_share';
	}

	public function get_title() {
		return esc_html__( 'Share Page buttons', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-share-page-buttons';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_share',
			[
				'label' => esc_html__( 'Share Page buttons', 'elementor-seosight' )
			]
		);
        
        $this->add_control(
            'custom_class',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Class', 'elementor-seosight' ),
                'description' => esc_html__( 'Extra CSS class', 'elementor-seosight' ),
                'separator'   => 'after'
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'service', 
            [
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label'       => esc_html__( 'Share service provider', 'elementor-seosight' ),
                'description' => __( 'Enter text used as title of the icon.', 'elementor-seosight' ),
                'options'     => [
                    'twitter'    => 'Twitter',
                    'facebook'   => 'Facebook',
                    'linkedin'   => 'Linkedin',
                    'googleplus' => 'Google+',
                    'whatsapp'   => 'Whatsapp',
                    'pinterest'  => 'Pinterest',
                    'tumblr'     => 'Tumblr',
                    'reddit'     => 'Reddit',
                    'vk'         => 'VK.com',
                ],
                'default'     => 'twitter'
            ]
        );

        $repeater->add_control(
            'color',
            [
                'type'        => \Elementor\Controls_Manager::COLOR,
                'label'       => esc_html__( 'Icon Color', 'elementor-seosight' ),
                'description' => esc_html__( 'The color for this icon. You can set color for all icon from Styling tab.', 'elementor-seosight' ),
                'scheme'      => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'separator'   => 'before'
            ]
        );

        $repeater->add_control(
            'bg_color',
            [
                'type'        => \Elementor\Controls_Manager::COLOR,
                'label'       => esc_html__( 'Icon BG Color', 'elementor-seosight' ),
                'description' => esc_html__( 'The background color for this icon. You can set background color for all icon from Styling tab.', 'elementor-seosight' ),
                'scheme'      => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'icons',
            [
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'label'       => esc_html__( 'Icons', 'elementor-seosight' ),
                'description' => esc_html__( 'Repeat this fields with each item created, Each item corresponding an icon element.', 'elementor-seosight' ),
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ service }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'icon-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Icon Style', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'icon-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Icon Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} i' => 'color: {{SCHEME}};'
                ]
            ]
        );

        $this->add_control(
            'icon-background-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Icon BG Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} button' => 'background-color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'icon-font-size',
            [
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'label'      => esc_html__( 'Icon Size', 'elementor-seosight' ),
                'size_units' => [ 'px', 'em', 'rem', 'vw' ],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                    'vw' => [
                        'min'  => 0.1,
                        'max'  => 10,
                        'step' => 0.1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} i' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_group_control(
            'border',
            [
                'name'      => 'icon-border',
                'label'     => esc_html__( 'Icon Border', 'elementor-seosight' ),
                'selector'  => '{{WRAPPER}} button',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'icon-border-radius',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Border Radius', 'elementor-seosight' ),
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'icon-border_border!' => '',
                ],
            ]
        );

        $this->add_control(
            'icon-padding',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Icon Padding', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_responsive_control(
            'icon-gap',
            [
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'label'     => __( 'Icon gap', 'elementor-seosight' ),
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} button' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'icon-hover',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Icon Hover', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'icon-color-hover',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} button:hover i' => 'color: {{SCHEME}};'
                ]
            ]
        );

        $this->add_control(
            'icon-background-color-hover',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'BG Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} button:hover' => 'background-color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'icon-border-color-hover',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Border Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} button:hover' => 'border-color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'icon-border-radius-hover',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Border Radius', 'elementor-seosight' ),
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'icon-border_border!' => '',
                ],
                'separator'  => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'box',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Box', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'box-text-align', 
            [
                'type'    => \Elementor\Controls_Manager::CHOOSE,
                'label'   => esc_html__( 'Icon Align', 'elementor-seosight' ),
                'options' => [
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
                'default' => 'center'
            ]
        );

        $this->add_control(
            'box-padding',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Padding', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .es-multi-icons-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();

        if ( ! empty( $settings['icons'] ) ) {
            $css_class = [ 'kc-multi-icons-wrapper', 'es-multi-icons-wrapper' ];
            if ( ! empty( $settings['custom_class'] ) ) {
                $css_class[] = $settings['custom_class'];
            }

            $box_text_align = ! empty( $settings['box-text-align'] ) ? es_get_align( $settings['box-text-align'] ) : '';
        ?>
            <div class="<?php echo esc_attr( implode( " ", $css_class ) ); ?>" <?php echo $box_text_align; ?>>
                <?php
                    foreach ( $settings['icons'] as $icon ) {
                        $service  = ! empty( $icon['service'] ) ? $icon['service'] : '';
                        $color    = ! empty( $icon['color'] ) ? $icon['color'] : '';
                        $bg_color = ! empty( $icon['bg_color'] ) ? $icon['bg_color'] : '';

                        $link_att   = array();
                        $link_att[] = 'data-url="' . esc_attr( get_the_permalink() ) . '"';
                        $link_att[] = 'data-title="' . esc_attr( get_the_title() ) . '"';
                        $link_att[] = 'class="sharer  ' . $service . '"';
                        $link_att[] = 'data-sharer="' . $service . '"';

                        if ( $bg_color ) {
                            $link_att[] = 'style="background-color:' . $bg_color . ';"';
                        }
                        ?>
                        <button <?php echo implode( ' ', $link_att ); ?>>
                            <i class="fa fa-<?php echo esc_attr( $service ); ?>" <?php echo ( $color ? 'style="color:' . $color . ';"' : '' ); ?> ></i>
                        </button>
                        <?php
                    }
                ?>
            </div>
        <?php
        }
    }
}