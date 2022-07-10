<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_Clients_Slider extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_clients_slider';
	}

	public function get_title() {
		return esc_html__( 'Clients Slider', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-clients-slider';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_clients_slider',
			[
				'label' => esc_html__( 'Clients Slider', 'elementor-seosight' ),
			]
		);

		$this->add_control(
			'number_of_items',
			[
                'type'        => \Elementor\Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Items per page', 'elementor-seosight' ),
                'description' => esc_html__( 'Number of items displayed on one screen', 'elementor-seosight' ),
                'size_units'  => [ 'px' ],
                'range'       => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 10,
                        'step' => 1
                    ]
                ],
                'default'     => [
                    'unit' => 'px',
                    'size' => 4
                ]
			]
        );

        $this->add_control(
            'arrows',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Show Arrows', 'elementor-seosight' ),
                'description' => esc_html__( 'Previous/ Next Slider buttons', 'elementor-seosight' ),
                'default'     => 'yes',
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'dots',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Show Dots', 'elementor-seosight' ),
                'description' => esc_html__( 'Pagination dots', 'elementor-seosight' ),
                'default'     => 'no',
                'condition'   => [
                    'arrows!' => 'yes'
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'autoscroll',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Autoslide', 'elementor-seosight' ),
                'description' => esc_html__( 'Automatic auto scroll slides', 'elementor-seosight' ),
                'default'     => 'no',
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'time',
            [
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'label'       => esc_html__( 'Delay between scroll', 'elementor-seosight' ),
                'size_units'  => [ 'px' ],
                'range'       => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 30,
                        'step' => 1
                    ]
                ],
                'default'     => [
                    'unit' => 'px',
                    'size' => 5
                ],
                'condition'   => [
                    'autoscroll' => 'yes'
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'custom_class',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Custom class', 'elementor-seosight' ),
                'description' => esc_html__( 'Enter extra custom class', 'elementor-seosight' ),
                'separator'   => 'before'
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'items',
			[
				'label' => esc_html__( 'Slider items', 'elementor-seosight' ),
			]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image', 
            [
                'type'  => \Elementor\Controls_Manager::MEDIA,
                'label' => esc_html__( 'Client logo', 'elementor-seosight' )
            ]
        );

        $repeater->add_control(
            'link_name',
            [
                'type'      => \Elementor\Controls_Manager::TEXT,
                'label'     => esc_html__( 'Custom link name', 'elementor-seosight' ),
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'link', 
            [
                'type'  => \Elementor\Controls_Manager::URL,
                'label' => esc_html__( 'Custom link', 'elementor-seosight' ),
            ]
        );

        $this->add_control(
			'options',
			[
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'label'       => esc_html__( 'Slider items', 'elementor-seosight' ),
				'fields'      => $repeater->get_controls(),
                'description' => esc_html__( 'Repeat this fields with each item created, Each item corresponding slider element.', 'lementor-seosight' ),
			]
		);
    
        $this->end_controls_section();

        $this->start_controls_section(
            'style-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Main params', 'elementor-seosight' ),
            ]
        );

        $this->add_control(
            'style-padding',
            [
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'label'      => __( 'Padding', 'elementor-seosight' ),
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'style-margin',
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

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'style-background',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}}',
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            'border',
            [
                'name'      => 'style-border',
                'label'     => esc_html__( 'Border', 'elementor-seosight' ),
                'selector'  => '{{WRAPPER}}',
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
                    '{{WRAPPER}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'style-border_border!' => '',
                ],
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {
        $slider_attr = [];
		$show_items_attr = '';
        
        $settings = $this->get_settings_for_display();

        $wrap_class = [ 'clients-slider-module', 'crumina-module', 'crumina-module-slider' ];
        if ( ! empty( $settings['custom_class'] ) ) {
            $wrap_class[] = $settings['custom_class'];
        }

        if ( ! empty( $settings['number_of_items']['size'] ) ) {
	        $show_items_attr = 'data-show-items="' . esc_attr( $settings['number_of_items']['size'] ) . '"';
        }

        if ( ! empty( $settings['autoscroll'] ) && $settings['autoscroll'] == 'yes' ) {
            $time = ! empty( $settings['time']['size'] ) ? $settings['time']['size'] : 0;
            $slider_attr[] = 'data-autoplay="' . esc_attr( intval( $time ) * 1000 ) . '"';
        }
        
        if ( ! empty( $settings['arrows'] ) && $settings['arrows'] == 'yes' ) {
            $pagination_class = 'pagination-bottom-large';
	        $slider_attr[] = 'data-prev-next="1"';
        } elseif ( ! empty( $settings['dots'] ) && $settings['dots'] == 'yes' ) {
            $pagination_class = 'pagination-bottom';
        } else {
            $pagination_class = '';
        } ?>
        <div class="<?php echo implode( ' ', $wrap_class ); ?>">
            <?php if ( ! empty( $settings['options'] ) ) {
                $slides_count = intval(count($settings['options']));
	            if ( $slides_count < $settings['number_of_items']['size'] ) {
		            $show_items_attr = 'data-show-items="' . esc_attr( $slides_count ) . '"';
                }

	            $slider_attr[] = $show_items_attr;
                ?>
                <div class="swiper-container <?php echo esc_attr( $pagination_class ) ?>" <?php echo implode( ' ', $slider_attr ); ?>>
                    <div class="swiper-wrapper">
                        <?php
                            foreach ( $settings['options'] as $option ) {
                                if ( ! empty( $option['image']['url'] ) ) {
                                    $has_link = false;
                                    $link_att = [ 'class="client-image"' ];

                                    if ( ! empty( $option['link']['url'] ) ) {
                                        $has_link   = true;
                                        $link_att[] = 'href="' . esc_attr( $option['link']['url'] ) . '"';
                                        $link_att[] = 'target="' . esc_attr( ! empty( $option['link']['is_external'] ) ? '_blank' : '_self' ) . '"';
                                        $link_att[] = 'title="' . esc_attr( ! empty( $option['link_name'] ) ? $option['link_name'] : '' ) . '"';
                                        $link_att[] = ! empty( $option['link']['nofollow'] ) ? 'rel="nofollow"' : '';
                                    }
                                    ?>
                                    <div class="swiper-slide client-item">
                                        <?php
                                            if ( $has_link ) {
                                                echo '<a ' . implode( ' ', $link_att ) . '>';
                                                echo wp_get_attachment_image( $option['image']['id'], 'full',false, array('class'=>"hover") );
                                                echo '</a>';
                                            } else {
	                                            echo wp_get_attachment_image( $option['image']['id'], 'full',false, array('class'=>"hover") );
                                            }
                                        ?>
                                    </div>
                                <?php }
                            }
                        ?>
                    </div>
                    <?php if ( ! empty( $settings['arrows'] ) && $settings['arrows'] == 'yes' ) { ?>
                        <svg class="btn-next swiper-btn-next">
                            <use xlink:href="#arrow-right"></use>
                        </svg>
                        <svg class="btn-prev swiper-btn-prev">
                            <use xlink:href="#arrow-left"></use>
                        </svg>
                    <?php } elseif ( ! empty( $settings['dots'] ) && $settings['dots'] == 'yes' ) { ?>
                        <div class="swiper-pagination"></div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

        <?php
        if(is_admin()) { ?>
            <script>
                jQuery( function ( $ ) {
                    CRUMINA.Swiper.init();
                });
            </script>
        <?php   }
    }
}