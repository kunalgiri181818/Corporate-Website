<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Seosight_Testimonial_Slider extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_testimonial_slider';
	}

	public function get_title() {
		return esc_html__( 'Testimonials Slider', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-testimonial-slider';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'seosight_testimonial_slider',
			[
				'label' => esc_html__( 'Testimonials Slider', 'elementor-seosight' )
			]
		);

		$this->add_control(
			'layout',
			[
				'type'    => \Elementor\Controls_Manager::SELECT,
				'label'   => esc_html__( 'Select Template', 'elementor-seosight' ),
				'options' => [
					'arrow'                 => esc_html__( 'Arrow', 'elementor-seosight' ),
					'author-top'            => esc_html__( 'Author Top', 'elementor-seosight' ),
					'author-centered'       => esc_html__( 'Author Centered', 'elementor-seosight' ),
					'author-centered-round' => esc_html__( 'Author Centered Round', 'elementor-seosight' ),
					'saas'                  => esc_html__( 'SaaS', 'elementor-seosight' ),
					'modern'                => esc_html__( 'Modern', 'elementor-seosight' ),
                    'academy'               => esc_html__( 'Academy', 'elementor-seosight' ),
                    'agency'                => esc_html__( 'Agency', 'elementor-seosight' ),
                    'consultant'            => esc_html__( 'Consultant', 'elementor-seosight' ),
                    'company'               => esc_html__( 'Company', 'elementor-seosight' ),
                    'copywriter'            => esc_html__( 'Copywriter', 'elementor-seosight' ),
				],
				'default' => 'arrow'
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
						'max'  => 5,
						'step' => 1
					]
				],
				'default'     => [
					'unit' => 'px',
					'size' => 1
				],
				'condition'   => [
					'layout' => [ 'arrow', 'consultant', 'academy', 'agency', 'copywriter', 'company' ]
				],
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'arrows',
			[
				'type'        => \Elementor\Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Show Arrows', 'elementor-seosight' ),
				'description' => esc_html__( 'Previous/ Next Slider buttons', 'elementor-seosight' ),
				'default'     => 'yes',
				'condition'   => [
					'layout!' => [ 'arrow', 'modern' ]
				],
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'dots',
			[
				'type'        => \Elementor\Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Show Dots', 'elementor-seosight' ),
				'description' => esc_html__( 'Pagination dots', 'elementor-seosight' ),
				'default'     => 'yes',
				'condition'   => [
					'layout!' => [ 'consultant', 'academy', 'company', 'agency' ]
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
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Delay between scroll', 'elementor-seosight' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 30,
						'step' => 1
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 5
				],
				'condition'  => [
					'autoscroll' => 'yes'
				],
				'separator'  => 'before'
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
			'seosight_testimonial_slider_items',
			[
				'label' => esc_html__( 'Slider items', 'elementor-seosight' )
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'name',
			[
				'type'    => \Elementor\Controls_Manager::TEXT,
				'label'   => esc_html__( 'Name', 'elementor-seosight' ),
				'default' => 'Jonathan Simpson',
			]
		);

		$repeater->add_control(
			'position',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Position', 'elementor-seosight' ),
				'default'   => 'Lead Manager',
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'desc',
			[
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'label'     => esc_html__( 'Description', 'elementor-seosight' ),
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'image',
			[
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'label'     => esc_html__( 'Photo of author', 'elementor-seosight' ),
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'author',
			[
				'type'      => \Elementor\Controls_Manager::TEXT,
				'label'     => esc_html__( 'Author', 'elementor-seosight' ),
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'author_link',
			[
				'type'        => \Elementor\Controls_Manager::URL,
				'label'       => esc_html__( 'Author link', 'elementor-seosight' ),
				'description' => esc_html__( 'Link to author blog, page, etc.', 'elementor-seosight' )
			]
		);

		$repeater->add_control(
			'stars',
			[
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'label'      => __( 'Stars', 'elementor-seosight' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0
				],
				'separator'  => 'before'
			]
		);

		$this->add_control(
			'options',
			[
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'label'       => esc_html__( 'Slider items', 'elementor-seosight' ),
				'description' => esc_html__( 'Repeat this fields with each item created, Each item corresponding slider element.', 'lementor-seosight' ),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ name }}}',
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
					'{{WRAPPER}} .author-name' => 'color: {{SCHEME}};'
				],
				'separator' => 'after'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title-typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .author-name'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'sub-title-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Sub Title', 'elementor-seosight' ),
			]
		);

		$this->add_control(
			'sub-title-color',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .author-company' => 'color: {{SCHEME}};'
				],
				'separator' => 'after'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'sub-title-typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .author-company'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'text-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Text', 'elementor-seosight' ),
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
					'{{WRAPPER}} .testimonial-text' => 'color: {{SCHEME}};'
				],
				'separator' => 'after'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'text-typography',
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .testimonial-text'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'box-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Box style', 'elementor-seosight' ),
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
				]
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

		$this->start_controls_section(
			'image-css',
			[
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Image box', 'elementor-seosight' ),
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
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-img-author img' => 'width: {{SIZE}}{{UNIT}};',
				]
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
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-img-author img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'image-background-color',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .testimonial-img-author',
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			'border',
			[
				'name'      => 'image-border',
				'label'     => esc_html__( 'Border', 'elementor-seosight' ),
				'selector'  => '{{WRAPPER}}',
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
					'{{WRAPPER}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'image-border_border!' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$slider_attr = $slider_class = [];

		$number_of_items = ! empty( $settings['number_of_items']['size'] ) ? $settings['number_of_items']['size'] : 1;
		$layout          = ! empty( $settings['layout'] ) ? $settings['layout'] : '';

		$wrap_class = [ 'crumina-module', 'crum-testimonial-slider', 'crumina-module-slider' ];
		if ( ! empty( $settings['custom_class'] ) ) {
			$wrap_class[] = $settings['custom_class'];
		}

		if( $layout == 'saas' ){
			$number_of_items = 5;
		}
		
		$slider_attr[] = 'data-show-items="' . esc_attr( $number_of_items ) . '"';
		if ( $layout != 'consultant' && $layout != 'saas' ) {
			$slider_attr[] = 'data-scroll-items="' . esc_attr( $number_of_items ) . '"';
		}

		if ( ! empty( $settings['autoscroll'] ) && $settings['autoscroll'] == 'yes' ) {
			$time          = ! empty( $settings['time']['size'] ) ? $settings['time']['size'] : '';
			$slider_attr[] = 'data-autoplay="' . esc_attr( intval( $time ) * 1000 ) . '"';
		}
		if ( ! empty( $settings['arrows'] ) && $settings['arrows'] == 'yes' && $layout != 'arrow' && $layout != 'modern' ) {
			$slider_attr[] = 'data-prev-next="1"';
        }


		if ( $layout == 'arrow' ) {
			$slider_class[] = 'testimonial-slider-arrow';
		} elseif ( $layout == 'modern' ) {
			$slider_class[] = 'testimonial__thumb overflow-visible modern-testimonial-slider';
			$slider_attr[]  = 'data-effect="fade"';
			$slider_attr[]  = 'data-parallax="true"';
		} elseif ( $layout == 'consultant' ) {
			$slider_class[] = 'testimonial-slider-consultant';
			$slider_attr[]  = 'data-centered-slider="true"';
			$slider_attr[]  = 'data-initial="1"';
			$slider_attr[]  = 'data-loop="false"';
			$slider_attr[]  = 'data-scroll-items="1"';
		} elseif ( $layout == 'academy' ) {
			$slider_class[] = 'testimonial-slider-academy';
		} elseif ( $layout == 'copywriter' ) {
			$slider_class[] = 'testimonial-slider-copywriter';
		} elseif ( $layout == 'company' ) {
			$slider_class[] = 'testimonial-slider-company';
		} elseif ( $layout == 'agency' ) {
			$slider_class[] = 'testimonial-slider-agency';
		} elseif ( $layout == 'saas' ) {
			$slider_class[] = 'testimonial-slider-saas';
			$slider_attr[]  = 'data-scroll-items="1"';
			$slider_attr[]  = 'data-centered-slider="true"';
		}else {
			$slider_class[] = 'testimonial-slider-standard';
		}
		if ( ! empty( $settings['dots'] ) && $settings['dots'] == 'yes' ) {
			$slider_class[] = 'pagination-bottom';
		}
		if ( $layout == 'arrow' ) {
			$dots_class = 'swiper-pagination grey bottom-left';
		} elseif ( $layout == 'modern' ) {
			$dots_class = 'swiper-pagination dark right-bottom';
		} else {
			$dots_class = 'swiper-pagination';
		} ?>

        <div class="<?php echo implode( ' ', $wrap_class ); ?>">
			<?php if ( ! empty( $settings['options'] ) ) { ?>
                <div class="swiper-container <?php echo implode( ' ', $slider_class ); ?>" <?php echo implode( ' ', $slider_attr ); ?>>
                    <div class="swiper-wrapper">
						<?php foreach ( $settings['options'] as $option ) { ?>
                            <div class="swiper-slide">
                                <div class="crumina-testimonial-item testimonial-item-<?php echo esc_attr( $layout ); ?>">
									<?php
									$data_img = $data_author = $data_desc = '';

									$name     = ! empty( $option['name'] ) ? $option['name'] : '';
									$position = ! empty( $option['position'] ) ? $option['position'] : '';
									$stars    = ! empty( $option['stars']['size'] ) ? (int) $option['stars']['size'] : '';

									$img_w = 75;
									$img_h = 75;
									if( $layout == 'copywriter' ){
										$img_w = 140;
										$img_h = 140;
									} elseif( $layout == 'saas' ){
										$img_w = 280;
										$img_h = 280;
									}

									if ( ! empty( $option['image']['id'] ) ) {
										$data_img .= '<div class="testimonial-img-author"' . ( 'modern' === $layout ? ' data-swiper-parallax-x="-50"' : '' ) . '>';
										$data_img .= wp_get_attachment_image( $option['image']['id'], array($img_w,$img_h), '', array( 'alt' =>  $name ) );
										$data_img .= '</div>';
									}
									$data_author .= '<div class="author-info"' . ( 'modern' === $layout ? ' data-swiper-parallax-x="-150"' : '' ) . '>';
									if ( $name || $position ) {
										if ( $name ) {
											$author_link = [];
											if ( ! empty( $option['link']['url'] ) ) {
												$author_link[] = 'href="' . esc_attr( $option['link']['url'] ) . '"';
												$author_link[] = 'target="' . esc_attr( ! empty( $option['link']['is_external'] ) ? '_blank' : '_self' ) . '"';
												$author_link[] = 'title="' . esc_attr( ! empty( $option['author'] ) ? $option['author'] : $name ) . '"';
												$author_link[] = ! empty( $option['link']['nofollow'] ) ? 'rel="nofollow"' : '';

												$data_author .= '<a class="h6 author-name" ' . implode( ' ', $author_link ) . '>' . esc_html( $name ) . '</a>';
											} else {
												$data_author .= '<h6 class="author-name">' . esc_html( $name ) . '</h6>';
											}
										}
										if ( $position ) {
											$data_author .= '<div class="author-company">' . esc_html( $position ) . '</div>';
										}
									}
									$data_stars = '';
									if ( $stars ) {
										ob_start(); ?>
                                        <ul class="rait-stars">
											<?php for ( $i = 1; $i <= $stars; $i ++ ) { ?>
                                                <li>
                                                    <svg class="seosight-icon seosight-icon-star" viewBox="0 0 512 512">
                                                        <path d="M512 201c0-7-6-12-17-14l-155-23-69-140c-4-8-9-12-15-12s-11 4-15 12l-69 140-155 23c-11 2-17 7-17 14 0 4 3 9 8 15l112 109-27 154v6c0 4 1 8 3 11s5 4 10 4c3 0 7-1 12-3l138-73 138 73c5 2 9 3 13 3s7-1 9-4 3-7 3-11v-6l-27-154 112-109c5-5 8-10 8-15z"/>
                                                    </svg>
                                                </li>
											<?php } ?>
											<?php for ( $i = $stars + 1; $i <= 5; $i ++ ) { ?>
                                                <li>
                                                    <svg class="seosight-icon seosight-icon-lnr-star"
                                                         viewBox="0 0 512 512">
                                                        <path d="m397 486c-2 0-4 0-6-1l-135-74-135 74c-4 2-9 2-13-1-4-3-6-8-5-13l24-147-98-97c-3-4-4-9-3-13 2-5 6-8 10-9l147-25 62-122c2-4 6-7 11-7 5 0 9 3 11 7l62 122 147 25c4 1 8 4 10 9 1 4 0 9-3 13l-98 97 24 147c1 5-1 10-5 13-2 2-5 2-7 2z m-141-102c2 0 4 1 6 2l118 64-21-128c-1-4 0-8 3-11l85-85-129-21c-4-1-8-4-9-7l-53-105-53 105c-1 3-5 6-9 7l-129 21 85 85c3 3 4 7 3 11l-21 128 118-64c2-1 4-2 6-2z"/>
                                                    </svg>
                                                </li>
											<?php } ?>
                                        </ul>
										<?php
										$data_stars .= ob_get_clean();
									}

									if( $layout == 'academy' || $layout == 'copywriter' || $layout == 'saas' || $layout == 'company' || $layout == 'agency' ){
										$data_author.= '</div>';
									} else {
										$data_author.= $data_stars . '</div>';
									}

									if ( ! empty( $option['desc'] ) ) {
										$data_desc .= '<h5 class="testimonial-text" ' . ( $layout == 'modern' ? ' data-swiper-parallax-x="-200" ' : '' ) . '>' . $option['desc'] . '</h5>';
									}
									// Slide item template
									switch ( $layout ) {
										case 'arrow':
											echo do_shortcode( $data_desc );
											echo '<div class="author-info-wrap">';
											es_render( $data_img );
											es_render( $data_author );
											echo '<div class="quote"><i class="seoicon-quotes"></i></div>';
											echo '</div>';
											break;
										case 'author-top':
											es_render( $data_img );
											echo do_shortcode( $data_desc );
											echo '<div class="author-info-wrap">';
											es_render( $data_author );
											echo '</div>';
											break;
										case 'author-centered':
											echo do_shortcode( $data_desc );
											echo '<div class="author-info-wrap display-flex content-center">';
											es_render( $data_img );
											es_render( $data_author );
											echo '</div>';
											break;
										case 'author-centered-round':
											echo do_shortcode( $data_desc );
											echo '<div class="author-info-wrap">';
											es_render( $data_img );
											es_render( $data_author );
											echo '</div>';
											break;
										case 'modern':
											echo '<div class="testimonial-content">';
											echo do_shortcode( $data_desc );
											echo '<div class="author-info-wrap">';
											es_render( $data_author );
											echo '</div>';
											echo '</div>';
											es_render( $data_img );
											echo '<div class="quote"><i class="seoicon-quotes"></i></div>';
											break;
										case 'consultant':
											es_render( $data_img );
											echo '<div class="testimonial-content">';
											echo do_shortcode( $data_desc );
											echo '</div>';
											echo '<div class="author-info-wrap">';
											es_render( $data_author );
											echo '</div>';
											break;
										case 'agency':
											echo '<div class="author-info-wrap">';
											es_render( $data_img );
											es_render( $data_author );
											echo '</div>';
											echo '<div class="testimonial-content">';
											echo do_shortcode( $data_desc );
											echo '</div>';
											es_render( $data_stars );
											break;
										case 'academy':
											echo '<div class="quote">';
											echo '<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m416 512h-320c-53.023438 0-96-42.976562-96-96v-320c0-53.023438 42.976562-96 96-96h320c53.023438 0 96 42.976562 96 96v320c0 53.023438-42.976562 96-96 96zm0 0" fill="#fafcff"/><path d="m213.328125 170.671875h10.671875c5.886719 0 10.671875 4.785156 10.671875 10.671875s-4.785156 10.65625-10.671875 10.65625h-10.671875c-23.535156 0-42.671875 19.136719-42.671875 42.671875v21.871094c1.726562-.351563 3.519531-.542969 5.34375-.542969h32c14.703125 0 26.671875 11.96875 26.671875 26.671875v32c0 14.703125-11.953125 26.671875-26.671875 26.671875h-32c-14.703125 0-26.671875-11.96875-26.671875-26.671875v-80c0-35.296875 28.71875-64 64-64zm0 0" fill="#d7dfe7"/><path d="m341.328125 170.671875h10.671875c5.886719 0 10.671875 4.785156 10.671875 10.671875s-4.769531 10.65625-10.671875 10.65625h-10.671875c-23.535156 0-42.671875 19.136719-42.671875 42.671875v21.871094c1.726562-.351563 3.519531-.542969 5.34375-.542969h32c14.703125 0 26.671875 11.96875 26.671875 26.671875v32c0 14.703125-11.953125 26.671875-26.671875 26.671875h-32c-14.703125 0-26.671875-11.96875-26.671875-26.671875v-80c0-35.296875 28.71875-64 64-64zm0 0" fill="#d7dfe7"/></svg>';
											echo '</div>';
											echo '<div class="testimonial-content">';
											echo do_shortcode( $data_desc );
											echo '</div>';
											echo '<div class="author-info-wrap">';
											echo '<div class="author-img-wrap">';
											es_render( $data_img );
											es_render( $data_author );
											echo '</div>';
											es_render( $data_stars );
											echo '</div>';
											break;
										case 'copywriter':
											echo '<div class="author-img-wrap">';
											es_render( $data_img );
											echo '</div>';
											echo '<div class="author-info-wrap">';
											es_render( $data_stars );
											echo do_shortcode( $data_desc );
											es_render( $data_author );
											echo '</div>';
											break;
										case 'company':
											echo '<div class="author-img-wrap">';
											es_render( $data_img );
											echo '</div>';
											echo '<div class="author-info-wrap">';
											es_render( $data_author );
											echo do_shortcode( $data_desc );
											echo '</div>';
											es_render( $data_stars );
											break;
										case 'saas':
											echo '<div class="author-img-wrap">';
											es_render( $data_img );
											echo '</div>';
											echo '<div class="author-info-wrap">';
											es_render( $data_author );
											echo do_shortcode( $data_desc );
											echo '</div>';
											es_render( $data_stars );
											break;
										default:
											echo do_shortcode( $data_desc );
											echo '<div class="author-info-wrap">';
											es_render( $data_img );
											es_render( $data_author );
											echo '</div>';
											break;
									}
									?>
                                </div>
                            </div>
						<?php } ?>
                    </div>
					<?php if ( ! empty( $settings['arrows'] ) && $settings['arrows'] == 'yes' && $layout != 'arrow' && $layout != 'modern' ) { ?>
                        <div class="seosight-module-team-slider-arrows">
							<?php if( $layout == 'consultant' || $layout == 'academy' || $layout == 'saas' || $layout == 'copywriter' || $layout == 'company' || $layout == 'agency' ){ ?>
							<span class="btn-next swiper-btn-next">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path d="M25.1 247.5l117.8-116c4.7-4.7 12.3-4.7 17 0l7.1 7.1c4.7 4.7 4.7 12.3 0 17L64.7 256l102.2 100.4c4.7 4.7 4.7 12.3 0 17l-7.1 7.1c-4.7 4.7-12.3 4.7-17 0L25 264.5c-4.6-4.7-4.6-12.3.1-17z"></path></svg>
							</span>
							<span class="btn-prev swiper-btn-prev">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path d="M166.9 264.5l-117.8 116c-4.7 4.7-12.3 4.7-17 0l-7.1-7.1c-4.7-4.7-4.7-12.3 0-17L127.3 256 25.1 155.6c-4.7-4.7-4.7-12.3 0-17l7.1-7.1c4.7-4.7 12.3-4.7 17 0l117.8 116c4.6 4.7 4.6 12.3-.1 17z" class=""></path></svg>
							</span>
							<?php } else { ?>
							<svg class="btn-next swiper-btn-next">
								<use xlink:href="#arrow-right"></use>
							</svg>
							<svg class="btn-prev swiper-btn-prev">
								<use xlink:href="#arrow-left"></use>
							</svg>
							<?php } ?>
						</div>
					<?php } ?>
					<?php if ( ! empty( $settings['dots'] ) && $settings['dots'] == 'yes' ) { ?>
                        <div class="<?php echo esc_attr( $dots_class ); ?>"></div>
					<?php } ?>
                </div>
			<?php } ?>
        </div>
		<?php
		if ( is_admin() ) { ?>
            <script>
                jQuery(function ($) {
                    CRUMINA.Swiper.init();
                });
            </script>
		<?php }
	}
}