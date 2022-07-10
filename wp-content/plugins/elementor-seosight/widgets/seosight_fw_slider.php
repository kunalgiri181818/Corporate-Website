<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class Elementor_Seosight_FW_Slider extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_fw_slider';
	}

	public function get_title() {
		return esc_html__( 'Slider', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$sliders = get_posts(
			array(
				'post_type'   => 'fw-slider',
				'numberposts' => - 1
			)
		);
		$choices = [];
		if ( ! empty( $sliders ) ) {
			foreach ( $sliders as $slider ) {
				$choices[ $slider->ID ] = empty( $slider->post_title ) ? esc_html__( '(no title)', 'seosight' ) : $slider->post_title;
			}
		}
		$this->start_controls_section(
			'seosight_fw_slider_main',
			[
				'label' => esc_html__( 'Slider', 'elementor-seosight' ),
			]
		);

		$this->add_control(
			'slider',
			[
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label'       => esc_html__( 'Select Slider', 'elementor-seosight' ),
				'description' => esc_html__( 'You can edit sliders in admin interface only.', 'elementor-seosight' ),
				'options'     => $choices
			]
		);
		$this->end_controls_section();


	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$slider_id = $settings['slider'];
		if ( empty( $slider_id ) ) {
			return;
		}

		if ( defined( 'FW' ) ) {
			echo fw()->extensions->get( 'slider' )->render_slider( $slider_id, array() );
		}


		if ( is_admin() ) { ?>
            <script>
                jQuery(function ($) {
                    CRUMINA.Swiper.init();
                });
            </script>
		<?php }

	}
}