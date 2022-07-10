<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_Social_Links extends \Elementor\Widget_Base {
    public function get_name() {
		return 'seosight_social_links';
	}

    public function get_title() {
		return esc_html__( 'Social Links', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-share-page-buttons';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {
        $this->start_controls_section(
			'seosight_social',
			[
				'label' => esc_html__( 'Social Links', 'elementor-seosight' )
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
                'type'        => \Elementor\Controls_Manager::ICONS,
                'label'       => esc_html__( 'Icon', 'elementor-seosight' ),
                'description' => esc_html__( 'Select icon for share button', 'elementor-seosight' ),
				'default'     => [
                    'value'   => 'fas fa-leaf',
                    'library' => 'fa-solid',
                ],
                'separator'   => 'before'
            ]
        );

        $repeater->add_control(
			'link',
			[
				'type'        => \Elementor\Controls_Manager::URL,
				'description' => esc_html__( 'The URL which image assigned to. You can select page/post or other post type', 'elementor-seosight' ),
				'default'     => [
					'url' => '#'
                ],
                'separator'   => 'before'
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
                'separator'   => 'before',
                'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{SCHEME}};'
				],
            ]
        );

        $this->add_control(
            'icons',
            [
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'label'       => esc_html__( 'Icons', 'elementor-seosight' ),
                'description' => esc_html__( 'Repeat this fields with each item created, Each item corresponding an icon element.', 'elementor-seosight' ),
                'fields'      => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings_for_display();

        if ( ! empty( $settings['icons'] ) ) {
            $css_class = [ 'seosight-social-links-wrapper' ];
            if ( ! empty( $settings['custom_class'] ) ) {
                $css_class[] = $settings['custom_class'];
            }
            ?>
            <div class="<?php echo esc_attr( implode( " ", $css_class ) ); ?>">
                <?php
                    foreach ( $settings['icons'] as $icon ) {
                        $service = ! empty( $icon['service']['value'] ) ? $icon['service']['value'] : '';
                        $icn_html = '<i class="es-icon-2 ' . esc_attr( $service ) . '"></i>';
                        if( isset($icon['service']['library']) && $icon['service']['library'] == 'svg' ){
                            $service = ! empty( $icon['service']['value']['url'] ) ? $icon['service']['value']['url'] : '';
                            $icn_html = '<img src="' . esc_attr( $service ) . '"/>';
                        }
                        $color    = ! empty( $icon['color'] ) ? $icon['color'] : '';

                        if ( ! empty( $icon['link']['url'] ) ) {
                            $button_attr[] = 'href="' . esc_attr( $icon['link']['url'] ) . '"';
                            $button_attr[] = 'target="'. ( ! empty( $icon['link']['is_external'] ) ? '_blank' : '_self' ) . '"';
                            $button_attr[] = ! empty( $icon['link_name'] ) ? $icon['link_name'] : '';
                            $button_attr[] = ! empty( $icon['link']['nofollow'] ) ? 'rel="nofollow"' : '';
                        } else {
                            $button_attr[] = 'href="#"';
                        }
                    ?>
                    <a <?php echo implode( ' ', $button_attr ); ?> class="<?php echo 'elementor-repeater-item-' . $icon['_id']; ?>">
                        <?php echo $icn_html; ?>
                    </a>
                    <?php
                    }
                ?>
            </div>
            <?php
        }
    }
}