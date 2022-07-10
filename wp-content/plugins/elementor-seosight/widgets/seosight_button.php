<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_Button extends \Elementor\Widget_Base {

    public function get_name() {
		return 'seosight_button';
	}

	public function get_title() {
		return esc_html__( 'Button', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-button';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_button',
			[
				'label' => esc_html__( 'Button', 'elementor-seosight' ),
			]
		);

		$this->add_control(
			'label',
			[
                'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Label', 'elementor-seosight' ),
                'description' => esc_html__( 'This is the text that appears on your button', 'elementor-seosight' ),
                'default'     => 'Text Button'
			]
        );

        $this->add_control(
            'link_name',
            [
                'type'      => \Elementor\Controls_Manager::TEXT,
                'label'     => esc_html__( 'Link Name', 'elementor-seosight' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'link',
            [
                'type'        => \Elementor\Controls_Manager::URL,
                'label'       => esc_html__( 'Link', 'elementor-seosight' ),
                'description' => esc_html__( 'Add your relative URL. Each URL contains link, anchor text and target attributes.', 'elementor-seosight' )
            ]
        );
        
        $this->add_control(
            'show_icon', 
            [
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label'     => esc_html__( 'Show Icon?', 'elementor-seosight' ),
                'default'   => 'no',
                'separator' => 'before'
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
                    'show_icon' => 'yes'
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'icon_position', 
            [
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'label'     => esc_html__( 'Icon position', 'elementor-seosight' ),
                'options'   => [
                    'left'  => [
                        'title' => esc_html__( 'Left', 'elementor-seosight' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'elementor-seosight' ),
                        'icon'  => 'fa fa-align-right',
                    ]
                ],
                'default'   => 'left',
                'condition' => [
                    'show_icon' => 'yes'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'align', 
            [
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label'       => esc_html__( 'Horizontal align', 'elementor-seosight' ),
                'description' => esc_html__( 'The horizontal alignment of elements', 'elementor-seosight' ),
                'options'     => [
                    'none'         => esc_html__( 'Inline', 'elementor-seosight' ),
                    'align-left'   => esc_html__( 'Left', 'elementor-seosight' ),
                    'align-center' => esc_html__( 'Centered', 'elementor-seosight' ),
                    'align-right'  => esc_html__( 'Right', 'elementor-seosight' ),
                ],
                'default'     => 'none',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'onclick',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'On Click', 'elementor-seosight' ),
                'description' => esc_html__( 'Content of on click attribute for element.', 'elementor-seosight' ),
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'ex_class',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Button extra class', 'elementor-seosight' ),
                'description' => esc_html__( 'Add class name for a tag.', 'elementor-seosight' ),
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'element_id',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Button ID attribute', 'elementor-seosight' ),
                'description' => esc_html__( 'Only latin charters must be used', 'elementor-seosight' ),
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'el_class',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Module additional class', 'elementor-seosight' ),
                'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'elementor-seosight' ),
                'separator'   => 'before'
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
            'color', 
            [
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label'       => esc_html__( 'Color', 'elementor-seosight' ),
                'description' => esc_html__( 'The color of elements', 'elementor-seosight' ),
                'options'     => es_button_colors(),
                'default'     => 'primary',
            ]
        );

        $this->add_control(
            'size', 
            [
                'type'      => \Elementor\Controls_Manager::SELECT,
                'label'     => esc_html__( 'Button size', 'elementor-seosight' ),
                'options'   => [
                    'small'  => esc_html__( 'Small', 'elementor-seosight' ),
                    'medium' => esc_html__( 'Medium', 'elementor-seosight' ),
                    'large'  => esc_html__( 'Large', 'elementor-seosight' ),
                ],
                'default'   => 'medium',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'outlined', 
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Outlined button', 'elementor-seosight' ),
                'description' => esc_html__( 'Button with border and transparent background', 'elementor-seosight' ),
                'default'     => 'no',
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'shadow', 
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Drop shadow', 'elementor-seosight' ),
                'description' => esc_html__( 'Buttons shadow effect on hover', 'elementor-seosight' ),
                'default'     => 'no',
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'style-background-show-semicircle', 
            [
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'label'     => esc_html__( 'Show semicircle decor?', 'elementor-seosight' ),
                'default'   => 'yes',
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Style', 'elementor-seosight' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'style-typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .btn',
            ]
        );

        $this->add_control(
            'style-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Text Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn' => 'color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'style-background-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Background Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn' => 'background-color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            'border',
            [
                'name'      => 'style-border',
                'label'     => esc_html__( 'Border', 'elementor-seosight' ),
                'selector'  => '{{WRAPPER}} .btn',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'style-border-radius',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Border Radius', 'elementor-seosight' ),
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'style-border_border!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'icon-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Icon', 'elementor-seosight' ),
            ]
        );

        $this->add_control(
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
                    '{{WRAPPER}} .btn i' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'icon-padding',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Icon Spacing', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .btn i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'hover-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Hover', 'elementor-seosight' ),
            ]
        );

        $this->add_control(
            'hover-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Text Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn:hover' => 'color: {{SCHEME}};'
                ]
            ]
        );

        $this->add_control(
            'hover-background-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Background Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn:hover' => 'background-color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            'border',
            [
                'name'      => 'hover-border',
                'label'     => esc_html__( 'Border', 'elementor-seosight' ),
                'selector'  => '{{WRAPPER}} .btn:hover',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'hover-border-radius',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Border Radius Hover', 'elementor-seosight' ),
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'hover-border_border!' => '',
                ],
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
        $button_attr = [];
        $id = $this->get_id();
        $settings = $this->get_settings_for_display();
        $align         = ! empty( $settings['align'] ) ? $settings['align'] : '';
        $label         = ! empty( $settings['label'] ) ? $settings['label'] : '';
        $icon_position = ! empty( $settings['icon_position'] ) ? $settings['icon_position'] : 'right';

        $wrapper_class = [ 'crumina-module', 'crum-button' ];
        if ( ! empty( $settings['el_class'] ) ) {
            $wrapper_class[] = $settings['el_class'];
        }
        if ( $align == 'none' ) {
            $wrapper_class[] = 'inline-block';
        } else {
            $wrapper_class[] = $align;
        }

        if ( ! empty( $settings['link']['url'] ) ) {
            $button_attr[] = 'href="' . esc_attr( $settings['link']['url'] ) . '"';
            $button_attr[] = 'target="'. ( ! empty( $settings['link']['is_external'] ) ? '_blank' : '_self' ) . '"';
            $button_attr[] = ! empty( $settings['link_name'] ) ? $settings['link_name'] : '';
            $button_attr[] = ! empty( $settings['link']['nofollow'] ) ? 'rel="nofollow"' : '';
        } else {
            $button_attr[] = 'href="#"';
        }

        $el_class = [
            'btn',
            'btn-' . ( ! empty( $settings['size'] ) ? $settings['size'] : '' ),
            'btn--' . ( ! empty( $settings['color'] ) ? $settings['color'] : 'primary' ),
            'icon-' . $icon_position,
            ! empty( $settings['shadow'] ) && $settings['shadow'] == 'yes' ? 'btn-hover-shadow' : '',
            ! empty( $settings['outlined'] ) && $settings['outlined'] == 'yes' ? 'btn-border' : '',
            ! empty( $settings['ex_class'] ) ? $settings['ex_class'] : ''
        ];
        $button_attr[] = 'class="' . esc_attr( implode( ' ', $el_class ) ) . '"';
        
        if ( ! empty( $settings['onclick'] ) ) {
            $button_attr[] = 'onclick="' . $settings['onclick'] . '"';
        }
        
        if ( ! empty( $settings['element_id'] ) ) {
            $button_attr[] = 'id="' . esc_attr( $settings['element_id'] ) . '"';
        }
        ?>
        <div class="<?php echo implode( " ", $wrapper_class ); ?>">
            <a <?php echo implode( ' ', $button_attr ); ?>>
                <?php
                    if ( ! empty( $settings['show_icon'] ) && $settings['show_icon'] == 'yes' ) {
                        $icon = ! empty( $settings['icon']['value'] ) ? $settings['icon']['value'] : '';

                        if( isset($settings['icon']['library']) && $settings['icon']['library'] == 'svg' ) {
                            $icon_html = '<img class="img-icon" src="' . esc_url( $icon['url'] ) . '" />';
                        } else {
                            $icon_html = '<i class="es-icon-2 ' . esc_attr( $icon ) . '"></i>';
                        }

                        if ( $icon_position == 'left' ) {
                            echo $icon_html . '<span class="text">' . html_entity_decode( wp_kses( $label, array( 'br' => array() ) ) ) . '</span>';
                        } else {
                            echo '<span class="text">' . html_entity_decode( wp_kses( $label, array( 'br' => array() ) ) ) . '</span>' . $icon_html;
                        }
                    } else {
                        if ( $label ) {
                            echo '<span class="text">' . html_entity_decode( wp_kses( $label, array( 'br' => array() ) ) ) . '</span>';
                        }
                    }
                if ( ! empty( $settings['style-background-show-semicircle'] ) && $settings['style-background-show-semicircle'] != 'no' ) {
                ?>
                <span class="semicircle"></span>
                <?php } ?>
            </a>
        </div>
        <style>
            .es-icon-2:before{font-family: inherit;}
            div.elementor-element-<?php echo $id?>.inline-block, div.elementor-element-<?php echo $id?> .inline-block {display: inline-block; width: auto; float: none;}
        </style>
        <script>
                <?php if ( $align == 'none' ) {?>
                jQuery('[data-id="<?php echo $id?>"]').addClass('inline-block crum-button').find('.elementor-widget-container,.elementor-element-overlay').addClass('inline-block');
                <?php }else{ ?>
                jQuery('[data-id="<?php echo $id?>"]').removeClass('inline-block crum-button').find('.elementor-widget-container,.elementor-element-overlay').removeClass('inline-block');
                <?php } ?>
        </script>
            <?php
    }
}