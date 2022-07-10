<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Elementor_Pk_Main extends \Elementor\Widget_Base {
    public function get_name() {
		return 'pk-main';
	}

	public function get_title() {
		return esc_html__( 'Portfolio Kit', 'portfolio-kit' );
	}

	public function get_icon() {
		return 'dashicons dashicons-layout';
	}

	public function get_categories() {
		return [ 'elementor-portfolio-kit' ];
	}

	protected function _register_controls() {
        $pk_settings_loop_template = get_theme_mod('pk_settings_loop_template', 'classic');
        $pk_settings_loop_posts_per_page = get_theme_mod('pk_settings_loop_posts_per_page', '6');
        $pk_settings_loop_cols = get_theme_mod('pk_settings_loop_cols', '2');
        $pk_settings_loop_pagination = get_theme_mod('pk_settings_loop_pagination', 'numbers');

        $this->start_controls_section(
			'pk_main',
			[
				'label' => esc_html__( 'Portfolio Kit Settings', 'portfolio-kit' )
			]
		);

        $this->add_control(
			'template',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => esc_html__( 'Template', 'portfolio-kit' ),
                'options'   => [
					'classic' => esc_html__( 'Classic', 'portfolio-kit' ),
					'modern' => esc_html__( 'Modern', 'portfolio-kit' ),
					'modern-button' => esc_html__( 'Modern button', 'portfolio-kit' ),
				],
                'default' => $pk_settings_loop_template,
			]
        );

        $this->add_control(
			'sort_panel',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => esc_html__( 'Sort panel', 'portfolio-kit' ),
                'description' => esc_html__( 'Panel before items with taxonomy categories', 'portfolio-kit' ),
                'default' => 'yes',
                'separator' => 'before'
			]
        );

        $this->add_control(
			'sort_posts',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => esc_html__( 'Include only', 'portfolio-kit' ),
                'description' => esc_html__( 'Include only posts with sort parameter', 'portfolio-kit' ),
                'options'   => [
					'disabled' => esc_html__( 'Disabled', 'portfolio-kit' ),
					'posts' => esc_html__( 'Posts', 'portfolio-kit' ),
					'cats' => esc_html__( 'Categories', 'portfolio-kit' ),
				],
                'default' => 'disabled',
                'separator' => 'before'
			]
        );

        $query = new WP_Query( array(
            'post_type' => 'portfolio-kit',
            'posts_per_page' => -1
        ) );

        $portfolio_posts = $query->get_posts();
        $portfolio_posts_select = array();   
        if( !empty($portfolio_posts) ){
            foreach($portfolio_posts as $portfolio_post){
                $portfolio_posts_select[$portfolio_post->ID] = $portfolio_post->post_title;
            }
        }

        $this->add_control(
			'posts_ids',
			[
				'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
				'label' => esc_html__( 'Select posts', 'portfolio-kit' ),
                'options' => $portfolio_posts_select,
                'condition' => [
                    'sort_posts' => 'posts',
                ],
			]
        );

        $portfolio_terms = get_terms( 'portfolio-kit-cat' );
        $portfolio_terms_select = array();
        if( !empty($portfolio_terms) ){
            foreach($portfolio_terms as $portfolio_term){
                $portfolio_terms_select[$portfolio_term->term_id] = $portfolio_term->name;
            }
        }

        $this->add_control(
			'cats_ids',
			[
				'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
				'label' => esc_html__( 'Select categories', 'portfolio-kit' ),
                'options' => $portfolio_terms_select,
                'condition' => [
                    'sort_posts' => 'cats',
                ],
			]
        );

        $this->add_control(
			'exclude',
			[
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => esc_html__( 'Exclude selected ids', 'portfolio-kit' ),
                'condition' => [
                    'sort_posts!' => 'disabled',
                ],
                'default' => 'no',
			]
        );

        $this->add_control(
			'order',
			[
				'type'      => \Elementor\Controls_Manager::SELECT,
				'label'     => esc_html__( 'Order', 'portfolio-kit' ),
                'description' => esc_html__( 'Designates the ascending or descending order of items', 'portfolio-kit' ),
				'options'   => [
					'DESC' => esc_html__( 'Descending', 'portfolio-kit' ),
					'ASC' => esc_html__( 'Ascending', 'portfolio-kit' ),
				],
                'default'   => 'DESC',
                'separator' => 'before'
			]
		);

        $this->add_control(
            'posts_per_page',
            [
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label' => esc_html__( 'Items per page', 'portfolio-kit'),
                'description' => esc_html__( 'How many portfolios show per page', 'portfolio-kit' ),
                'default' => $pk_settings_loop_posts_per_page,
                'min' => '1',
                'separator' => 'before'
            ]
		);

        $this->add_control(
            'cols',
            [
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => esc_html__( 'Columns number', 'portfolio-kit'),
                'options'   => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
				],
                'default'   => $pk_settings_loop_cols,
                'separator' => 'before'
            ]
		);

        $this->add_control(
			'pagination',
			[
				'type'      => \Elementor\Controls_Manager::SELECT,
				'label'     => esc_html__( 'Type of pages pagination', 'portfolio-kit' ),
                'description' => esc_html__( 'Select one of pagination types', 'portfolio-kit' ),
				'options'   => [
					'numbers' => esc_html__( 'Numbers', 'portfolio-kit' ),
					'ajax' => esc_html__( 'Load more ajax', 'portfolio-kit' ),
				],
                'default'   => $pk_settings_loop_pagination,
                'separator' => 'before'
			]
		);

        $this->add_control(
            'class',
            [
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label'       => esc_html__( 'Extra class', 'portfolio-kit' ),
                'description' => esc_html__( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'portfolio-kit' ),
                'separator'   => 'before'
            ]
        );
    }

	protected function render() {
		$settings = $this->get_settings_for_display();
        $shortcodes_attr = array();

        $wrap_class = [ 'pk-list-cont-elem' ];
        if ( ! empty( $settings['class'] ) ) {
			$wrap_class[] = $settings['class'];
		}

        if ( ! empty( $settings['posts_per_page'] ) ) {
            $shortcodes_attr[] = 'posts_per_page="'.$settings['posts_per_page'].'"';
        }

        if ( ! empty( $settings['template'] ) ) {
            $shortcodes_attr[] = 'template="'.$settings['template'].'"';
        }

        if ( ! empty( $settings['order'] ) ) {
            $shortcodes_attr[] = 'order="'.$settings['order'].'"';
        }

        if ( ! empty( $settings['sort_panel'] ) ) {
            $shortcodes_attr[] = 'sort_panel="'.$settings['sort_panel'].'"';
        }

        if ( ! empty( $settings['pagination'] ) ) {
            $shortcodes_attr[] = 'pagination="'.$settings['pagination'].'"';
        }

        if ( ! empty( $settings['cols'] ) ) {
            $shortcodes_attr[] = 'cols="'.$settings['cols'].'"';
        }

        if ( ! empty( $settings['sort_posts'] && $settings['sort_posts'] == 'posts' ) ) {
            $posts_ids = $settings['posts_ids'];
            if( !empty($posts_ids) ){
                $posts_ids_st = implode(",", $posts_ids);
                $shortcodes_attr[] = 'posts_ids="'.$posts_ids_st.'"';
            }
            if ( ! empty( $settings['exclude'] ) ){
                $shortcodes_attr[] = 'exclude_posts="'.$settings['exclude'].'"';
            }
        }
        if ( ! empty( $settings['sort_posts'] && $settings['sort_posts'] == 'cats' ) ) {
            $cats_ids = $settings['cats_ids'];
            if( !empty($cats_ids) ){
                $cats_ids_st = implode(",", $cats_ids);
                $shortcodes_attr[] = 'cats_ids="'.$cats_ids_st.'"';
            }
            if ( ! empty( $settings['exclude'] ) ){
                $shortcodes_attr[] = 'exclude_cats="'.$settings['exclude'].'"';
            }
        }
        ?>
        <div class="<?php echo esc_attr( implode( ' ', $wrap_class ) ); ?>">
            <?php 
            $shortcode = '[portfolio_kit '.implode( ' ', $shortcodes_attr ).']';
            echo do_shortcode($shortcode); ?>
        </div>
        <?php if(is_admin()) { ?>
        <script>
        jQuery('.pk-list-cont .pk-posts-loop-masonry').each(function(){
            const $portfolioGrid = jQuery(this);
        
            $portfolioGrid.isotope({
                itemSelector: '.pk-post-cont',
            });
        });
        </script>
        <?php
        }
    }
}