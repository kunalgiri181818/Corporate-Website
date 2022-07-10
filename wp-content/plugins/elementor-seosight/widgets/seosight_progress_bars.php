<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_Progress_Bars extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_progress_bars';
	}

	public function get_title() {
		return esc_html__( 'Progress Bars Block', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-progress-bar';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_progress_bars',
			[
				'label' => esc_html__( 'Progress Bar', 'elementor-seosight' )
			]
		);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'label',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Label', 'elementor-seosight' ),
                'description' => esc_html__( 'Enter text used as title of the bar.' )
            ]
        );

        $repeater->add_control(
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

        $repeater->add_control(
            'prob_color',
            [
                'type'        => \Elementor\Controls_Manager::COLOR,
                'label'       => esc_html__( 'Progressbar Color', 'elementor-seosight' ),
                'description' => esc_html__( 'Customized progress bar color.', 'elementor-seosight' ) . esc_html__( 'More options you will find in Styling tab.', 'elementor-seosight' ),
                'scheme'      => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .skills-item-meter-active:after' => 'border: 4px solid {{SCHEME}};',
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'options',
            [
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'label'       => esc_html__( 'Options', 'elementor-seosight' ),
                'description' => esc_html__( 'Repeat this fields with each item created, Each item corresponding progressbar element.', 'elementor-seosight' ),
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ label }}}',
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
            'element-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Element background', 'elementor-seosight' )
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'element-background-color',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .skills-item .skills-item-meter',
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
            'value-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Value', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'value-color',
            [
                'type'      => \Elementor\Controls_Manager::COLOR,
                'label'     => esc_html__( 'Color', 'elementor-seosight' ),
                'scheme'    => [
                    'type'  => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .skills-item .skills-item-count' => 'color: {{SCHEME}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'value_typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .skills-item .skills-item-count',
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();

        if ( ! empty( $settings['options'] ) ) {
            $wrap_class   = [ 'crumina-module', 'skills', 'js-run-skills-item' ];
            if ( ! empty( $settings['wrap_class'] ) ) {
                $wrap_class[] = $settings['wrap_class'];
            } ?>

            <div class="<?php echo esc_attr( implode( ' ', $wrap_class ) ) ?>">
                <?php
                    foreach ( $settings['options'] as $option ) {
                        $value      = ! empty( $option['value']['size'] ) ? $option['value']['size'] : 50;
                        $label      = ! empty( $option['label'] ) ? $option['label'] : esc_html__( 'Label default', 'elementor-seosight' );
                        $prob_color = ! empty( $option['prob_color'] ) ? $option['prob_color'] : '';

                        $prob_style = '';
                        if ( $prob_color ) {
                            $prob_style.= 'background-color: ' . $prob_color . ';border-color: ' . $prob_color . ';';
                        }
                        $prob_style .= 'width: ' . $value . '%';

                        $value_color_style = '';
                        if ( ! empty( $option['value-color'] ) ) {
                            $value_color_style = ' color: ' . esc_attr( $option['value-color'] ) . '"';
                        }
                    ?>
                        <div class="skills-item <?php echo 'elementor-repeater-item-' . $option['_id']; ?>">
                            <div class="skills-item-info">
                                <span class="skills-item-title"><?php echo esc_html( $label ); ?></span>
                                <span class="skills-item-count">
                                <span class="count-animate" data-speed="1000" data-refresh-interval="50" data-to="<?php echo esc_attr( $value ) ?>" data-from="0"><?php echo esc_html( $value ) ?></span>
                                <span class="units" <?php es_render($value_color_style); ?>>%</span></span>
                            </div>
                            <div class="skills-item-meter">
                                <span class="skills-item-meter-active bg-primary-color border-primary-color skills-animate"<?php echo 'style="' . esc_attr( $prob_style ) . '"'; ?>></span>
                            </div>
                        </div>
                <?php } ?>
            </div>
        <?php
        }
    }
}