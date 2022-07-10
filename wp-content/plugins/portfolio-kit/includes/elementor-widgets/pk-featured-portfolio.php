<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Pk_Featured_Portfolio extends \Elementor\Widget_Base {

    public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
  
		wp_register_script( 'pk-el-main', PK_PLUGIN_URL . '/assets/js/pk-el.js', array( 'elementor-frontend'), '', true );
	}

    public function get_name() {
		return 'pk-featured-portfolio';
	}

	public function get_title() {
		return esc_html__( 'Featured portfolio', 'portfolio-kit' );
	}

	public function get_icon() {
		return 'dashicons dashicons-layout';
	}

    public function get_script_depends() {
        return [ 'swiper', 'pk-el-main' ];
    }

	public function get_categories() {
		return [ 'elementor-portfolio-kit' ];
	}

	protected function _register_controls() {
        $this->start_controls_section(
			'pk_featured_portfolio_block',
			[
				'label' => esc_html__( 'Featured portfolio', 'portfolio-kit' )
			]
		);

        $this->add_control(
            'layout', 
            [
                'type'    => \Elementor\Controls_Manager::SELECT,
                'label'   => esc_html__( 'Select Template', 'portfolio-kit' ),
                'options' => [
                	'grid' => esc_html__( 'Grid', 'portfolio-kit' ),
                	'slider' => esc_html__( 'Slider', 'portfolio-kit' ),
                ],
                'default' => 'grid',
            ]
        );

        $this->add_control(
            'number_of_items',
            [
                'type'        => \Elementor\Controls_Manager::SLIDER,
                'label'       => esc_html__( 'Items per page', 'portfolio-kit' ),
                'description' => esc_html__( 'Number of items displayed on one screen', 'portfolio-kit' ),
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
                    'size' => 2
                ],
                'separator'   => 'before'
            ]
        );

        $this->add_control(
            'custom_class',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Custom class', 'portfolio-kit' ),
                'description' => esc_html__( 'Enter extra custom class', 'portfolio-kit' ),
                'separator'   => 'before'
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {
		$settings = $this->get_settings_for_display();
        $number_of_items = ! empty( $settings['number_of_items']['size'] ) ? $settings['number_of_items']['size'] : 3;
        $layout = ! empty( $settings['layout'] ) ? $settings['layout'] : 'grid';

        $args = array(
            'post_type' => 'portfolio-kit',
            'posts_per_page' => $number_of_items,
        );

        $posts_query = new WP_Query( $args );

        $wrap_class = [ 'pk-el-featured-posts' ];
		if ( ! empty( $settings['custom_class'] ) ) {
            $wrap_class[] = $settings['custom_class'];
        }
        ?>
        <div class="<?php echo esc_attr( implode( ' ', $wrap_class ) ) ?>">
            <?php if ( $posts_query->have_posts() ) { ?>
                <?php if( $layout == 'grid' ){ ?>
                <div class="pk-el-featured-posts-row">
                    <?php
                        while ( $posts_query->have_posts() ) { $posts_query->the_post();
                        $cat_list = get_the_term_list( get_the_ID(), 'portfolio-kit-cat', '', ', ' );
                        $open_image = get_post_meta(get_the_ID(), 'portfolio_kit_page_behavior', true);
                        $permalink = get_the_permalink();
                        $img_class = 'pk-thumbnail-image';
                        if( $open_image == 'lightbox' ){
                            $permalink = get_the_post_thumbnail_url( get_post()->ID, 'full' );
                            $img_class .= ' pk-popup-image';
                        }
                    ?>
                        <div class="pk-el-featured-posts-item pk-post-modern pk-post-modern-button pk-post-classic">
                            <a href="<?php echo esc_url( $permalink ) ?>" class="<?php echo esc_attr($img_class); ?>">
                                <?php echo get_the_post_thumbnail( get_the_ID(), 'medium_large' ); ?>
                            </a>
                            <div class="pk-post-modern-content pk-post-modern-content-row">
                                <div class="pk-post-modern-content-txt">
                                    <?php if($cat_list){ ?>
                                    <div class="pk-post-modern-cats">
                                    <?php echo $cat_list; ?>
                                    </div>
                                    <?php } ?>
                                    <?php if( $open_image != 'lightbox' ){ ?>
                                    <a href="<?php echo esc_url( $permalink ) ?>" class="pk-post-modern-title">
                                        <?php the_title(); ?>
                                    </a>
                                    <?php } else { ?>
                                    <p class="pk-post-modern-title"><?php the_title(); ?>
                                    <?php } ?>
                                </div>
                                <div class="pk-post-modern-content-new">
                                    <p><?php echo esc_html__( 'New', 'portfolio-kit' ); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php } elseif( $layout == 'slider' ) { ?>
                    <div class="pk-el-featured-posts-swiper-container">
                        <div class="swiper-wrapper">
                            <?php
                            while ( $posts_query->have_posts() ) { $posts_query->the_post();
                            $logo = get_post_meta(get_the_ID(), 'portfolio_kit_logo', true);
                            $cat_list = get_the_term_list( get_the_ID(), 'portfolio-kit-cat', '', ', ' );
                            $open_image = get_post_meta(get_the_ID(), 'portfolio_kit_page_behavior', true);
                            $permalink = get_the_permalink();
                            $img_class = 'pk-thumbnail-image';
                            if( $open_image == 'lightbox' ){
                                $permalink = get_the_post_thumbnail_url( get_post()->ID, 'full' );
                                $img_class .= ' pk-popup-image';
                            }
                            ?>
                            <div class="swiper-slide">
                                <div class="pk-el-featured-posts-item-slider">
                                    <a href="<?php echo esc_url( $permalink ) ?>" class="<?php echo esc_attr($img_class); ?>">
                                        <?php echo get_the_post_thumbnail( get_the_ID(), 'medium_large', array('class' => 'pk-el-featured-posts-img') ); ?>
                                    </a>
                                    <div class="pk-el-featured-posts-item-slider-row">
                                        <div class="pk-el-featured-posts-item-slider-content">
                                            <?php if( $logo != '' ){ ?>
                                            <div class="pk-el-featured-posts-logo">
                                                <?php echo wp_get_attachment_image($logo, 'pk-logo'); ?>
                                            </div>
                                            <?php } ?>
                                            <?php if($cat_list){ ?>
                                            <div class="pk-el-featured-posts-cats">
                                            <?php echo $cat_list; ?>
                                            </div>
                                            <?php } ?>
                                            <?php if( $open_image != 'lightbox' ){ ?>
                                            <a href="<?php echo esc_url( $permalink ) ?>" class="pk-post-featured-posts-title">
                                                <?php the_title(); ?>
                                            </a>
                                            <?php } else { ?>
                                            <p class="pk-post-featured-posts-title"><?php the_title(); ?>
                                            <?php } ?>
                                            <p class="pk-post-featured-posts-descr"><?php echo get_the_excerpt(); ?></p>

                                            <?php if( $open_image != 'lightbox' ){ ?>
                                            <a class="pk-post-datails-bttn" href="<?php echo esc_url( $permalink ) ?>">
                                                <span><?php echo esc_html__( 'More Details', 'portfolio-kit' ); ?></span>
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="14px">
                                                    <path d="M14.809,0.193 C14.510,-0.090 14.011,-0.090 13.700,0.193 C13.401,0.464 13.401,0.916 13.700,1.186 L19.324,6.278 L0.768,6.278 C0.336,6.278 -0.008,6.589 -0.008,6.980 C-0.008,7.372 0.336,7.692 0.768,7.692 L19.324,7.692 L13.700,12.775 C13.401,13.056 13.401,13.508 13.700,13.779 C14.011,14.059 14.510,14.059 14.809,13.779 L21.764,7.482 C22.074,7.211 22.074,6.759 21.764,6.490 L14.809,0.193 Z"/>
                                                </svg>
                                            </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="swiper-pagination el-pk-swiper-pagination"></div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <?php
    }
}