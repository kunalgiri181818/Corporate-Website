<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_Triple_Image extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_triple_image';
	}

	public function get_title() {
		return esc_html__( 'Triple images', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-triple-image';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_triple_image',
			[
				'label' => esc_html__( 'Triple images', 'elementor-seosight' )
			]
		);

        $this->add_control(
            'image',
            [
                'type'  => \Elementor\Controls_Manager::MEDIA,
                'label' => esc_html__( 'Main Image', 'elementor-seosight' )
            ]
        );

        $this->add_control(
            'left_image',
            [
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'label'     => esc_html__( 'Left Image', 'elementor-seosight' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'right_image',
            [
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'label'     => esc_html__( 'Right Image', 'elementor-seosight' ),
                'separator' => 'before'
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
                'label' => esc_html__( 'Element style', 'elementor-seosight' )
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'element-box-shadow',
                'selector' => '{{WRAPPER}} .shadow-image',
            ]
        );

        $this->add_control(
            'element-border-radius',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Border Radius', 'elementor-seosight' ),
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_control(
            'element-margin',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Margin', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_control(
            'element-padding',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Padding', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before'
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();

        $el_class = [ 'crumina-module', 'triple-images' ];
        if ( ! empty( $settings['wrap_class'] ) ) {
            $el_class[] = $settings['wrap_class'];
        }
        ?>
        <div class="<?php echo esc_attr( implode( ' ', $el_class ) ) ?>">
            <div class="triple-images-thumb">
                <?php
                    if ( ! empty( $settings['image']['id'] ) ) {
                        echo wp_get_attachment_image( $settings['image']['id'], array( '740', '580' ), '', array( 'class' => 'shadow-image' ) );
                    }
                ?>
            </div>
            <?php
                if ( ! empty( $settings['left_image']['id'] ) ) {
                    echo wp_get_attachment_image( $settings['left_image']['id'], array( '670', '400' ), '', array( 'class' => 'first' ) );
                }
                if ( ! empty( $settings['right_image']['id'] ) ) {
                    echo wp_get_attachment_image( $settings['right_image']['id'], array( '670', '400' ), '', array( 'class' => 'last' ) );
                }
            ?>
        </div>
        <?php
    }
}