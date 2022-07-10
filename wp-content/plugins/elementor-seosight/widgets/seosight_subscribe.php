<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Seosight_Subscribe extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_subscribe';
	}

	public function get_title() {
		return esc_html__( 'Subscribe form', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-form';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {
        $this->start_controls_section(
			'seosight_subscribe',
			[
				'label' => esc_html__( 'Subscribe form', 'elementor-seosight' ),
			]
		);

        $this->add_control(
			'layout',
			[
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label'       => esc_html__( 'Select Template', 'elementor-seosight' ),
				'options' => [
					'agency' => esc_html__( 'Agency', 'elementor-seosight' ),
				],
				'default' => 'agency',
                'separator'   => 'before',
			]
		);

        $this->add_control(
            'title',
            [
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Title', 'elementor-seosight'),
				'default'   => esc_html__( 'Subscribe form', 'elementor-seosight' ),
                'separator' => 'before'
            ]
		);

        $this->add_control(
			'description',
			[
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'label'     => esc_html__( 'Description',  'elementor-seosight' ),
                'description' => esc_html__( 'Text that display after subscribe form.', 'elementor-seosight' ),
				'separator' => 'before'
			]
		);

        $this->add_control(
			'form',
			[
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'label'     => esc_html__( 'Form',  'elementor-seosight' ),
                'description' => esc_html__( 'You can use any custom HTML or shortcode here.', 'elementor-seosight' ),
				'separator' => 'before'
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
					'{{WRAPPER}} .crumina-subscribe-panel-title' => 'color: {{SCHEME}};'
				],
				'separator' => 'after'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .crumina-subscribe-panel-title',
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'description-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Description', 'elementor-seosight' ),
			]
        );

		$this->add_control(
			'description-color',
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
				'name'     => 'description_typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .heading-title',
			]
		);

		$this->end_controls_section();
    }

	protected function render() {
		$settings = $this->get_settings_for_display();

		$title = ! empty( $settings['title'] ) ? $settings['title'] : '';
		$layout = ! empty( $settings['layout'] ) ? $settings['layout'] : 'agency';
		$form = ! empty( $settings['form'] ) ? $settings['form'] : '';
		$wrap_class = [ 'crumina-module', 'crumina-subscribe-panel', 'subscribe-panel-' . $layout ];

        ?>
        <div class="<?php echo esc_attr( implode( ' ', $wrap_class ) ); ?>">
            <?php if ( $title != '' ) { ?>
            <h2 class="crumina-subscribe-panel-title"><?php echo esc_html($title); ?></h2>
            <?php } ?>

            <?php if ( $form != '' ) { ?>
            <div class="crumina-subscribe-panel-form">
                <?php echo( do_shortcode( $form ) ); ?>
            </div>
            <?php } ?>

        </div>
        <?php
    }
}