<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Seosight_Posts_Block extends \Elementor\Widget_Base {

	public function get_name() {
		return 'seosight_posts_block';
	}

	public function get_title() {
		return esc_html__( 'Posts Block', 'elementor-seosight' );
	}

	public function get_icon() {
		return 'crum-el-w-portfolio-grid';
	}

	public function get_categories() {
		return [ 'elementor-seosight' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'seosight_posts_block',
			[
				'label' => esc_html__( 'Posts Block', 'elementor-seosight' )
			]
		);

        $this->add_control(
            'layout', 
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => esc_html__( 'Select Template', 'elementor-seosight' ),
                'options' => [
                	'grid' => esc_html__( 'Grid', 'elementor-seosight' ),
                	'grid2' => esc_html__( 'Grid 2', 'elementor-seosight' ),
                	'business' => esc_html__( 'Business', 'elementor-seosight' ),
                	'carousel' => esc_html__( 'Carousel', 'elementor-seosight' ),
                	'carousel2' => esc_html__( 'Carousel 2', 'elementor-seosight' ),
                	'company' => esc_html__( 'Company', 'elementor-seosight' ),
                	'courses' => esc_html__( 'Courses', 'elementor-seosight' ),
                ],
                'default' => 'grid',
            ]
        );

        $this->add_control(
            'show_date',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Show date', 'elementor-seosight' ),
                'description' => esc_html__( 'Show the post publish date.', 'elementor-seosight' ),
                'default'     => 'yes',
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'show_cats',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Show categories', 'elementor-seosight' ),
                'default'     => 'yes',
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
                'condition'   => [
                    'layout!' => [ 'courses' ]
                ],
                'default'     => [
                    'unit' => 'px',
                    'size' => 3
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'number_of_items_carousel',
            [
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'label'       => esc_html__( 'Items in carousel', 'elementor-seosight' ),
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
                    'size' => 2
                ],
                'condition'   => [
                    'layout' => [ 'carousel', 'carousel2' ]
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'blog_button',
            [
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'label'       => esc_html__( 'Blog button', 'elementor-seosight' ),
                'description' => esc_html__( 'Show blog button', 'elementor-seosight' ),
                'default'     => 'yes',
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'blog_button_text',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Blog button label', 'elementor-seosight' ),
                'condition'   => [
                    'blog_button' => 'yes'
                ],
                'default'     => esc_html__( 'Read Blog', 'elementor-seosight' ),
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'blog_button_link',
            [
                'type'        => \Elementor\Controls_Manager::URL,
                'label'       => esc_html__( 'Blog button link', 'elementor-seosight' ),
                'condition'   => [
                    'blog_button' => 'yes'
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
		    'categories-css',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__('Categories', 'elementor-seosight'),
            ]
        );

        $this->add_control(
			'categories-bg',
			[
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background', 'elementor-seosight' ),
				'scheme'    => [
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .post-item__cat a' => 'background-color: {{SCHEME}};'
				],
                'separator' => 'after'
			]
		);

        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings_for_display();
        $number_of_items = ! empty( $settings['number_of_items']['size'] ) ? $settings['number_of_items']['size'] : 3;
        $blog_button_text = ! empty( $settings['blog_button_text'] ) ? $settings['blog_button_text'] : '';
        $layout = ! empty( $settings['layout'] ) ? $settings['layout'] : 'grid';
        $number_of_items_carousel = ! empty( $settings['number_of_items_carousel']['size'] ) ? $settings['number_of_items_carousel']['size'] : 2;

        $args_posts = array(
            'post_type' => 'post',
            'posts_per_page' => $number_of_items,
        );
        $posts_query = new WP_Query( $args_posts );

        $wrap_class = [ 'crumina-module', 'seosight-posts-block', 'seosight-posts-block-' . $layout ];
		if ( ! empty( $settings['custom_class'] ) ) {
            $wrap_class[] = $settings['custom_class'];
        }
        ?>
		<div class="<?php echo esc_attr( implode( ' ', $wrap_class ) ) ?>">
            <?php if( $layout == 'grid' || $layout == 'courses' || $layout == 'business' ){ ?>
            <div class="row">
			    <?php
                $post_counter = 1;
                $count_number = 1;
                if( $layout == 'courses' ){
                    $count_number = 2;
                }
                if ( $posts_query->have_posts() ) { 
                    while ( $posts_query->have_posts() ) { $posts_query->the_post();
                    $cols_class = ($post_counter == $count_number) ? 'col-lg-6 col-md-6 col-sm-12 seo-el-full-img' : 'col-lg-3 col-md-3 col-sm-6 seo-el-small-img';
                    if( $layout == 'business' ) {
                        $cols_class = ($post_counter == $count_number) ? 'col-lg-6 col-md-6 col-sm-12 seo-el-small-img' : 'col-lg-3 col-md-3 col-sm-6 seo-el-small-img';
                    }
                    $img_bg = '';
                    if(has_post_thumbnail() && $post_counter == $count_number && $layout != 'business'){
                        $img_bg = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    }
                    ?>
                    <div class="<?php echo esc_attr($cols_class); ?>">
                        <div class="post-item<?php if( $layout == 'grid' ){ echo esc_attr(' post-item-grid'); } ?>" style="background-image: url(<?php echo esc_attr($img_bg); ?>);">
                            <?php if(has_post_thumbnail() && ($post_counter != $count_number || $layout == 'business')){ ?>
                            <a href="<?php the_permalink() ?>">
                                <div class="post-item__image">
                                    <?php the_post_thumbnail('medium-large'); ?>
                                </div>
                            </a>
                            <?php } ?>
                            <div class="post-item__content">
                                <?php 
                                if ( ! empty( $settings['show_cats'] ) && $settings['show_cats'] == 'yes' ) {
                                    the_terms( get_the_ID(), 'category', '<p class="post-item__cat">', ', ', '</p>' );
                                }
                                ?>
                                <a href="<?php the_permalink() ?>">
                                    <p class="post-item__title"><?php the_title(); ?></p>
                                    <?php if($post_counter != $count_number && $layout == 'business'){ ?>
                                    <p class="post-item__descr"><?php echo wp_trim_words(get_the_content(), 8); ?></p>
                                    <?php } ?>
                                </a>
                                <?php if ( ! empty( $settings['show_date'] ) && $settings['show_date'] == 'yes' ) { ?>
                                <div class="post-item__date">
                                    <?php if($post_counter != $count_number || $layout == 'business'){ ?>
                                    <img src="<?php echo ES_PLUGIN_URL . '/assets/images/calendar.svg'; ?>" />
                                    <?php } else { ?>
                                    <img src="<?php echo ES_PLUGIN_URL . '/assets/images/calendar-white.svg'; ?>" />
                                    <?php } ?>
                                    <?php echo es_posted_time( false ); ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $post_counter++;
                    }
                    wp_reset_postdata();
                }
                ?>
            </div>
            <?php } elseif( $layout == 'carousel' || $layout == 'carousel2' ) {
            if ( $posts_query->have_posts() ) { 
            $item_style = ( $layout == 'carousel' ) ? 'seo-el-full-img' : 'seo-el-small-img';

            $slider_attr = array(
                'data-centered-slider="true"',
                'data-initial="1"',
                'data-scroll-items="1"',
                'data-loop="false"',
                // 'data-auto-height="true"',
                'data-show-items="'.esc_attr($number_of_items_carousel).'"',
            );
            ?>
            <div class="swiper-container pagination-bottom" <?php echo implode( ' ', $slider_attr ); ?>>
                <div class="swiper-wrapper <?php echo esc_attr($item_style); ?>">
                    <?php
                    while ( $posts_query->have_posts() ) { $posts_query->the_post();
                    $img_bg = '';
                    if(has_post_thumbnail() && $layout == 'carousel'){
                        $img_bg = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    }
                    ?>
                    <div class="swiper-slide">
                        <div class="post-item" style="background-image: url(<?php echo esc_attr($img_bg); ?>);">
                            <?php if(has_post_thumbnail() && $layout == 'carousel2'){ ?>
                                <div class="post-item__image">
                                <a href="<?php the_permalink() ?>">
                                <?php 
                                    $thumbnail_id = get_post_thumbnail_id();
                                    $thumbnail = get_post( $thumbnail_id );
                                    if( isset( $thumbnail->ID ) ) {
                                        $post_img = es_resize( $thumbnail->ID, 730, 570, true );
                                    }
                                ?>
                                    <img src="<?php echo esc_url( $post_img ) ?>" width="570" height="730" loading="lazy" />
                                </a>
                                <?php
                                    if ( ! empty( $settings['show_cats'] ) && $settings['show_cats'] == 'yes' && $layout == 'carousel2' ) {
                                        the_terms( get_the_ID(), 'category', '<p class="post-item__cat">', '', '</p>' );
                                    }
                                ?>
                            </div>
                            <?php } ?>
                            <div class="post-item__content">
                                <?php 
                                if ( ! empty( $settings['show_cats'] ) && $settings['show_cats'] == 'yes' && $layout == 'carousel' ) {
                                    the_terms( get_the_ID(), 'category', '<p class="post-item__cat">', '', '</p>' );
                                }
                                ?>
                                <a href="<?php the_permalink() ?>">
                                    <p class="post-item__title"><?php the_title(); ?></p>
                                    <?php if($layout == 'carousel2'){ ?>
                                    <p class="post-item__descr"><?php echo wp_trim_words(get_the_content(), 8); ?></p>
                                    <?php } ?>
                                </a>
                                <?php if ( ! empty( $settings['show_date'] ) && $settings['show_date'] == 'yes' ) { ?>
                                <div class="post-item__date">
                                    <?php if($layout == 'carousel2'){ ?>
                                    <img src="<?php echo ES_PLUGIN_URL . '/assets/images/calendar.svg'; ?>" />
                                    <?php } else { ?>
                                    <img src="<?php echo ES_PLUGIN_URL . '/assets/images/calendar-white.svg'; ?>" />
                                    <?php } ?>
                                    <?php echo es_posted_time( false ); ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php } wp_reset_postdata(); ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <?php
            }
            } elseif( $layout == 'company' ) {
            if ( $posts_query->have_posts() ) {
            ?>
            <div class="row">
            <?php
            while ( $posts_query->have_posts() ) { $posts_query->the_post();  
            ?>
            <div class="col-lg-3 col-md-3 col-sm-12 seo-el-small-img">
                <div class="post-item">
                    <?php if(has_post_thumbnail()){ ?>
                    <div class="post-item__image">
                        <a href="<?php the_permalink() ?>">
                            <?php 
                                $thumbnail_id = get_post_thumbnail_id();
                                $thumbnail = get_post( $thumbnail_id );
                                if( isset( $thumbnail->ID ) ) {
                                    $post_img = es_resize( $thumbnail->ID, 730, 570, true );
                                }
                            ?>
                            <img src="<?php echo esc_url( $post_img ) ?>" width="570" height="730" loading="lazy" />
                        </a>
                    </div>
                    <?php } ?>

                    <div class="post-item__content">
                        <?php 
                        if ( ! empty( $settings['show_cats'] ) && $settings['show_cats'] == 'yes' ) {
                            the_terms( get_the_ID(), 'category', '<p class="post-item__cat">', ', ', '</p>' );
                        }
                        ?>
                        <a href="<?php the_permalink() ?>">
                            <p class="post-item__title"><?php the_title(); ?></p>
                        </a>
                        <?php if ( ! empty( $settings['show_date'] ) && $settings['show_date'] == 'yes' ) { ?>
                        <div class="post-item__date">
                            <img src="<?php echo ES_PLUGIN_URL . '/assets/images/calendar.svg'; ?>" />
                            <?php echo es_posted_time( false ); ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php 
            }
            ?>
            </div>
            <?php
            }
            } else {
            if ( $posts_query->have_posts() ) { ?>
                <div class="row">
                <?php
                while ( $posts_query->have_posts() ) { $posts_query->the_post();
                $img_bg = '';
                if(has_post_thumbnail()){
                    $img_bg = get_the_post_thumbnail_url(get_the_ID(), 'large');
                }
                ?>
                <div class="col-lg-4 col-md-4 col-sm-12 seo-el-full-img">
                    <div class="post-item post-item-grid" style="background-image: url(<?php echo esc_attr($img_bg); ?>);">
                        <div class="post-item__content">
                            <?php 
                            if ( ! empty( $settings['show_cats'] ) && $settings['show_cats'] == 'yes' ) {
                                the_terms( get_the_ID(), 'category', '<p class="post-item__cat">', '', '</p>' );
                            }
                            ?>
                            <a href="<?php the_permalink() ?>">
                                <p class="post-item__title"><?php the_title(); ?></p>
                            </a>
                            <?php if ( ! empty( $settings['show_date'] ) && $settings['show_date'] == 'yes' ) { ?>
                            <div class="post-item__date">
                                <img src="<?php echo ES_PLUGIN_URL . '/assets/images/calendar-white.svg'; ?>" />
                                <?php echo es_posted_time( false ); ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
                </div>
            <?php
            }
            }
            if ( ! empty( $settings['blog_button'] ) && $settings['blog_button'] == 'yes' ) {
            if ( ! empty( $settings['blog_button_link']['url'] ) ) {
                $button_attr[] = 'href="' . esc_attr( $settings['blog_button_link']['url'] ) . '"';
                $button_attr[] = 'target="'. ( ! empty( $settings['blog_button_link']['is_external'] ) ? '_blank' : '_self' ) . '"';
                $button_attr[] = ! empty( $settings['blog_button_link']['nofollow'] ) ? 'rel="nofollow"' : '';
            } else {
                $button_attr[] = 'href="#"';
            }
            if($layout == 'courses'){
                $button_attr[] = 'class="btn btn-medium btn--dark"';
            }
            ?>
            <div class="read-more-b">
                <a <?php echo implode( ' ', $button_attr ); ?>>
                    <p><?php echo esc_html($blog_button_text); ?></p>
                    <div class="read-more-decor">
					    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path d="M166.9 264.5l-117.8 116c-4.7 4.7-12.3 4.7-17 0l-7.1-7.1c-4.7-4.7-4.7-12.3 0-17L127.3 256 25.1 155.6c-4.7-4.7-4.7-12.3 0-17l7.1-7.1c4.7-4.7 12.3-4.7 17 0l117.8 116c4.6 4.7 4.6 12.3-.1 17z" class=""></path></svg>
                    </div>
                </a>
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