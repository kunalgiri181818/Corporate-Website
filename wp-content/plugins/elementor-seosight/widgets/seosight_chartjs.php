<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_Chartjs extends \Elementor\Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

			wp_register_script('chart-js',get_template_directory_uri() . '/js/chart.min.js',[],'2.7.1',true );

	}

	public function get_script_depends() {
		return [ 'chart-js' ];
	}

	public function get_name() {
		return 'seosight_chartjs';
	}

	public function get_title() {
		return esc_html__( 'Chart JS module', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-chart-JS-module';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {
	
		$this->start_controls_section(
			'seosight_chartjs',
			[
				'label' => esc_html__( 'Chart JS module', 'elementor-seosight' ),
			]
		);
		
		$this->add_control(
			'chart_type', 
			[
				'type'    => \Elementor\Controls_Manager::SELECT,
				'label'   => esc_html__( 'Chart type', 'elementor-seosight' ),
				'options' => [
					'doughnut'  => esc_html__( 'Doughnut', 'elementor-seosight' ),
					'pie'       => esc_html__( 'Pie', 'elementor-seosight' ),
					'polarArea' => esc_html__( 'Polar Area', 'elementor-seosight' ),
					'line'      => esc_html__( 'Line', 'elementor-seosight' ),
					'bar'       => esc_html__( 'Bar', 'elementor-seosight' ),
				],
				'default' => 'doughnut'
			]
		);

		$this->add_control(
			'hide_labels',
			[
				'type'        => \Elementor\Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Hide Labels ?', 'elementor-seosight' ),
				'description' => esc_html__( 'Hide chart legend labels', 'elementor-seosight' ),
                'default'     => 'no',
                'separator'   => 'before'
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'label',
			[
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Label', 'elementor-seosight' ),
				'description' => esc_html__( 'Enter text used as title of the bar', 'elementor-seosight' )
			]
		);

		$repeater->add_control(
			'value',
			[
				'type'        => \Elementor\Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Value', 'elementor-seosight' ),
				'description' => esc_html__( 'Enter targeted value', 'elementor-seosight' ),
				'size_units'  => [ '%' ],
				'range'       => [
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1
					]
				],
				'default'     => [
					'unit' => '%',
					'size' => 80
				],
				'separator'   => 'before'
			]
		);

		$repeater->add_control(
		    'prob_color',
            [
                'type'        => \Elementor\Controls_Manager::COLOR,
                'label'       => esc_html__( 'Color', 'elementor-seosight' ),
                'description' => esc_html__( 'Customized color.', 'elementor-seosight' ),
				'scheme'      => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'separator'   => 'before'
            ]
        );

		$this->add_control(
			'options',
			[
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'label'       => esc_html__( 'Chart options', 'elementor-seosight' ),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ label }}}',
				'separator'   => 'before'
			]
		);

		$this->add_control(
            'wrap_class',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Wrapper class name', 'elementor-seosight' ),
                'description' => esc_html__( 'Custom class for wrapper of the shortcode widget.', 'elementor-seosight' ),
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
				'selector' => '{{WRAPPER}} .points-item-count, {{WRAPPER}} .points-item-count .c-gray',
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
                    '{{WRAPPER}} .points-item-count, {{WRAPPER}} .points-item-count .c-gray' => 'color: {{SCHEME}};'
                ],
                'separator' => 'before'
            ]
        );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$random_id          = uniqid( 'js_chart_module_' );
		$chart_type         = ! empty( $settings['chart_type'] ) ? $settings['chart_type'] : '';
		$hide_labels        = ! empty( $settings['hide_labels'] ) ? $settings['hide_labels'] : '';
		$progress_bar_color = get_theme_mod( 'primary_color', '#4cc2c0' );

		$el_classes = [ 'crumina-module', 'chart-js', 'chart-js-run' ];
		if ( ! empty( $settings['wrap_class'] ) ) {
            $el_classes[] = $settings['wrap_class'];
        }

        $js_data_number = $js_data_label = $js_data_color = [];

        $element_attributes = [
        	'id="wrap_' . esc_attr( $random_id ) . '"',
        	'data-id="' . esc_attr( $random_id ) . '"',
        	'data-type="' . esc_attr( $chart_type ) . '"',
        	'class="' . esc_attr( implode( ' ', $el_classes ) ) . '"'
        ]; ?>

		<div <?php echo implode( ' ', $element_attributes ) ?>>
			<canvas id="<?php echo esc_attr( $random_id ) ?>" width="1000" height="1000"></canvas>
			<?php if ( ! empty( $settings['options'] ) ) { ?>
				<div class="points">
					<?php
						foreach ( $settings['options'] as $option ) {
							$label      = ! empty( $option['label'] ) ? $option['label'] : 'Label default';
							$value      = ! empty( $option['value']['size'] ) ? $option['value']['size'] : 80;
							$prob_color = ! empty( $option['prob_color'] ) ? $option['prob_color'] : '';

							$js_data_number[] = esc_attr( intval( $value ) );
							$js_data_label[]  = '"' . esc_attr( $label ) . '"';
							$js_data_color[]  = '"' . esc_attr( $prob_color ) . '"';

							if ( $hide_labels != 'yes' ) {
								$prob_style = '';
								if ( $prob_color ) {
									$prob_style = 'style="background-color: ' . $prob_color . ';"';
								}
								?>
								<div class="points-item">
									<div class="points-item-count">
										<span class="point-sircle bg-primary-color" <?php echo $prob_style; ?>></span><?php echo esc_html( $value ); ?>
										<span class="c-gray"> - <?php echo esc_html( $label ); ?></span>
									</div>
								</div>
							<?php }
						}
					?>
				</div>
				<div class='chart-data' data-borderColor='<?php echo esc_attr( $progress_bar_color ); ?>' data-labels='[<?php echo implode( ',', $js_data_label ); ?>]' data-numbers='[<?php echo implode( ',', $js_data_number );  ?>]' data-colors='[<?php echo implode( ',', $js_data_color );  ?>]'></div>
			<?php
			if(is_admin()) { ?>
				<script>
					jQuery( function ( $ ) {
						CRUMINA.chartJs();
					});
				</script>
			<?php   }
			 }	?>
		</div>
		<?php
	}
}