<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_Progress_Bar extends \Elementor\Widget_Base {
    public function get_name() {
		return 'seosight_progress_bar';
	}

	public function get_title() {
		return esc_html__( 'Progress Bar', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-progress-bar';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {
        $this->start_controls_section(
			'seosight_progress_bar',
			[
				'label' => esc_html__( 'Progress Bar', 'elementor-seosight' )
			]
		);

        $this->add_control(
            'label',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Label', 'elementor-seosight' ),
                'description' => esc_html__( 'Enter text used as title of the bar.' )
            ]
        );

        $this->add_control(
            'value',
            [
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'label'       => esc_html__( 'Value', 'elementor-seosight' ),
                'description' => esc_html__( 'Enter targeted value of the bar (From 1 to 100).', 'elementor-seosight' ),
                'default'     => [
                    'size' => 80,
                    'unit' => '%',
                ],
                'range'       => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
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
            'bar-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Progress Bar', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'bar-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .skills-item .skills-item-meter-active' => 'background-color: {{SCHEME}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'bar-bgcolor',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Background Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .skills-item .skills-item-meter' => 'background-color: {{SCHEME}};'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'label-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Label', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'label-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .skills-item .skills-item-title' => 'color: {{SCHEME}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'label_typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .skills-item .skills-item-title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'number-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Percent', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'number-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .skills-item-info .units, {{WRAPPER}} .skills-item-info .count-animate' => 'color: {{SCHEME}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'number_typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .skills-item-info .units, {{WRAPPER}} .skills-item-info .count-animate',
            ]
        );

        $this->end_controls_section();
    }
	
    protected function render() {
        $settings = $this->get_settings_for_display();

        $wrap_class   = [ 'crumina-module', 'crumina-module-progress-bar', 'js-run-skills-item' ];
        if ( ! empty( $settings['wrap_class'] ) ) {
            $wrap_class[] = $settings['wrap_class'];
        }
        
        $label = ! empty( $settings['label'] ) ? $settings['label'] : esc_html__( 'Label default', 'elementor-seosight' );
        $value = ! empty( $settings['value']['size'] ) ? $settings['value']['size'] : 50;

        $prob_style = '';
        $prob_style .= 'width: '.$value.'%';
        ?>
        <div class="<?php echo esc_attr( implode( ' ', $wrap_class ) ) ?>">
            <div class="skills-item">
                <div class="skills-item-info">
                    <span class="units">%</span></span>
                    <span class="count-animate" data-speed="1000" data-refresh-interval="50" data-to="<?php echo esc_attr( $value ); ?>" data-from="0"><?php echo esc_html( $value ); ?></span>
                </div>
                <div class="skills-item-meter">
                    <span class="skills-item-meter-active bg-primary-color border-primary-color skills-animate"<?php echo 'style="' . esc_attr( $prob_style ) . '"'; ?>></span>
                </div>
                <div class="skills-item-info">
                    <span class="skills-item-title"><?php echo esc_html( $label ); ?></span>
                </div>
            </div>
        </div>
        <?php
    }
}