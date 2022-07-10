<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Seosight_Team extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_team';
	}

	public function get_title() {
		return esc_html__( 'Team member', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-team-member';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$social_network_icons = es_social_network_icons();

		$this->start_controls_section(
			'seosight_team',
			[
				'label' => esc_html__( 'Team member', 'elementor-seosight' ),
			]
        );

		$this->add_control(
			'layout',
			[
				'type'    => \Elementor\Controls_Manager::SELECT,
				'label'   => esc_html__( 'Select Template', 'elementor-seosight' ),
				'options' => [
					'standard-centered' => esc_html__( 'Standard Centered', 'elementor-seosight' ),
					'circles' => esc_html__( 'Circles', 'elementor-seosight' ),
					'company' => esc_html__( 'Company', 'elementor-seosight' ),
					'seo' => esc_html__( 'SEO', 'elementor-seosight' ),
				],
				'default' => 'standard-centered'
			]
		);
        
        $this->add_control(
            'image',
            [
                'type'  => \Elementor\Controls_Manager::MEDIA,
                'label' => esc_html__( 'Avatar Image', 'elementor-seosight' ),
            ]
        );

        $this->add_control(
			'img_size',
			[
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label'       => esc_html__( 'Image Size', 'elementor-seosight' ),
				'description' => esc_html__( 'Set the image size: "full", "thumbnail", "medium", "large" or other size ', 'elementor-seosight' ),
				'options'     => [
					'full'      => esc_html__( 'Full Size', 'elementor-seosight' ),
					'thumbnail' => esc_html__( 'Thumbnail', 'elementor-seosight' ),
					'seosight-thumbnail-large' => esc_html__( 'Thumbnail Large', 'elementor-seosight' ),
					'medium'    => esc_html__( 'Medium', 'elementor-seosight' ),
					'large'     => esc_html__( 'Large', 'elementor-seosight' ),
				],
                'default'     => 'full',
                'separator'   => 'before'
			]
		);

		$this->add_control(
			'title',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Name', 'elementor-seosight' ),
                'default'   => 'Your Name',
                'separator' => 'before'
			]
        );
        
        $this->add_control(
            'subtitle',
            [
                'type'      => \Elementor\Controls_Manager::TEXT,
                'label'     => esc_html__( 'Subtitle', 'elementor-seosight' ),
                'default'   => 'Manager',
                'separator' => 'before'
            ]
        );

		$this->add_control(
            'text',
            [
                'type'      => \Elementor\Controls_Manager::TEXTAREA,
                'label'     => esc_html__( 'Text', 'elementor-seosight' ),
                'default'   => 'Lorem ipsum dolor sit amet, consectetuer adipiscing.',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'link_name',
            [
                'type'      => \Elementor\Controls_Manager::TEXT,
                'label'     => esc_html__( 'Custom link Name', 'elementor-seosight' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'link',
            [
                'type'  => \Elementor\Controls_Manager::URL,
                'label' => esc_html__( 'Custom link', 'elementor-seosight' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'link',
            [
                'type'  => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__( 'Link to profile', 'elementor-seosight' ),
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label'       => esc_html__( 'Select icon', 'elementor-seosight' ),
                'options'     => $social_network_icons,
                'description' => esc_html__( 'Choose an icon to display', 'elementor-seosight' ),
                'default'     => key( $social_network_icons ),
                'separator'   => 'before'
            ]
        );

		$repeater->add_control(
			'icon_grayscale',
			[
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label'     => esc_html__( 'Enable Grayscale', 'elementor-seosight' ),
				'default'   => 'no',
				'separator' => 'before'
			]
		);

        $this->add_control(
			'social_networks',
			[
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'label'       => esc_html__( 'Social networks', 'elementor-seosight' ),
				'description' => esc_html__( 'Links for your social networks profiles', 'elementor-seosight' ),
				'fields'      => $repeater->get_controls(),
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
		    'image-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__('Image', 'elementor-seosight'),
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image-box-shadow',
                'selector' => '{{WRAPPER}} .module-image',
            ]
        );

		$this->add_group_control(
			'border',
			[
                'name'      => 'image-border',
				'label'     => esc_html__( 'Border', 'elementor-seosight' ),
				'selector'  => '{{WRAPPER}} .module-image',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'image-border-radius',
			[
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'label'      => __( 'Border Radius', 'elementor-seosight' ),
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .module-image, {{WRAPPER}} .module-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'image-border_border!' => '',
				],
			]
		);

		$this->add_control(
			'image-width',
			[
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'label'      => __( 'Width', 'elementor-seosight' ),
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'em' => [
						'min' => 1,
						'max' => 100,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .module-image' => 'width: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before'
			]
		);

		$this->add_control(
			'image-height',
			[
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'label'      => __( 'Height', 'elementor-seosight' ),
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'em' => [
						'min' => 1,
						'max' => 100,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .module-image' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before'
			]
		);

		$this->add_control(
			'image-padding',
			[
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'label'      => __( 'Padding', 'elementor-seosight' ),
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .module-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before'
			]
		);

		$this->add_control(
			'image-margin',
			[
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'label'      => __( 'Margin', 'elementor-seosight' ),
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .module-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before'
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
					'{{WRAPPER}} .teammembers-item-name' => 'color: {{SCHEME}};'
				],
                'separator' => 'after'
			]
		);

		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title-typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .teammembers-item-name'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
		    'text-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Subtitle', 'elementor-seosight' ),
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
					'{{WRAPPER}} .teammembers-item-prof' => 'color: {{SCHEME}};'
				],
				'separator' => 'after'
			]
		);

		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'text-typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .teammembers-item-prof'
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
		    'content-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Text', 'elementor-seosight' ),
            ]
        );

		$this->add_control(
			'content-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .teammembers-item-text' => 'color: {{SCHEME}};'
				],
				'separator' => 'after'
			]
		);

		$this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'content-typography',
                'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .teammembers-item-text'
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
		    'box-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Box', 'elementor-seosight' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box-box-shadow',
                'selector' => '{{WRAPPER}}',
            ]
        );

		$this->add_group_control(
			'border',
			[
                'name'      => 'box-border',
				'label'     => esc_html__( 'Border', 'elementor-seosight' ),
				'selector'  => '{{WRAPPER}}',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'box-border-radius',
			[
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'label'      => __( 'Border Radius', 'elementor-seosight' ),
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'box-border_border!' => '',
				],
			]
		);

		$this->add_control(
			'box-padding',
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

		$this->add_control(
			'box-margin',
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

        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$link_att = [];
		$layout = ! empty( $settings['layout'] ) ? $settings['layout'] : 'standard-centered';
		$title    = ! empty( $settings['title'] ) ? $settings['title'] : '';
		$subtitle = ! empty( $settings['subtitle'] ) ? $settings['subtitle'] : '';
		$text = ! empty( $settings['text'] ) ? $settings['text'] : '';

		$wrap_class = [ 'crumina-module', 'crumina-teammembers-item', 'layout-' . $layout ];
		if ( ! empty( $settings['custom_class'] ) ) {
		    $wrap_class[] = $settings['custom_class'];
		}

		if ( ! empty( $settings['link']['url'] ) ) {
	        $link_att[] = 'href="' . esc_attr( $settings['link']['url'] ) . '"';
	        $link_att[] = 'target="' . esc_attr( ! empty( $settings['link']['is_external'] ) ? '_blank' : '_self' ) . '"';
	        $link_att[] = 'title="' . esc_attr( ! empty( $settings['link_name'] ) ? $settings['link_name'] : '' ) . '"';
		    $link_att[] = ! empty( $settings['link']['nofollow'] ) ? 'rel="nofollow"' : '';
		} ?>
		<div class="<?php echo implode( ' ', $wrap_class ); ?>">
			<?php if ( ! empty( $settings['image']['id'] ) ) { ?>
		    	<div class="module-image-cont">
		    	<div class="module-image">
		    		<?php
			        	$img_size = ! empty( $settings['img_size'] ) ? $settings['img_size'] : '';

			            if ( $link_att ) { ?>
			                <a <?php echo implode( ' ', $link_att ); ?>>
			                    <?php echo wp_get_attachment_image( $settings['image']['id'], $img_size ); ?>
			                </a>
			            <?php } else { ?>
				            <?php echo wp_get_attachment_image( $settings['image']['id'], $img_size ); ?>
			        <?php }
				?>
		        </div>
				<?php
					if ( $title && $layout == 'company' ) { ?>
						<h5 class="teammembers-item-name">
							<?php
								if ( $link_att ) {
									echo '<a ' . implode( ' ', $link_att ) . '>' . esc_html( $title ) . '</a>';
								} else {
									echo esc_html( $title );
								}
							?>
						</h5>
				<?php }
					if ( $subtitle && $layout == 'company' ) { ?>
						<p class="teammembers-item-prof"><?php echo esc_html( $subtitle ) ?></p>
				<?php }
					?>
		        </div>
				<div class="teammembers-item-cont">
			<?php }
			    if ( $title && $layout != 'company' ) { ?>
			        <h5 class="teammembers-item-name">
			            <?php
				            if ( $link_att ) {
				                echo '<a ' . implode( ' ', $link_att ) . '>' . esc_html( $title ) . '</a>';
				            } else {
				                echo esc_html( $title );
				            }
			            ?>
			        </h5>
		    <?php }
		    	if ( $subtitle && $layout != 'company' ) { ?>
		        	<p class="teammembers-item-prof"><?php echo esc_html( $subtitle ) ?></p>
			<?php }
				if ( $text ) { ?>
				<p class="teammembers-item-text"><?php echo esc_html( $text ) ?></p>
			<?php }

			    if ( ! empty( $settings['social_networks'] ) ) {
			        echo '<div class="socials">';
			        foreach ( $settings['social_networks'] as $item ) {
						$grey = ( isset($item['icon_grayscale']) && $item['icon_grayscale'] == 'yes' ) ? 'grey' : '';
			            echo '<a href="' . esc_url( $item['link'] ) . '" class="social__item '.esc_attr($grey).'">';
			            echo '<img src="' . ES_PLUGIN_URL . '/assets/images/' . esc_attr( $item['icon'] ) . '" alt="' . esc_attr( $item['icon'] ) . '" width="24" height="24" loading="lazy">';
			            echo '</a>';
			        }
			        echo '</div>';
			    }
		    ?>
				</div>
		</div>
		<?php
    }
}