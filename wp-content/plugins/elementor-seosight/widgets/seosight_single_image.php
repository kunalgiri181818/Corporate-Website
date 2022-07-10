<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Seosight_Single_Image extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_single_image';
	}

	public function get_title() {
		return esc_html__( 'Single image', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-single-image';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_single_image',
			[
				'label' => esc_html__( 'Single image', 'elementor-seosight' )
			]
		);

		$this->add_control(
			'image_source',
			[
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label'       => esc_html__( 'Image Source', 'elementor-seosight' ),
				'description' => esc_html__( 'Select image source.', 'elementor-seosight' ),
				'options'     => [
					'media_library'  => esc_html__( 'Media library', 'elementor-seosight' ),
					'external_link'  => esc_html__( 'External link', 'elementor-seosight' ),
					'featured_image' => esc_html__( 'Featured Image', 'elementor-seosight' ),
				],
				'default'     => 'media_library'
			]
		);

		$this->add_control(
			'image',
			[
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'label'     => esc_html__( 'Upload Image', 'elementor-seosight' ),
				'condition' => [
					'image_source' => 'media_library',
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'image_external_link',
			[
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Link', 'elementor-seosight' ),
				'description' => esc_html__( 'Enter external link.', 'elementor-seosight' ),
				'condition'   => [
					'image_source' => 'external_link',
				],
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'image_size',
			[
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Size', 'elementor-seosight' ),
				'description' => esc_html__( 'Set the image size: "thumbnail", "medium", "large", "full" or "400x200"', 'elementor-seosight' ),
				'condition'   => [
					'image_source' => 'media_library',
				],
				'default'     => 'full',
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'image_size_el',
			[
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Size', 'elementor-seosight' ),
				'description' => esc_html__( 'Enter the image size in pixels. Example: 200x100 (Width x Height).', 'elementor-seosight' ),
				'condition'   => [
					'image_source' => 'external_link',
				],
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'alt',
			[
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Alt', 'elementor-seosight' ),
				'description' => esc_html__( 'Enter the image alt property.', 'elementor-seosight' ),
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'caption',
			[
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Caption', 'elementor-seosight' ),
				'description' => esc_html__( 'Enter the image caption text.', 'elementor-seosight' ),
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'align',
			[
				'type'        => \Elementor\Controls_Manager::CHOOSE,
				'label'       => esc_html__( 'Align', 'elementor-seosight' ),
				'description' => esc_html__( 'The horizontal alignment of elements', 'elementor-seosight' ),
				'options'     => [
					'alignleft'   => [
						'title' => esc_html__( 'Left', 'elementor-seosight' ),
						'icon'  => 'fa fa-align-left',
					],
					'aligncenter' => [
						'title' => esc_html__( 'Centered', 'elementor-seosight' ),
						'icon'  => 'fa fa-align-center',
					],
					'alignright'  => [
						'title' => esc_html__( 'Right', 'elementor-seosight' ),
						'icon'  => 'fa fa-align-right',
					]
				],
				'default'     => 'center',
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'on_click_action',
			[
				'type'        => \Elementor\Controls_Manager::SELECT,
				'label'       => esc_html__( 'On click event', 'elementor-seosight' ),
				'description' => esc_html__( 'Select the click event when users click on the image.', 'elementor-seosight' ),
				'options'     => [
					''                 => esc_html__( 'None', 'elementor-seosight' ),
					'op_large_image'   => esc_html__( 'Link to large image', 'elementor-seosight' ),
					'lightbox'         => esc_html__( 'Open Image In Lightbox', 'elementor-seosight' ),
					'open_custom_link' => esc_html__( 'Open Custom Link', 'elementor-seosight' )
				],
				'default'     => '',
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'custom_link_name',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Custom Link Name', 'elementor-seosight' ),
				'condition' => [
					'on_click_action' => 'open_custom_link',
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'custom_link',
			[
				'type'        => \Elementor\Controls_Manager::URL,
				'label'       => esc_html__( 'Custom Link', 'elementor-seosight' ),
				'description' => esc_html__( 'The URL which image assigned to. You can select page/post or other post type', 'elementor-seosight' ),
				'condition'   => [
					'on_click_action' => 'open_custom_link',
				],
				'default'     => [
					'url' => '#'
				]
			]
		);

		$this->add_control(
			'class',
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
				'selector' => '{{WRAPPER}} img',
			]
		);

		$this->add_group_control(
			'border',
			[
				'name'      => 'element-border',
				'label'     => esc_html__( 'Border', 'elementor-seosight' ),
				'selector'  => '{{WRAPPER}} img',
				'separator' => 'before'
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
				'condition'  => [
					'element-border_border!' => '',
				],
			]
		);

		$this->add_control(
			'element-width',
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
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before'
			]
		);

		$this->add_control(
			'element-height',
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
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before'
			]
		);

		$this->add_control(
			'element-max-width',
			[
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'label'      => __( 'Max Width', 'elementor-seosight' ),
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
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} img' => 'max-width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'text-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Text style', 'elementor-seosight' )
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
					'{{WRAPPER}} .wp-caption-text' => 'color: {{SCHEME}};'
				],
				'separator' => 'after'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'text-typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .wp-caption-text',
			]
		);

		$this->add_control(
			'text-align',
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
				'default'   => 'center',
				'separator' => 'before'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'box-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Box', 'elementor-seosight' )
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'box-background-color',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}}',
			]
		);

		$this->add_group_control(
			'border',
			[
				'name'      => 'box-border',
				'label'     => esc_html__( 'Border', 'elementor-seosight' ),
				'selector'  => '{{WRAPPER}} img',
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
					'{{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'box-border_border!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$caption_html     = $target = $nofollow = '';
		$image_attributes = $image_classes = [];

		$image_full = $image_url = ! empty( $settings['image']['url'] ) ? $settings['image']['url'] : '';

		$image_source    = ! empty( $settings['image_source'] ) ? $settings['image_source'] : '';
		$image_id        = ! empty( $settings['image']['id'] ) ? $settings['image']['id'] : 0;
		$image_size      = ! empty( $settings['image_size'] ) ? $settings['image_size'] : '';
		$on_click_action = ! empty( $settings['on_click_action'] ) ? $settings['on_click_action'] : '';
		$text_align      = ! empty( $settings['text-align'] ) ? es_get_align( $settings['text-align'] ) : '';

		$css_classes = [ 'crumina-module', 'single-image' ];
		if ( ! empty( $settings['class'] ) ) {
			$css_classes[] = $settings['class'];
		}

		if ( $image_source == 'featured_image' ) {
			$post_id = get_the_ID();
			if ( $post_id && has_post_thumbnail( $post_id ) ) {
				$image_full = get_the_post_thumbnail_url( $post_id );
				$image_id   = get_post_thumbnail_id( $post_id );
			}
		}

		if ( ! empty( $settings['align'] ) ) {
			$image_classes[] = $settings['align'];
		}

		if ( ! empty( $settings['caption'] ) ) {
			$css_classes[] = 'wp-caption';
		}

		if ( ! empty( $settings['alt'] ) ) {
			$title_link         = $settings['alt'];
			$image_attributes[] = 'alt="' . trim( esc_attr( $settings['alt'] ) ) . '"';
		} else {
			$title_link         = '';
			$image_attributes[] = 'alt="img"';
		}

		if ( $on_click_action == 'open_custom_link' ) {
			$image_classes[] = 'image-opacity';
			if ( ! empty( $settings['custom_link']['url'] ) ) {
				$image_full = $settings['custom_link']['url'];
				$title_link = ! empty( $settings['custom_link_name'] ) ? $settings['custom_link_name'] : '';;
				$target   = 'target="' . ( ! empty( $settings['custom_link']['is_external'] ) ? '_blank' : '_self' ) . '"';
				$nofollow = ! empty( $settings['custom_link']['nofollow'] ) ? 'rel="nofollow"' : '';
			}
		}


		?>
        <div class="<?php echo esc_attr( trim( implode( ' ', $css_classes ) ) ); ?>">
			<?php if ( $on_click_action ) { ?>
                <a href="<?php echo esc_attr( $image_full ); ?>"
                   title="<?php echo strip_tags( $title_link ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> <?php echo( $on_click_action != 'lightbox' ? 'data-elementor-open-lightbox="no"' : '' ); ?>>
					<?php echo wp_get_attachment_image( $image_id, $image_size, false, array( 'class' => implode( ' ', $image_classes ) ) ); ?>
                </a>
			<?php } else { ?>
				<?php echo wp_get_attachment_image( $image_id, $image_size, false, array( 'class' => implode( ' ', $image_classes ) ) ); ?>
			<?php } ?>
			<?php if ( ! empty( $settings['caption'] ) ) { ?>
				<figcaption class="wp-caption-text" <?php echo esc_attr($text_align) ?> >
                    <?php esc_html( $settings['caption'] ); ?>
                </figcaption>
			<?php } ?>
        </div>
		<?php
	}
}