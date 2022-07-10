<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_Post_Slider extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_post_slider';
	}

	public function get_title() {
		return esc_html__( 'Post / Portfolio Carousel', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-post-portfolio-carousel-with-image';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {

		$post_taxonomy = [];
        $all_post_taxonomy = es_post_taxonomy();
        if ( $all_post_taxonomy ) {
            foreach ( $all_post_taxonomy as $post_type => $terms ){
                $post_taxonomy[ $post_type ] = ucwords( str_replace( [ '-', '_' ], ' ', $post_type ) );
            }
        }

        $portfolio_post_type = get_option( 'pk_main_post_type', 'fw-portfolio' );

		$this->start_controls_section(
			'seosight_post_slider',
			[
				'label' => esc_html__( 'Post / Portfolio Carousel', 'elementor-seosight' )
			]
		);

		$this->add_control(
            'layout', 
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => esc_html__( 'Select Template', 'elementor-seosight' ),
                'options' => [
                	'post'      => esc_html__( 'Post', 'elementor-seosight' ),
					'portfolio' => esc_html__( 'Portfolio', 'elementor-seosight' ),
					'agency' => esc_html__( 'Agency', 'elementor-seosight' ),
					'saas' => esc_html__( 'SaaS', 'elementor-seosight' ),
					'consultant' => esc_html__( 'Consultant', 'elementor-seosight' ),
                ],
                'default' => 'post',
            ]
        );

        $this->add_control(
            'show_date',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Show date', 'elementor-seosight' ),
                'description' => esc_html__( 'Show the post publish date.', 'elementor-seosight' ),
                'default'     => 'no',
                'condition'   => [
                    'layout' => 'post',
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'show_author',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Show author?', 'elementor-seosight' ),
                'description' => esc_html__( 'Author name and avatar block', 'elementor-seosight' ),
                'default'     => 'no',
                'condition'   => [
                    'layout' => 'post',
                ],
                'separator'   => 'before'
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
                    'size' => 3
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
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'dots_position', 
            [
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label'       => esc_html__( 'Dots position', 'elementor-seosight' ),
                'description' => esc_html__( 'Placement of slide pagination dots', 'elementor-seosight' ),
                'options'     => [
                	'bottom' => esc_html__( 'Bottom', 'elementor-seosight' ),
					'top'    => esc_html__( 'Top', 'elementor-seosight' )
                ],
                'condition'   => [
                    'dots' => 'yes',
                ],
                'default'     => 'bottom',
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'arrows',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Show Arrows', 'elementor-seosight' ),
                'description' => esc_html__( 'Previous/ Next Slider buttons', 'elementor-seosight' ),
                'default'     => 'no',
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
			'query',
			[
				'label' => esc_html__( 'Query', 'elementor-seosight' )
			]
		);

		$this->add_control(
            'post_taxonomy', 
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => esc_html__( 'Content Type', 'elementor-seosight' ),
                'default' => $portfolio_post_type,
                'options' => $post_taxonomy
            ]
        );

        if ( $all_post_taxonomy ) {
            foreach ( $all_post_taxonomy as $post_type => $terms ){
                $this->add_control(
                    'post_taxonomy_' . $post_type, 
                    [
                        'type'        => \Elementor\Controls_Manager::SELECT2,
                        'label'       => esc_html__( 'Select Content Type', 'elementor-seosight' ),
                        'description' => esc_html__( 'Choose supported content type such as post, custom post type, etc.', 'elementor-seosight' ),
                        'options'     => $terms,
                        'multiple'    => true,
                        'condition'   => [
                            'post_taxonomy' => $post_type
                        ],
                        'separator'   => 'before'
                    ]
                );
            }
        }

        $this->add_control(
            'order_by', 
            [
                'type'      => \Elementor\Controls_Manager::SELECT,
                'label'     => esc_html__( 'Order by', 'elementor-seosight' ),
                'default'   => 'ID',
                'options'   => [
                    'ID'            => esc_html__( 'Post ID', 'elementor-seosight' ),
                    'author'        => esc_html__( 'Author', 'elementor-seosight' ),
                    'title'         => esc_html__( 'Title', 'elementor-seosight' ),
                    'name'          => esc_html__( 'Post name (post slug)', 'elementor-seosight' ),
                    'type'          => esc_html__( 'Post type (available since Version 4.0)', 'elementor-seosight' ),
                    'date'          => esc_html__( 'Date', 'elementor-seosight' ),
                    'modified'      => esc_html__( 'Last modified date', 'elementor-seosight' ),
                    'rand'          => esc_html__( 'Random order', 'elementor-seosight' ),
                    'comment_count' => esc_html__( 'Number of comments', 'elementor-seosight' )
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'order_list', 
            [
                'type'      => \Elementor\Controls_Manager::SELECT,
                'label'     => esc_html__( 'Order', 'elementor-seosight' ),
                'default'   => 'ASC',
                'options'   => [
                    'ASC'  => esc_html__( 'ASC', 'elementor-seosight' ),
                    'DESC' => esc_html__( 'DESC', 'elementor-seosight' ),
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'number_post',
            [
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'label'       => esc_html__( 'Number of items displayed', 'elementor-seosight' ),
                'description' => esc_html__( 'The number of items you want to show.', 'elementor-seosight' ),
                'default'     => [
                    'size' => 9,
                    'unit' => '%',
                ],
                'range'       => [
                    '%' => [
                        'min' => 1,
                        'max' => 30,
                    ],
                ],
                'separator'   => 'before'
            ]
        );

		$this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();

        $post_slider_id = uniqid( 'post-slider-' );
        $portfolio_post_type = get_option( 'pk_main_post_type', 'fw-portfolio' );

        $layout          = ! empty( $settings['layout'] ) ? $settings['layout'] : '';
        $orderby         = ! empty( $settings['order_by'] ) ? $settings['order_by'] : 'ID';
        $order           = ! empty( $settings['order_list'] ) ? $settings['order_list'] : 'ASC';
        $post_type       = ! empty( $settings['post_taxonomy'] ) ? $settings['post_taxonomy'] : $portfolio_post_type;
        $terms           = ! empty( $settings['post_taxonomy_'. $post_type ] ) ? $settings['post_taxonomy_'. $post_type ] : 'post';
        $posts_per_page  = ! empty( $settings['number_post']['size'] ) ? $settings['number_post']['size'] : 9;
        $number_of_items = ! empty( $settings['number_of_items']['size'] ) ? $settings['number_of_items']['size'] : 3;

        if( $layout == 'agency' ) {
            $posts_per_page = 3;
        }

        $taxonomy_objects = get_object_taxonomies( $post_type, 'objects' );
        $taxonomy         = key( $taxonomy_objects );

        $args = array(
            'post_type'        => $post_type,
            'posts_per_page'   => $posts_per_page,
            'orderby'          => $orderby,
            'order'            => $order,
            'suppress_filters' => false
        );

        if ( $terms ) {
            $args['tax_query'] = array(
                'relation' => 'OR',
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'    => $terms,
                )
            );
        }

        $the_query = new WP_Query( $args );

		$wrap_class = [ 'crumina-module', 'news-slider-module', 'crumina-module-slider', 'crumina-module-posts-slider-' . $layout ];
		if ( ! empty( $settings['custom_class'] ) ) {
            $wrap_class[] = $settings['custom_class'];
        }

        if( $layout == 'consultant' || $layout == 'saas' ) {
            $wrap_class[] = 'crumina-module-posts-slider-modern';
        }

		$slider_attr = [
			'data-show-items="' . esc_attr( $number_of_items ) . '"',
			'data-scroll-items="' . esc_attr( $number_of_items ) . '"',
			'data-prev-next="1"',
			'data-loop="false"'
		];

        if( $layout == 'agency' ) {
            $slider_attr = [
                'data-show-items="1"',
                'data-scroll-items="1"',
                'data-prev-next="1"',
                'data-loop="false"'
            ];
        }
		
		if ( ! empty( $settings['autoscroll'] ) && $settings['autoscroll'] == 'yes' ) {
			$time = ! empty( $settings['time']['size'] ) ? $settings['time']['size'] : 0;
			$slider_attr[] = 'data-autoplay="' . esc_attr( intval( $time ) * 1000 ) . '"';
			$slider_attr[] = 'data-loop="true"';
		}

		if ( ! empty( $settings['dots_position'] ) && $settings['dots_position'] == 'top' ) {
			$css_pagination = '';
			$dots_class     = 'swiper-pagination top-right';
			$slider_class   = 'top-pagination';
		} else {
			$css_pagination = 'left: 50%;';
			$slider_class   = 'pagination-bottom';
			$dots_class     = 'swiper-pagination gray';
		}

		$container_width = 1170;
		$gap_paddings    = 90;
        if( $layout == 'saas' ){
		    $gap_paddings = 15;
        } elseif ( $layout == 'consultant' ) {
		    $gap_paddings = -10;
        }
		$grid_size       = intval( 12 / $number_of_items );
		$img_width       = intval( $container_width / ( 12 / $grid_size ) ) - $gap_paddings;
		$img_height      = intval( $img_width * 0.75 );
		$default_src     = ES_PLUGIN_URL . '/assets/images/get_start.jpg';

        $portfolio_layouts = array('portfolio', 'saas', 'consultant', 'agency');
        if( $layout !== 'agency' ){
		?>
		<div id="<?php echo esc_attr( $post_slider_id ); ?>" class="<?php echo esc_attr( implode( ' ', $wrap_class ) ) ?>">
			<?php if ( $the_query->have_posts() ) { ?>
	            <div class="swiper-container <?php echo $slider_class; ?>" <?php echo implode( ' ', $slider_attr ); ?>>
	                <div class="swiper-wrapper">
						<?php while ( $the_query->have_posts() ) { $the_query->the_post(); ?>
                            <div class="swiper-slide">
								<?php if ( in_array($layout, $portfolio_layouts) ) { ?>
                                    <div class="crumina-case-item">
                                        <div class="case-item__thumb mouseover lightbox shadow animation-disabled">
                                            <a href="<?php the_permalink() ?>">
												<?php
													$thumbnail_id = get_post_thumbnail_id();
													if ( ! empty( $thumbnail_id ) ) {
														$thumbnail       = get_post( $thumbnail_id );
														$image           = es_resize( $thumbnail->ID, $img_width, $img_height, true );
														$thumbnail_title = $thumbnail->post_title;
													} else {
														$image           = $default_src;
														$thumbnail_title = get_the_title();
													}
												?>
                                                <img src="<?php echo esc_url( $image ); ?>" width="<?php echo esc_attr( $img_width ); ?>" height="<?php echo esc_attr( $img_height ); ?>" alt="<?php echo esc_attr( $thumbnail_title ); ?>" loading="lazy" >
                                            </a>
                                        </div>
                                        
                                        <?php if( $layout == 'saas' ){ ?>
                                        <div class="case-item__titlecont">
                                            <?php the_terms( get_the_ID(), $taxonomy, '<div class="case-item__cat">', ', ', '</div>' ); ?>
                                            <a class="case-item__title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            <a class="case-item__arrow" href="<?php the_permalink() ?>">   
                                                <svg version="1.1" id="arrow_posts_slider" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path d="M508.875,248.458l-160-160c-4.167-4.167-10.917-4.167-15.083,0c-4.167,4.167-4.167,10.917,0,15.083l141.792,141.792
                                                            H10.667C4.771,245.333,0,250.104,0,256s4.771,10.667,10.667,10.667h464.917L333.792,408.458c-4.167,4.167-4.167,10.917,0,15.083
                                                            c2.083,2.083,4.813,3.125,7.542,3.125c2.729,0,5.458-1.042,7.542-3.125l160-160C513.042,259.375,513.042,252.625,508.875,248.458z
                                                            "/>
                                                    </g>
                                                </g>
                                                </svg>
                                            </a>
                                        </div>
                                        <?php } else { ?>
                                        <div class="case-item__titlecont">
                                            <a class="case-item__title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										    <?php the_terms( get_the_ID(), $taxonomy, '<div class="case-item__cat">', ', ', '</div>' ); ?>
                                        </div>
                                        <?php } ?>
                                    </div>
								<?php } else { ?>
                                    <article class="hentry post">
										<?php
											if ( ! empty( $settings['show_date'] ) && $settings['show_date'] == 'yes' ) {
												echo es_posted_time( false );
											}
										?>
                                        <div class="post__content">
											<?php
												the_title( '<h5 class="entry-title"><a class="post__title" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' );

												if ( ! has_excerpt() ) {
													$post_content = get_the_content();
												} else {
													$post_content = get_the_excerpt();
												}
												$post_content = strip_shortcodes( $post_content );
											?>
                                            <p class="post__text">
												<?php echo wp_trim_words( $post_content, 18, '' ); ?>
                                            </p>
                                        </div>
										<?php
											if ( ! empty( $settings['show_author'] ) && $settings['show_author'] == 'yes' ) {
												es_post_author_avatar( get_the_author_meta( 'ID' ) );
											}
										?>
                                    </article>
								<?php } ?>
                            </div>
						<?php } ?>
						<?php wp_reset_postdata(); ?>
	                </div>
					<?php if ( ! empty( $settings['dots'] ) && $settings['dots'] == 'yes' ) { ?>
	                    <div class="<?php echo esc_attr( $dots_class ); ?>"></div>
					<?php } ?>

                    <?php if ( ! empty( $settings['arrows'] ) && $settings['arrows'] == 'yes' ) { ?>
                    <div class="seosight-module-team-slider-arrows">
                        <span class="btn-next swiper-btn-next">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path d="M25.1 247.5l117.8-116c4.7-4.7 12.3-4.7 17 0l7.1 7.1c4.7 4.7 4.7 12.3 0 17L64.7 256l102.2 100.4c4.7 4.7 4.7 12.3 0 17l-7.1 7.1c-4.7 4.7-12.3 4.7-17 0L25 264.5c-4.6-4.7-4.6-12.3.1-17z"></path></svg>
                        </span>
                        <span class="btn-prev swiper-btn-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path d="M166.9 264.5l-117.8 116c-4.7 4.7-12.3 4.7-17 0l-7.1-7.1c-4.7-4.7-4.7-12.3 0-17L127.3 256 25.1 155.6c-4.7-4.7-4.7-12.3 0-17l7.1-7.1c4.7-4.7 12.3-4.7 17 0l117.8 116c4.6 4.7 4.6 12.3-.1 17z" class=""></path></svg>
                        </span>
                    </div>
					<?php } ?>
	            </div>
			<?php } else {
					echo '<h2>' . esc_html__( ' No posts found', 'elementor-seosight' ) . '</h2>';
				}
			?>
	    </div>
	    <style type="text/css">#<?php echo esc_attr( $post_slider_id ); ?> .swiper-container-horizontal > .swiper-pagination-bullets, #<?php echo esc_attr( $post_slider_id ); ?> .swiper-pagination-custom, #<?php echo esc_attr( $post_slider_id ); ?> .swiper-pagination-fraction{<?php echo $css_pagination; ?>width:auto;}#<?php echo esc_attr( $post_slider_id ); ?> .swiper-pagination-bullet{opacity:1;}</style>
        <?php   
        } else {
        $img_width = intval( $container_width / 2 );
        $img_height = intval( $img_width * 0.75 );
        ?>
        <div id="<?php echo esc_attr( $post_slider_id ); ?>" class="<?php echo esc_attr( implode( ' ', $wrap_class ) ) ?>">
            <?php if ( $the_query->have_posts() ) { ?>
	            <div class="swiper-container <?php echo $slider_class; ?>" <?php echo implode( ' ', $slider_attr ); ?>>
	                <div class="swiper-wrapper">
						<?php while ( $the_query->have_posts() ) { $the_query->the_post(); ?>
                            <div class="swiper-slide">
                                    <div class="crumina-case-item">
                                        <div class="case-item__thumb mouseover lightbox shadow animation-disabled">
                                            <a href="<?php the_permalink() ?>">
												<?php
													$thumbnail_id = get_post_thumbnail_id();
													if ( ! empty( $thumbnail_id ) ) {
														$thumbnail       = get_post( $thumbnail_id );
														$image           = es_resize( $thumbnail->ID, $img_width, $img_height, true );
														$thumbnail_title = $thumbnail->post_title;
													} else {
														$image           = $default_src;
														$thumbnail_title = get_the_title();
													}
												?>
                                                <img src="<?php echo esc_url( $image ); ?>" width="<?php echo esc_attr( $img_width ); ?>" height="<?php echo esc_attr( $img_height ); ?>" alt="<?php echo esc_attr( $thumbnail_title ); ?>" loading="lazy" >
                                            </a>
                                        </div>
                                        
                                        <div class="case-item__titlecont">
										    <?php the_terms( get_the_ID(), $taxonomy, '<div class="case-item__cat">', ', ', '</div>' ); ?>
                                            <a class="case-item__title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            <a class="case-item__button" href="<?php the_permalink() ?>">
                                                <span>Case Details</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M311.03 131.515l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887l-83.928 83.444c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l116.485-116c4.686-4.686 4.686-12.284 0-16.971L328 131.515c-4.686-4.687-12.284-4.687-16.97 0z"></path></svg>
                                            </a>
                                        </div>
                                    </div>
                            </div>
						<?php } ?>
						<?php wp_reset_postdata(); ?>
	                </div>
					<?php if ( ! empty( $settings['dots'] ) && $settings['dots'] == 'yes' ) { ?>
	                    <div class="<?php echo esc_attr( $dots_class ); ?>"></div>
					<?php } ?>

                    <?php if ( ! empty( $settings['arrows'] ) && $settings['arrows'] == 'yes' ) { ?>
                    <div class="seosight-module-team-slider-arrows">
                        <span class="btn-next swiper-btn-next">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path d="M25.1 247.5l117.8-116c4.7-4.7 12.3-4.7 17 0l7.1 7.1c4.7 4.7 4.7 12.3 0 17L64.7 256l102.2 100.4c4.7 4.7 4.7 12.3 0 17l-7.1 7.1c-4.7 4.7-12.3 4.7-17 0L25 264.5c-4.6-4.7-4.6-12.3.1-17z"></path></svg>
                        </span>
                        <span class="btn-prev swiper-btn-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path d="M166.9 264.5l-117.8 116c-4.7 4.7-12.3 4.7-17 0l-7.1-7.1c-4.7-4.7-4.7-12.3 0-17L127.3 256 25.1 155.6c-4.7-4.7-4.7-12.3 0-17l7.1-7.1c4.7-4.7 12.3-4.7 17 0l117.8 116c4.6 4.7 4.6 12.3-.1 17z" class=""></path></svg>
                        </span>
                    </div>
					<?php } ?>
	            </div>

                <?php
                    $posts_per_page_s  = ! empty( $settings['number_of_items']['size'] ) ? intval($settings['number_of_items']['size']) : 7;
                    $args_s = array(
                        'post_type'        => $post_type,
                        'posts_per_page'   => $posts_per_page_s - 3,
                        'orderby'          => $orderby,
                        'order'            => $order,
                        'suppress_filters' => false,
                        'offset' => 3
                    );
            
                    if ( $terms ) {
                        $args_s['tax_query'] = array(
                            'relation' => 'OR',
                            array(
                                'taxonomy' => $taxonomy,
                                'field'    => 'slug',
                                'terms'    => $terms,
                            )
                        );
                    }
                    $the_query_second = new WP_Query( $args_s );

                    if ( $the_query_second->have_posts() ) {
                        ?>
                        <div class="row crumina-case-items-second">
                        <?php
                        while ( $the_query_second->have_posts() ) { $the_query_second->the_post();
                            ?>
                            <div class="col-lg-3 col-md-6 col-xs-12">
                                <div class="crumina-case-item no-slider">
                                    <div class="case-item__thumb mouseover lightbox shadow animation-disabled">
                                        <a href="<?php the_permalink() ?>">
                                            <?php
                                                $thumbnail_id = get_post_thumbnail_id();
                                                if ( ! empty( $thumbnail_id ) ) {
                                                    $thumbnail       = get_post( $thumbnail_id );
                                                    $image           = es_resize( $thumbnail->ID, $img_width, $img_height, true );
                                                    $thumbnail_title = $thumbnail->post_title;
                                                } else {
                                                    $image           = $default_src;
                                                    $thumbnail_title = get_the_title();
                                                }
                                            ?>
                                            <img src="<?php echo esc_url( $image ); ?>" width="<?php echo esc_attr( $img_width ); ?>" height="<?php echo esc_attr( $img_height ); ?>" alt="<?php echo esc_attr( $thumbnail_title ); ?>" loading="lazy" >
                                        </a>
                                    </div>
                                    
                                    <div class="case-item__titlecont">
                                        <?php the_terms( get_the_ID(), $taxonomy, '<div class="case-item__cat">', ', ', '</div>' ); ?>
                                        <a class="case-item__title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        <a class="case-item__button" href="<?php the_permalink() ?>">
                                            <span>Case Details</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M311.03 131.515l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887l-83.928 83.444c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l116.485-116c4.686-4.686 4.686-12.284 0-16.971L328 131.515c-4.686-4.687-12.284-4.687-16.97 0z"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        </div>
                        <?php
                    }
                ?>

			<?php } else {
					echo '<h2>' . esc_html__( ' No posts found', 'elementor-seosight' ) . '</h2>';
				}
			?>
            
	    </div>
        <?php
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