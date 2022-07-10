<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_Accordion extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_accordion';
	}

	public function get_title() {
		return esc_html__( 'Accordion', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-accordion';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_accordion',
			[
				'label' => esc_html__( 'Accordion Settings', 'elementor-seosight' )
			]
		);
        
        $this->add_control(
            'class',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Extra Class', 'elementor-seosight' ),
                'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'elementor-seosight' )
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'accordion_tabs',
            [
                'label' => __( 'Accordion Tabs', 'elementor-seosight' ),
            ]
        );
        
        $repeater = new \Elementor\Repeater();

        $repeater->start_controls_tabs( 'accordion_tabs' );

        $repeater->start_controls_tab(
            'accordion_tab_content',
            [
                'label' => __( 'Сontent', 'elementor-seosight' ),
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type'    => \Elementor\Controls_Manager::TEXT,
                'label'   => __( 'Title', 'elementor-seosight' ),
                'default' => __( 'New Accordion Tab', 'elementor-seosight' ),
            ]
        );

        $repeater->add_control(
            'open',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Show as open?', 'elementor-seosight' ),
                'description' => esc_html__( 'Allow accordion tab opened', 'elementor-seosight' ),
                'default'     => 'no',
                'separator'   => 'before'
            ]
        );

        $repeater->add_control(
            'content',
            [
                'type'      => \Elementor\Controls_Manager::WYSIWYG,
                'label'     => __( 'Content', 'elementor-elementor' ),
                'default'   => __( 'Sample Text', 'elementor-elementor' ),
                'separator' => 'before'
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'accordion_tab_style',
            [
                'label' => __( 'Style', 'elementor-seosight' ),
            ]
        );

        $repeater->add_control(
            'tab-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}, {{WRAPPER}} {{CURRENT_ITEM}} p' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tab-typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}, {{WRAPPER}} {{CURRENT_ITEM}} p',
            ]
        );

        $repeater->add_control(
            'tab-align', 
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
                'default'   => 'left',
                'separator' => 'before'
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'tab-background-color',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
                'separator' => 'before'
            ]
        );

        $repeater->add_group_control(
            'border',
            [
                'name'      => 'tab-border',
                'label'     => esc_html__( 'Border', 'elementor-seosight' ),
                'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}}',
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'tab-border-radius',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Border Radius', 'elementor-seosight' ),
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'tab-border_border!' => '',
                ],
            ]
        );

        $repeater->add_control(
            'tab-padding',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Padding', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $repeater->add_control(
            'tab-margin',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Margin', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'accordion_tab_settings',
            [
                'label' => __( 'Settings', 'elementor-seosight' )
            ]
        );

        $repeater->add_control(
            'class',
            [
                'type'  => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__( 'Extra class name', 'elementor-seosight' ),
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'tabs',
            [
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'label'       => __( 'Accordion Tab', 'elementor-seosight' ),
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'accordion-settings-header-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Accordion Settings Header', 'elementor-seosight' )
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'accordion-settings-header-typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .accordion-panel .accordion-heading',
            ]
        );

        $this->add_control(
            'accordion-settings-header-align', 
            [
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'label'     => esc_html__( 'Text Alignment', 'elementor-seosight' ),
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
            'accordion-settings-header-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Text Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-panel .accordion-heading, {{WRAPPER}} .accordion .accordion-heading i' => 'color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'accordion-settings-header-background-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Background Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-panel' => 'background-color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            'border',
            [
                'name'      => 'accordion-settings-header-border',
                'label'     => esc_html__( 'Border', 'elementor-seosight' ),
                'selector'  => '{{WRAPPER}} .accordion-panel',
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'accordion-settings-body-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Accordion Settings Body', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'accordion-settings-body-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .panel-info' => 'color: {{SCHEME}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'accordion-settings-body-typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .panel-info',
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();

        $parent_id = uniqid( 'accordion' );

        $css_classes = [ 'crumina-module', 'crumina-accordion' ];
        if ( ! empty( $settings['class'] ) ) {
            $css_classes[] = $settings['class'];
        }

        $header_align = ! empty( $settings['accordion-settings-header-align'] ) ? es_get_align( $settings['accordion-settings-header-align'] ) : '';
        ?>
        <div class="<?php echo esc_attr( trim( implode( ' ', $css_classes ) ) ); ?>">
            <ul class="accordion-group" id="<?php echo esc_attr( $parent_id ) ?>">
                <?php
                    if ( ! empty( $settings['tabs'] ) ) {
                        foreach ( $settings['tabs'] as $tab ) {
                            $output    = '';
                            $css_class = [ 'accordion-panel' ];

                            $title = ! empty( $tab['title'] ) ? $tab['title'] : 'Title';
                            $open  = ! empty( $tab['open'] ) && $tab['open'] == 'yes' ? 'true' : 'false';
                            $align = ! empty( $tab['tab-align'] ) ? es_get_align( $tab['tab-align'] ) : '';

                            if ( $open == 'true' ) {
                                $panel_heading_class = 'active';
                                $panel_link_class    = '';
                                $panel_content_class = 'collapse in';
                                $css_class[]         = 'active';
                            } else {
                                $panel_heading_class = '';
                                $panel_link_class    = 'collapsed';
                                $panel_content_class = 'collapse';
                            }

                            if ( ! empty( $tab['class'] ) ) {
                                $css_class[] = $tab['class'];
                            }

                            $tab_id = uniqid( 'tab-' );

                            $output.= '<li class="' . esc_attr( implode( ' ', $css_class ) ) . '">';
                            $output.= '<div class="panel-heading ' . esc_attr( $panel_heading_class ) . '" ' . $header_align . '>';
                            $output.= '<a href="#tab-' . esc_attr( $tab_id ) . '" class="accordion-heading ' . esc_attr( $panel_link_class ) . '" data-toggle="collapse" data-parent="#' . esc_attr( $parent_id ) . '" aria-expanded="' . esc_attr( $open ) . '">';
                            $output.= '<span class="icon">';
                            $output.= '<i class="fa fa-angle-right default" aria-hidden="true"></i>';
                            $output.= '</span>';
                            $output.= '<span class="ovh">' . esc_html( $title ) . '</span>';
                            $output.= '</a>';
                            $output.= '</div>';
                            $output.= '<div id="tab-' . esc_attr( $tab_id ) . '" class="panel-collapse ' . esc_attr( $panel_content_class ) . '" aria-expanded="false" role="tree">';
                            $output.= '<div class="panel-info elementor-repeater-item-' . $tab['_id'] . '" ' . $align . '>';
                            if ( ! empty( $tab['content'] ) ) {
                                $output.= $this->parse_text_editor( $tab['content'] );
                            } else {
                                $output.= esc_html__( 'Empty section. Edit page to add content here.', 'elementor-seosight' );
                            }
                            $output.= '</div>';
                            $output.= '</div>';
                            $output.= '</li>';

                            es_render( $output );
                        }
                    }
                ?>
            </ul>
        </div>
        <style>#<?php echo esc_attr( $parent_id ) ?>{padding-left: 0;margin-bottom: 0;}#<?php echo esc_attr( $parent_id ) ?> li{list-style: none;margin-bottom: 0;}</style>
        <?php
    }
}