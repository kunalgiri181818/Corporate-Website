<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class PortfolioKitFrontend extends PortfolioKit {

	/**
	 * PortfolioKitFrontend Constructor
	 */
	public function __construct() {
		$this->define_slugs();

		// Scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'pk_add_scripts' ) );

		// Add inline css
		add_action( 'wp_enqueue_scripts', array( $this, 'pk_add_inline_scripts' ), 99 );

		// Register post type
		add_action( 'init', array( $this, 'pk_register_post_type' ) );

		// Register taxonomy cat
		add_action( 'init', array( $this, 'pk_register_taxonomy' ) );

		// Add shortcode
		add_shortcode( 'portfolio_kit', array( $this, 'pk_shortcode' ) );

		// Add customizer options
		add_action( 'customize_register', array( $this, 'pk_customizer_settings' ) );
		add_action( 'customize_preview_init', array( $this, 'pk_customizer_preview' ) );

		// Ajax get posts
		add_action( 'wp_ajax_pk_ajax_portfolio_get_posts', array( $this, 'pk_ajax_portfolio_get_posts_func' ) );
		add_action( 'wp_ajax_nopriv_pk_ajax_portfolio_get_posts', array( $this, 'pk_ajax_portfolio_get_posts_func' ) );

		// Change content
		add_filter( 'single_template', array( $this, 'pk_single_template' ) );

		// Before footer
		add_action( 'get_footer', array( $this, 'pk_before_footer_hook' ), 99 );

		// Archive template
		add_filter( 'taxonomy_template', array( $this, 'pk_archive_template' ) );
		add_action( 'pre_get_posts', array( $this, 'pk_archive_template_query' ) );


		// Like ajax
		add_action( 'wp_ajax_nopriv_process_pk_like', array( $this, 'process_pk_like' ) );
		add_action( 'wp_ajax_process_pk_like', array( $this, 'process_pk_like' ) );

		// Add image size
		add_image_size( 'pk-single-utouch', 220, 320, true );
		add_image_size( 'pk-thumbnail-modern', 370, 280, true );
		add_image_size( 'pk-logo', 260, 80, false );

		// Gutenberg blocks
		add_action( 'enqueue_block_editor_assets', array( $this, 'pk_block_scripts' ) );
		add_filter( 'block_categories_all', array( $this, 'pk_editor_block_category' ), 10, 2 );
		add_action( 'init', array( $this, 'pk_gutenberg_blocks' ) );

		// Kingcomposer
		add_action( 'init', array( $this, 'pk_kingcomposer' ), 999 );
		add_shortcode( 'portfolio_kit_kingcomposer', array( $this, 'pk_kingcomposer_shortcode' ) );
	}

	public function pk_add_scripts() {

		global $wp;

		wp_register_style( 'magnific-popup', PK_PLUGIN_URL . '/assets/css/magnific-popup.css' );
		wp_register_style( 'swiper', PK_PLUGIN_URL . '/assets/css/swiper.min.css' );
		wp_enqueue_style( 'pk-front', PK_PLUGIN_URL . '/assets/css/front.css', array(), PK_VERSION );

		wp_register_script( 'isotope', PK_PLUGIN_URL . '/assets/js/isotope.min.js', array( 'jquery' ), true );
		wp_register_script( 'magnific-popup', PK_PLUGIN_URL . '/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), true );
		wp_register_script( 'swiper', PK_PLUGIN_URL . '/assets/js/swiper.min.js', array( 'jquery' ), true );
		wp_register_script( 'pk-sharer', PK_PLUGIN_URL . '/assets/js/sharer.min.js', array( 'jquery' ), true );
		wp_register_script( 'pk-front', PK_PLUGIN_URL . '/assets/js/front.js', array(
			'jquery',
			'imagesloaded'
		), true );

		$current_url = home_url( add_query_arg( array(), $wp->request ) );
		wp_localize_script( 'pk-front', 'pk_vars', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'req'      => $current_url,
			'home_url' => home_url()
		) );

		if ( is_tax( 'portfolio-kit-cat' ) || is_tax( 'portfolio-kit-tag' ) ) {
			wp_enqueue_style( 'magnific-popup' );
			wp_enqueue_script( 'isotope');
			wp_enqueue_script( 'magnific-popup');
			wp_enqueue_script( 'pk-front');
		}
        if (is_singular( 'portfolio-kit' ) ){
	        wp_enqueue_style( 'swiper' );

	        wp_enqueue_script( 'swiper');
	        wp_enqueue_script( 'pk-sharer');
	        wp_enqueue_script( 'swiper');
	        wp_enqueue_script( 'pk-sharer');
	        wp_enqueue_script( 'pk-front');
        }


	}

	public function pk_add_inline_scripts() {
		$custom_css = '';

		$single_padding_top    = esc_html( get_theme_mod( 'pk_settings_single_padding_top', '10' ) );
		$single_padding_bottom = esc_html( get_theme_mod( 'pk_settings_single_padding_bottom', '10' ) );
		$single_background     = esc_html( get_theme_mod( 'pk_settings_single_background', '#ffffff' ) );

		if ( is_singular( 'portfolio-kit' ) ) {
			$single_padding_top    = $this->get_option( get_the_ID(), 'portfolio_kit_single_padding_top', $single_padding_top );
			$single_padding_bottom = $this->get_option( get_the_ID(), 'portfolio_kit_single_padding_bottom', $single_padding_bottom );
			$single_background     = $this->get_option( get_the_ID(), 'portfolio_kit_single_background', $single_background );
		}

		if ( $single_padding_top != '' || $single_padding_bottom != '' || $single_background != '' ) {
			$custom_css .= '.pk-single-cont{';
			if ( $single_padding_top != '' ) {
				$custom_css .= 'padding-top: ' . $single_padding_top . 'px;';
			}
			if ( $single_padding_bottom != '' ) {
				$custom_css .= 'padding-bottom: ' . $single_padding_bottom . 'px;';
			}
			if ( $single_background != '' ) {
				$custom_css .= 'background-color: ' . $single_background . ';';
			}
			$custom_css .= '}';
			if ( $single_background != '' ) {
				$custom_css .= '.pk-pagination{ background-color: ' . $single_background . '; }';
			}
		}

		$loop_primary   = esc_html( get_theme_mod( 'pk_settings_loop_primary' ) );
		$loop_secondary = esc_html( get_theme_mod( 'pk_settings_loop_secondary' ) );
		if ( $loop_primary != '' || $loop_secondary != '' ) {
			$custom_css .= 'html:root{';
			if ( $loop_primary != '' ) {
				$custom_css .= '--pk-main-color: ' . $loop_primary . ';';
			}
			if ( $loop_secondary != '' ) {
				$custom_css .= '--pk-single-bg: ' . $loop_secondary . ';';
			}
			$custom_css .= '}';
		}

		wp_add_inline_style( 'pk-front', $custom_css );
	}

	public function pk_customizer_preview() {
		wp_enqueue_script( 'pk-customizer', PK_PLUGIN_URL . '/assets/js/customize.js', array( 'customize-preview' ), time(), true );
	}

	public function pk_register_post_type() {
		$post_names = array(
			'singular' => __( 'Portfolio', 'portfolio-kit' ),
			'plural'   => __( 'Projects', 'portfolio-kit' )
		);

		register_post_type( 'portfolio-kit',
			array(
				'labels'             => array(
					'name'               => $post_names['plural'],
					'singular_name'      => $post_names['singular'],
					'add_new'            => __( 'Add New', 'portfolio-kit' ),
					'add_new_item'       => sprintf( __( 'Add New %s', 'portfolio-kit' ), $post_names['singular'] ),
					'edit'               => __( 'Edit', 'portfolio-kit' ),
					'edit_item'          => sprintf( __( 'Edit %s', 'portfolio-kit' ), $post_names['singular'] ),
					'new_item'           => sprintf( __( 'New %s', 'portfolio-kit' ), $post_names['singular'] ),
					'all_items'          => sprintf( __( 'All %s', 'portfolio-kit' ), $post_names['plural'] ),
					'view'               => sprintf( __( 'View %s', 'portfolio-kit' ), $post_names['singular'] ),
					'view_item'          => sprintf( __( 'View %s', 'portfolio-kit' ), $post_names['singular'] ),
					'search_items'       => sprintf( __( 'Search %s', 'portfolio-kit' ), $post_names['plural'] ),
					'featured_image'     => __( 'Project Cover Image', 'portfolio-kit' ),
					'not_found'          => sprintf( __( 'No %s Found', 'portfolio-kit' ), $post_names['plural'] ),
					'not_found_in_trash' => sprintf( __( 'No %s Found In Trash', 'portfolio-kit' ), $post_names['plural'] ),
					'parent_item_colon'  => ''
				),
				'description'        => __( 'Create a portfolio item', 'portfolio-kit' ),
				'public'             => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'publicly_queryable' => true,
				'has_archive'        => true,
				'rewrite'            => array(
					'slug' => $this->pk_slug
				),
				'menu_position'      => 4,
				'show_in_nav_menus'  => true,
				'menu_icon'          => 'dashicons-portfolio',
				'hierarchical'       => false,
				'query_var'          => true,
				'show_in_rest'       => true,
				'supports'           => array(
					'title',
					'editor',
					'thumbnail',
					'revisions'
				),
			)
		);
	}

	public function pk_register_taxonomy() {
		$category_names = array(
			'singular' => __( 'Category', 'portfolio-kit' ),
			'plural'   => __( 'Categories', 'portfolio-kit' )
		);

		$tag_names = array(
			'singular' => __( 'Tag', 'portfolio-kit' ),
			'plural'   => __( 'Tags', 'portfolio-kit' )
		);

		register_taxonomy( 'portfolio-kit-cat', 'portfolio-kit', array(
			'labels'            => array(
				'name'              => sprintf( _x( 'Portfolio %s', 'taxonomy general name', 'portfolio-kit' ), $category_names['plural'] ),
				'singular_name'     => sprintf( _x( 'Portfolio %s', 'taxonomy singular name', 'portfolio-kit' ), $category_names['singular'] ),
				'search_items'      => sprintf( __( 'Search %s', 'portfolio-kit' ), $category_names['plural'] ),
				'all_items'         => sprintf( __( 'All %s', 'portfolio-kit' ), $category_names['plural'] ),
				'parent_item'       => sprintf( __( 'Parent %s', 'portfolio-kit' ), $category_names['singular'] ),
				'parent_item_colon' => sprintf( __( 'Parent %s:', 'portfolio-kit' ), $category_names['singular'] ),
				'edit_item'         => sprintf( __( 'Edit %s', 'portfolio-kit' ), $category_names['singular'] ),
				'update_item'       => sprintf( __( 'Update %s', 'portfolio-kit' ), $category_names['singular'] ),
				'add_new_item'      => sprintf( __( 'Add New %s', 'portfolio-kit' ), $category_names['singular'] ),
				'new_item_name'     => sprintf( __( 'New %s Name', 'portfolio-kit' ), $category_names['singular'] ),
				'menu_name'         => $category_names['plural']
			),
			'public'            => true,
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'show_in_rest'      => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => false,
			'rewrite'           => array(
				'slug' => $this->pk_taxonomy_slug
			),
		) );

		register_taxonomy( 'portfolio-kit-tag', 'portfolio-kit', array(
			'hierarchical' => false,
			'labels'       => array(
				'name'                       => $tag_names['plural'],
				'singular_name'              => $tag_names['singular'],
				'search_items'               => sprintf( __( 'Search %s', 'portfolio-kit' ), $tag_names['plural'] ),
				'popular_items'              => sprintf( __( 'Popular %s', 'portfolio-kit' ), $tag_names['plural'] ),
				'all_items'                  => sprintf( __( 'All %s', 'portfolio-kit' ), $tag_names['plural'] ),
				'parent_item'                => null,
				'parent_item_colon'          => null,
				'edit_item'                  => sprintf( __( 'Edit %s', 'portfolio-kit' ), $tag_names['singular'] ),
				'update_item'                => sprintf( __( 'Update %s', 'portfolio-kit' ), $tag_names['singular'] ),
				'add_new_item'               => sprintf( __( 'Add New %s', 'portfolio-kit' ), $tag_names['singular'] ),
				'new_item_name'              => sprintf( __( 'New %s Name', 'portfolio-kit' ), $tag_names['singular'] ),
				'separate_items_with_commas' => sprintf( __( 'Separate %s with commas', 'portfolio-kit' ), strtolower( $tag_names['plural'] ) ),
				'add_or_remove_items'        => sprintf( __( 'Add or remove %s', 'portfolio-kit' ), strtolower( $tag_names['plural'] ) ),
				'choose_from_most_used'      => sprintf( __( 'Choose from the most used %s', 'portfolio-kit' ), strtolower( $tag_names['plural'] ) ),
			),
			'public'       => true,
			'show_ui'      => true,
			'query_var'    => true,
			'show_in_rest' => true,
			'rewrite'      => array(
				'slug' => $this->pk_taxonomy_tag_slug
			),
		) );
	}

	public function pk_post_loop( $terms = 0, $page = 0, $setting = array() ) {
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		if ( $page ) {
			$paged = $page;
		}

		$per_page   = ( isset( $setting['posts_per_page'] ) ) ? $setting['posts_per_page'] : get_option( 'posts_per_page' );
		$order      = ( isset( $setting['order'] ) ) ? $setting['order'] : 'DESC';
		$orderby    = 'date';
		$meta_terms = array();

		$args = array(
			'post_type'      => 'portfolio-kit',
			'paged'          => $paged,
			'posts_per_page' => $per_page,
			'order'          => $order,
			'orderby'        => $orderby,
		);

		if ( $setting['posts_ids'] != '' ) {
			$post_ids              = $setting['posts_ids'];
			$post_ids              = explode( ",", $post_ids );
			$exclude_post          = ( isset( $setting['exclude_posts'] ) && $setting['exclude_posts'] == 'yes' ) ? 'post__not_in' : 'post__in';
			$args[ $exclude_post ] = $post_ids;
		}

		if ( $setting['cats_ids'] != '' ) {
			$cats_ids      = $setting['cats_ids'];
			$cats_ids      = explode( ",", $cats_ids );
			$meta_terms    = $cats_ids;
			$meta_operator = ( isset( $setting['exclude_cats'] ) && $setting['exclude_cats'] == 'yes' ) ? 'NOT IN' : 'IN';
		}
		$tax_query = array();

		if ( ! empty( $meta_terms ) ) {
			$tax_query = array(
				array(
					'taxonomy' => 'portfolio-kit-cat',
					'field'    => 'term_id',
					'terms'    => $meta_terms,
					'operator' => $meta_operator,
				)
			);
		}

		if ( $terms ) {
			$tax_query['relation'] = 'AND';
			array_push( $tax_query, array(
				'taxonomy' => 'portfolio-kit-cat',
				'field'    => 'term_id',
				'terms'    => array( $terms ),
				'operator' => 'IN',
			) );
		}

		$args['tax_query'] = $tax_query;

		$porfolio_query = new WP_Query( $args );

		return $porfolio_query;
	}

	public function pk_shortcode( $atts ) {
		wp_enqueue_style( 'magnific-popup' );
		wp_enqueue_script( 'isotope');
		wp_enqueue_script( 'magnific-popup');
		wp_enqueue_script( 'pk-front');

		$pk_settings_loop_template       = get_theme_mod( 'pk_settings_loop_template', 'classic' );
		$pk_settings_loop_posts_per_page = get_theme_mod( 'pk_settings_loop_posts_per_page', '6' );
		$pk_settings_loop_cols           = get_theme_mod( 'pk_settings_loop_cols', '2' );
		$pk_settings_loop_pagination     = get_theme_mod( 'pk_settings_loop_pagination', 'numbers' );

		$atts = shortcode_atts( array(
			'template'       => $pk_settings_loop_template,
			'sort_panel'     => 'no',
			'cats_ids'       => '',
			'posts_ids'      => '',
			'exclude_cats'   => '',
			'exclude_posts'  => '',
			'order'          => 'DESC',
			'posts_per_page' => $pk_settings_loop_posts_per_page,
			'cols'           => $pk_settings_loop_cols,
			'pagination'     => $pk_settings_loop_pagination,
		), $atts );

		$content = '';
		$temp    = ( isset( $atts['template'] ) ) ? $atts['template'] : 'classic';

		$get_page  = ( isset( $_GET['pkpage'] ) ) ? esc_html( $_GET['pkpage'] ) : 0;
		$get_pkcat = ( isset( $_GET['pkcat'] ) ) ? esc_html( $_GET['pkcat'] ) : 0;

		$cats                             = array();
		$all_posts_atts                   = $atts;
		$all_posts_atts['posts_per_page'] = - 1;
		$all_posts_q                      = $this->pk_post_loop( 0, 0, $all_posts_atts );
		$all_posts                        = $all_posts_q->get_posts();

		$all_posts_count = 0;

		if ( ! empty( $all_posts ) ) {
			foreach ( $all_posts as $all_posts_item ) {
				$all_posts_count ++;
				$all_post_terms = wp_get_post_terms( $all_posts_item->ID, 'portfolio-kit-cat' );
				if ( ! empty( $all_post_terms ) ) {
					foreach ( $all_post_terms as $all_post_term ) {
						if ( isset( $cats[ $all_post_term->term_id ] ) ) {
							$term_count = $cats[ $all_post_term->term_id ]['count'] + 1;
						} else {
							$term_count = 1;
						}

						$cat_ids     = $all_posts_atts['cats_ids'];
						$cat_ids_arr = array();
						if ( $cat_ids != '' ) {
							$cat_ids_arr = explode( ",", $cat_ids );
							if ( $all_posts_atts['exclude_cats'] != 'yes' ) {
								if ( ! in_array( $all_post_term->term_id, $cat_ids_arr ) ) {
									continue;
								}
							}
						}

						$cats[ $all_post_term->term_id ] = array( 'name' => $all_post_term->name, 'count' => $term_count );
					}
				}
			}
		}
		ob_start();
		$the_query = $this->pk_post_loop( $get_pkcat, $get_page, $atts );

		global $wp;
		$req           = home_url( add_query_arg( array(), $wp->request ) );
		$data_settings = json_encode( $atts );
		?>
        <div class="pk-list-cont" data-settings="<?php echo esc_attr( $data_settings ); ?>">
			<?php if ( $atts['sort_panel'] == 'yes' && ! empty( $cats ) ) { ?>
                <ul class="pk-list-nav <?php echo esc_html( 'pk-nav-' . $temp ); ?>">
                    <li <?php if ( $get_pkcat == 0 ) {
						echo 'class="active"';
					} ?>>
                        <a href="#" data-cat="0" class="pk-filter-btn">
                            <span> <?php esc_html_e( 'All Projects', 'portfolio-kit' ); ?></span>
							<?php
							if ( $temp == 'modern' || $temp == 'modern-button' ) {
								?>
                                <span class="pk-list-nav-count"><?php echo esc_html( $all_posts_count ); ?></span>
								<?php
							}
							?>
                        </a>
                    </li>
					<?php
					foreach ( $cats as $cat_k => $cat ) {
						$cat_l    = $req . '/?pkcat=' . $cat_k;
						$cat_link = get_term_link( $cat_k, 'portfolio-kit-cat' );
						?>
                        <li <?php if ( $get_pkcat == $cat_k ) {
							echo 'class="active"';
						} ?>>
                            <a data-cat="<?php echo esc_attr( $cat_k ); ?>" href="<?php echo esc_url( $cat_link ); ?>" class="pk-filter-btn">
                                <span><?php echo esc_html( $cat['name'] ); ?></span>
								<?php
								if ( $temp == 'modern' || $temp == 'modern-button' ) {
									?>
                                    <span class="pk-list-nav-count"><?php echo esc_html( $cat['count'] ); ?></span>
									<?php
								}
								?>
                            </a>
                        </li>
					<?php } ?>
                </ul>
			<?php } ?>
			<?php
			$column_class = ( isset( $atts['cols'] ) ) ? $atts['cols'] : '2';
			?>
            <div class="pk-posts-loop pk-posts-loop-masonry <?php echo esc_html( 'pk-loop-' . $temp ); ?> <?php echo esc_html( 'pk-columns-' . $column_class ); ?>">
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <div class="pk-post-cont">
						<?php include $this->get_template_dir( 'loop-' . $temp . '.php' ); ?>
                    </div>
				<?php endwhile; ?>
            </div>

			<?php
			$cat_param = ( isset( $_GET['pkcat'] ) ) ? $_GET['pkcat'] : '';
			$format    = '?pkpage=%#%';

			if ( $cat_param != '' ) {
				$format = '?pkcat=' . intval( $cat_param ) . '&pkpage=%#%';
			}
			$enable_ajax = true;
			if ( ! $get_page && $the_query->max_num_pages < 2 ) {
				$enable_ajax = false;
			} elseif ( $get_page && $the_query->max_num_pages <= $get_page ) {
				$enable_ajax = false;
			}
			if ( $atts['pagination'] == 'numbers' ) { ?>
                <div class="pk-pagination-ajax main-pagination <?php echo esc_html( 'pk-pagin-' . $temp ); ?>">
                    <nav class="navigation-pages">
						<?php include $this->get_template_dir( 'pagination.php' ); ?>
                    </nav>
                </div>
				<?php
			} elseif ( $atts['pagination'] == 'ajax' && $enable_ajax ) {
				$next_page        = ( $get_page ) ? intval( $get_page ) + 1 : 2;
				$page_link_format = $req . '/' . str_replace( "%#%", intval( $next_page ), $format );
				?>
                <div class="pk-pagination-loadmore pk-pagination-ajax <?php echo esc_html( 'pk-loadmore-' . $temp ); ?>">
                    <a href="<?php echo esc_url( $page_link_format ); ?>" class="pk-load-more">
						<?php if ( $temp == 'seosight' ) { ?>
                            <span class="pk-load-more-img-wrap">
						<img src="<?php echo esc_url( PK_PLUGIN_URL . '/assets/images/load-more-line.svg' ); ?>"/>
					</span>
						<?php } ?>
                        <span class="pk-load-more-text"><?php esc_html_e( 'Load more', 'portfolio-kit' ); ?></span>
                    </a>
                </div>
			<?php } ?>
        </div>
		<?php
		$content = ob_get_clean();

		return $content;
	}

	public function pk_ajax_portfolio_get_posts_func() {
		$category = filter_input( INPUT_POST, 'category', FILTER_VALIDATE_INT );
		$page     = filter_input( INPUT_POST, 'page', FILTER_VALIDATE_INT );
		$settings = (array) json_decode( stripslashes( $_POST['settings'] ) );

		$the_query = $this->pk_post_loop( $category, $page, $settings );
		$grid      = '';
		ob_start();
		while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="pk-post-cont">
				<?php
				$temp = ( isset( $settings['template'] ) ) ? $settings['template'] : 'classic';
				include $this->get_template_dir( 'loop-' . $temp . '.php' ) ;
				?>
            </div>
			<?php
			wp_reset_postdata();
		endwhile;
		$grid = ob_get_clean();

		$format = '?pkpage=%#%';
		if ( $category != 0 ) {
			$format = '?pkcat=' . intval( $category ) . '&pkpage=%#%';
		}

		ob_start();
		include $this->get_template_dir( 'pagination.php' );
		$nav = ob_get_clean();

		$enable_ajax = '1';
		if ( ! $page && $the_query->max_num_pages < 2 ) {
			$enable_ajax = '0';
		} elseif ( $page && $the_query->max_num_pages == intval( $page ) ) {
			$enable_ajax = '0';
		}

		$next_page        = intval( $page ) + 1;
		$page_link_format = str_replace( "%#%", $next_page, $format );

		wp_send_json_success( array( 'grid' => $grid, 'nav' => $nav, 'enable_ajax' => $enable_ajax, 'page_link_format' => $page_link_format ) );
	}

	public function pk_customizer_settings( $wp_customize ) {
		$wp_customize->add_panel( 'pk_settings', array(
			'title'    => esc_html__( 'Portfolio Kit', 'portfolio-kit' ),
			'priority' => 150,
		) );

		// Loop settings
		$wp_customize->add_section( 'pk_settings_loop', array(
			'title' => esc_html__( 'Portfolio loop', 'portfolio-kit' ),
			'panel' => 'pk_settings',
		) );

		$wp_customize->add_setting( 'pk_settings_loop_primary', array(
			'transport'         => 'postMessage',
			'default'           => get_option( 'primary-accent-color' ),
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'pk_settings_loop_primary',
				array(
					'label'   => esc_html__( 'Primary color', 'portfolio-kit' ),
					'section' => 'pk_settings_loop',
					'type'    => 'color'
				) )
		);
		$wp_customize->add_setting( 'pk_settings_loop_secondary', array(
			'transport'         => 'postMessage',
			'default'           => get_option( 'secondary-accent-color' ),
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'pk_settings_loop_secondary',
				array(
					'label'   => esc_html__( 'Secondary color', 'portfolio-kit' ),
					'section' => 'pk_settings_loop',
					'type'    => 'color'
				) )
		);

		$wp_customize->add_setting( 'pk_settings_loop_template', array(
			'transport'         => 'refresh',
			'default'           => 'classic',
			'sanitize_callback' => array( $this, 'sanitize_select' ),
		) );
		$wp_customize->add_control( 'pk_settings_loop_template', array(
			'label'   => esc_html__( 'Loop template', 'portfolio-kit' ),
			'type'    => 'select',
			'choices' => array(
				'classic'       => esc_html__( 'Classic', 'portfolio-kit' ),
				'modern'        => esc_html__( 'Modern', 'portfolio-kit' ),
				'modern-button' => esc_html__( 'Modern button', 'portfolio-kit' ),
			),
			'section' => 'pk_settings_loop',
		) );

		$wp_customize->add_setting( 'pk_settings_loop_posts_per_page', array(
			'transport'         => 'refresh',
			'default'           => 6,
			'sanitize_callback' => 'absint',
		) );
		$wp_customize->add_control( 'pk_settings_loop_posts_per_page', array(
			'type'        => 'number',
			'label'       => esc_html__( 'Items per page', 'portfolio-kit' ),
			'description' => esc_html__( 'How many portfolios show per page', 'portfolio-kit' ),
			'section'     => 'pk_settings_loop',
		) );

		$wp_customize->add_setting( 'pk_settings_loop_cols', array(
			'transport'         => 'refresh',
			'default'           => '2',
			'sanitize_callback' => array( $this, 'sanitize_select' ),
		) );
		$wp_customize->add_control( 'pk_settings_loop_cols', array(
			'label'   => esc_html__( 'Columns number', 'portfolio-kit' ),
			'type'    => 'select',
			'choices' => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
			),
			'section' => 'pk_settings_loop',
		) );

		$wp_customize->add_setting( 'pk_settings_loop_pagination', array(
			'transport'         => 'refresh',
			'default'           => 'numbers',
			'sanitize_callback' => array( $this, 'sanitize_select' ),
		) );
		$wp_customize->add_control( 'pk_settings_loop_pagination', array(
			'label'       => esc_html__( 'Type of pages pagination', 'portfolio-kit' ),
			'description' => esc_html__( 'Select one of pagination types', 'portfolio-kit' ),
			'type'        => 'select',
			'choices'     => array(
				'numbers' => esc_html__( 'Numbers', 'portfolio-kit' ),
				'ajax'    => esc_html__( 'Load more ajax', 'portfolio-kit' ),
			),
			'section'     => 'pk_settings_loop',
		) );

		// Single post
		$wp_customize->add_section( 'pk_settings_single', array(
			'title' => esc_html__( 'Single post', 'portfolio-kit' ),
			'panel' => 'pk_settings',
		) );

		// Meta
		$wp_customize->add_setting( 'pk_settings_single_align', array(
			'transport'         => 'refresh',
			'default'           => 'left',
			'sanitize_callback' => array( $this, 'sanitize_select' ),
		) );
		$wp_customize->add_control( 'pk_settings_single_align', array(
			'label'       => esc_html__( 'Thumbnail / Slider align', 'portfolio-kit' ),
			'description' => esc_html__( 'Align project media on single page', 'portfolio-kit' ),
			'type'        => 'select',
			'choices'     => array(
				'left'   => esc_html__( 'Left', 'portfolio-kit' ),
				'center' => esc_html__( 'Center', 'portfolio-kit' ),
				'right'  => esc_html__( 'Right', 'portfolio-kit' ),
			),
			'section'     => 'pk_settings_single',
		) );

		$wp_customize->add_setting( 'pk_settings_single_likes', array(
			'transport'         => 'refresh',
			'default'           => '1',
			'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );
		$wp_customize->add_control( 'pk_settings_single_likes', array(
			'label'       => esc_html__( 'Show Like', 'portfolio-kit' ),
			'description' => esc_html__( 'Heart icon with counter who liked page', 'portfolio-kit' ),
			'type'        => 'checkbox',
			'section'     => 'pk_settings_single',
		) );

		$wp_customize->add_setting( 'pk_settings_single_date', array(
			'transport'         => 'refresh',
			'default'           => '1',
			'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );
		$wp_customize->add_control( 'pk_settings_single_date', array(
			'label'       => esc_html__( 'Show date?', 'portfolio-kit' ),
			'description' => esc_html__( 'Show block with date of created page', 'portfolio-kit' ),
			'type'        => 'checkbox',
			'section'     => 'pk_settings_single',
		) );

		$wp_customize->add_setting( 'pk_settings_single_share', array(
			'transport'         => 'refresh',
			'default'           => '1',
			'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );
		$wp_customize->add_control( 'pk_settings_single_share', array(
			'label'       => esc_html__( 'Show share icons?', 'portfolio-kit' ),
			'description' => esc_html__( 'Icons with script for share post in social networks', 'portfolio-kit' ),
			'type'        => 'checkbox',
			'section'     => 'pk_settings_single',
		) );

		require_once( PK_ABSPATH . 'includes/classes/customizer-controls/multiple-checkbox.php' );

		$wp_customize->add_setting( 'pk_settings_single_share_bttns', array(
				'transport'         => 'refresh',
				'default'           => array( 'facebook', 'twitter', 'linkedin', 'pinterest' ),
				'sanitize_callback' => array( $this, 'sanitize_multi_checkbox' )
			)
		);

		$wp_customize->add_control(
			new Pk_Customize_Control_Checkbox_Multiple(
				$wp_customize,
				'pk_settings_single_share_bttns',
				array(
					'section' => 'pk_settings_single',
					'label'   => esc_html__( 'Share buttons', 'portfolio-kit' ),
					'choices' => array(
						'facebook'  => esc_html__( 'Facebook', 'portfolio-kit' ),
						'twitter'   => esc_html__( 'Twitter', 'portfolio-kit' ),
						'linkedin'  => esc_html__( 'Linkedin', 'portfolio-kit' ),
						'pinterest' => esc_html__( 'Pinterest', 'portfolio-kit' ),
						'vk'        => esc_html__( 'Vkontakte', 'portfolio-kit' ),
						'reddit'    => esc_html__( 'Reddit', 'portfolio-kit' ),
						'tumblr'    => esc_html__( 'Tumblr', 'portfolio-kit' ),
						'whatsapp'  => esc_html__( 'Whatsapp', 'portfolio-kit' ),
						'xing'      => esc_html__( 'Xing', 'portfolio-kit' ),
					)
				)
			)
		);

		$wp_customize->add_setting( 'pk_settings_single_inner_nav', array(
			'transport'         => 'refresh',
			'default'           => '1',
			'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );
		$wp_customize->add_control( 'pk_settings_single_inner_nav', array(
			'label'       => esc_html__( 'Enable inner navigation', 'portfolio-kit' ),
			'description' => esc_html__( 'Show additional navigation after portfolio', 'portfolio-kit' ),
			'type'        => 'checkbox',
			'section'     => 'pk_settings_single',
		) );

		$wp_customize->add_setting( 'pk_settings_single_padding_top', array(
			'transport'         => 'postMessage',
			'default'           => '10',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'pk_settings_single_padding_top', array(
			'label'       => esc_html__( 'Section padding top', 'portfolio-kit' ),
			'description' => esc_html__( 'Top space in px', 'portfolio-kit' ),
			'type'        => 'number',
			'section'     => 'pk_settings_single',
		) );

		$wp_customize->add_setting( 'pk_settings_single_padding_bottom', array(
			'transport'         => 'postMessage',
			'default'           => '10',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'pk_settings_single_padding_bottom', array(
			'label'       => esc_html__( 'Section padding bottom', 'portfolio-kit' ),
			'description' => esc_html__( 'Bottom space in px', 'portfolio-kit' ),
			'type'        => 'number',
			'section'     => 'pk_settings_single',
		) );

		$wp_customize->add_setting( 'pk_settings_single_background', array(
			'transport'         => 'postMessage',
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'pk_settings_single_background',
				array(
					'label'   => esc_html__( 'Background color', 'portfolio-kit' ),
					'section' => 'pk_settings_single',
					'type'    => 'color'
				) )
		);
	}

	public function sanitize_multi_checkbox( $values ) {
		$multi_values = ! is_array( $values ) ? explode( ',', $values ) : $values;

		return ! empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
	}

	public function sanitize_checkbox( $checked ) {
		return ( ( isset( $checked ) && true === $checked ) ? true : false );
	}

	public function sanitize_select( $input, $setting ) {
		$input   = sanitize_key( $input );
		$choices = $setting->manager->get_control( $setting->id )->choices;

		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	public function pk_before_footer_hook( $content ) {
		global $post;
		if ( is_single() && isset( $post->post_type ) && $post->post_type == 'portfolio-kit' ) {

			load_template( $this->get_template_dir( 'share-buttons.php' ) );
			load_template( $this->get_template_dir( 'post-navigation.php' ) );

		} else {
			return $content;
		}
	}

	public function pk_archive_template( $tax_template ) {
		if ( is_tax( 'portfolio-kit-cat' ) || is_tax( 'portfolio-kit-tag' ) ) {
			$tax_template = $this->get_template_dir( 'archive-template.php' );
		}

		return $tax_template;
	}

	public function pk_archive_template_query( $query ) {
		if ( ! is_admin() && ( $query->is_tax( 'portfolio-kit-cat' ) || $query->is_tax( 'portfolio-kit-tag' ) ) ) {
			$pk_settings_loop_posts_per_page = get_theme_mod( 'pk_settings_loop_posts_per_page', '6' );
			$query->set( 'posts_per_page', $pk_settings_loop_posts_per_page );
		}
	}

	public function pk_single_template( $single_template ) {
		global $post;
		if ( isset( $post->post_type ) && $post->post_type == 'portfolio-kit' ) {
			return $this->get_template_dir( 'single-template.php' );
		} else {
			return $single_template;
		}
	}

	public function process_pk_like() {
		$nonce = isset( $_REQUEST['nonce'] ) ? sanitize_text_field( $_REQUEST['nonce'] ) : 0;
		if ( ! wp_verify_nonce( $nonce, 'pk-likes-nonce' ) ) {
			exit;
		}

		$post_id    = filter_input( INPUT_POST, 'postId', FILTER_VALIDATE_INT );
		$result     = array();
		$post_users = null;
		$like_count = 0;
		if ( $post_id != '' ) {
			$count = get_post_meta( $post_id, "_post_like_count", true ); // like count
			$count = ( isset( $count ) && is_numeric( $count ) ) ? $count : 0;
			if ( ! $this->pk_already_liked( $post_id ) ) {
				if ( is_user_logged_in() ) { // user is logged in
					$user_id    = get_current_user_id();
					$post_users = $this->pk_post_user_likes( $user_id, $post_id );

					$user_like_count = get_user_option( "_user_like_count", $user_id );
					$user_like_count = ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
					update_user_option( $user_id, "_user_like_count", ++ $user_like_count );
					if ( $post_users ) {
						update_post_meta( $post_id, "_user_liked", $post_users );
					}
				} else {
					$user_ip    = $this->pk_get_ip();
					$post_users = $this->pk_post_ip_likes( $user_ip, $post_id );
					// Update Post
					if ( $post_users ) {
						update_post_meta( $post_id, "_user_IP", $post_users );
					}
				}
				$like_count         = ++ $count;
				$response['status'] = "liked";

			} else {
				if ( is_user_logged_in() ) {
					$user_id    = get_current_user_id();
					$post_users = $this->pk_post_user_likes( $user_id, $post_id );

					$user_like_count = get_user_option( "_user_like_count", $user_id );
					$user_like_count = ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
					if ( $user_like_count > 0 ) {
						update_user_option( $user_id, '_user_like_count', -- $user_like_count );
					}

					if ( $post_users ) {
						$uid_key = array_search( $user_id, $post_users );
						unset( $post_users[ $uid_key ] );
						update_post_meta( $post_id, "_user_liked", $post_users );
					}
				} else {
					$user_ip    = $this->pk_get_ip();
					$post_users = $this->pk_post_ip_likes( $user_ip, $post_id, $is_comment = 0 );
					// Update Post
					if ( $post_users ) {
						$uip_key = array_search( $user_ip, $post_users );
						unset( $post_users[ $uip_key ] );
						if ( $is_comment == 1 ) {
							update_comment_meta( $post_id, "_user_comment_IP", $post_users );
						} else {
							update_post_meta( $post_id, "_user_IP", $post_users );
						}
					}
				}
				$like_count         = ( $count > 0 ) ? -- $count : 0; // Prevent negative number
				$response['status'] = "unliked";

			}

			update_post_meta( $post_id, "_post_like_count", $like_count );
			update_post_meta( $post_id, "_post_like_modified", date( 'Y-m-d H:i:s' ) );
			$response['count'] = $this->pk_format_count( intval( $like_count ) );

			wp_send_json( $response );
		}

		exit;
	}

	public function pk_format_count( $number ) {
		$precision = 2;
		if ( $number >= 1000 && $number < 1000000 ) {
			$formatted = number_format( $number / 1000, $precision ) . 'K';
		} else if ( $number >= 1000000 && $number < 1000000000 ) {
			$formatted = number_format( $number / 1000000, $precision ) . 'M';
		} else if ( $number >= 1000000000 ) {
			$formatted = number_format( $number / 1000000000, $precision ) . 'B';
		} else {
			$formatted = $number; // Number is less than 1000
		}
		$formatted = str_replace( '.00', '', $formatted );

		return $formatted;
	}

	public function pk_post_ip_likes( $user_ip, $post_id ) {
		$post_users      = '';
		$post_meta_users = get_post_meta( $post_id, "_user_IP" );
		// Retrieve post information
		if ( count( $post_meta_users ) != 0 ) {
			$post_users = $post_meta_users[0];
		}
		if ( ! is_array( $post_users ) ) {
			$post_users = array();
		}
		if ( ! in_array( $user_ip, $post_users ) ) {
			$post_users[ 'ip-' . $user_ip ] = $user_ip;
		}

		return $post_users;
	}

	public function pk_post_user_likes( $user_id, $post_id ) {
		$post_users      = '';
		$post_meta_users = get_post_meta( $post_id, "_user_liked" );
		if ( count( $post_meta_users ) != 0 ) {
			$post_users = $post_meta_users[0];
		}
		if ( ! is_array( $post_users ) ) {
			$post_users = array();
		}
		if ( ! in_array( $user_id, $post_users ) ) {
			$post_users[ 'user-' . $user_id ] = $user_id;
		}

		return $post_users;
	}

	public function pk_already_liked( $post_id ) {
		$post_users = null;
		$user_id    = null;
		if ( is_user_logged_in() ) { // user is logged in
			$user_id         = get_current_user_id();
			$post_meta_users = get_post_meta( $post_id, "_user_liked" );
			if ( count( $post_meta_users ) != 0 ) {
				$post_users = $post_meta_users[0];
			}
		} else { // user is anonymous
			$user_id         = $this->pk_get_ip();
			$post_meta_users = get_post_meta( $post_id, "_user_IP" );
			if ( count( $post_meta_users ) != 0 ) { // meta exists, set up values
				$post_users = $post_meta_users[0];
			}
		}
		if ( is_array( $post_users ) && in_array( $user_id, $post_users ) ) {
			return true;
		} else {
			return false;
		}
	}

	public function pk_get_ip() {
		$ip        = '0.0.0.0';
		$client_ip = filter_input( INPUT_SERVER, 'HTTP_CLIENT_IP', FILTER_VALIDATE_IP );
		$forwarded = filter_input( INPUT_SERVER, 'HTTP_X_FORWARDED_FOR', FILTER_VALIDATE_IP );
		$remote    = filter_input( INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP );

		if ( $client_ip ) {
			$ip = $client_ip;
		} elseif ( $forwarded ) {
			$ip = $forwarded;
		} elseif ( $remote ) {
			$ip = $remote;
		}

		return $ip;
	}

	public function pk_gutenberg_blocks() {
		$depends = array( 'wp-blocks', 'wp-i18n' );

		if ( wp_script_is( 'wp-edit-widgets' ) ) {
			$depends[] = 'wp-edit-widgets';
		} else {
			$depends[] = 'wp-edit-post';
		}

		wp_register_script( 'pk-editor-blocks', PK_PLUGIN_URL . '/assets/js/pk-block.js', $depends, true );
		$pk_settings_loop_template       = get_theme_mod( 'pk_settings_loop_template', 'classic' );
		$pk_settings_loop_posts_per_page = get_theme_mod( 'pk_settings_loop_posts_per_page', '6' );
		$pk_settings_loop_cols           = get_theme_mod( 'pk_settings_loop_cols', '2' );
		$pk_settings_loop_pagination     = get_theme_mod( 'pk_settings_loop_pagination', 'numbers' );

		wp_localize_script( 'pk-editor-blocks', 'pk_global_settings',
			array(
				'pk_settings_loop_template'       => $pk_settings_loop_template,
				'pk_settings_loop_posts_per_page' => $pk_settings_loop_posts_per_page,
				'pk_settings_loop_pagination'     => $pk_settings_loop_pagination,
				'pk_settings_loop_cols'           => $pk_settings_loop_cols,
			)
		);

		register_block_type(
			'pk/portfoliokit',
			array(
				'api_version'     => 2,
				'editor_style'    => 'pk-editor-block-css',
				'editor_script'   => 'pk-editor-blocks',
				'render_callback' => array( $this, 'pk_gutenberg_block_output' ),
				'attributes'      => array(
					'template'       => array(
						'type' => 'string'
					),
					'sort_panel_p'   => array(
						'type' => 'boolean'
					),
					'order'          => array(
						'type' => 'string'
					),
					'posts_per_page' => array(
						'type' => 'number'
					),
					'cols'           => array(
						'type' => 'string'
					),
					'pagination'     => array(
						'type' => 'string'
					)
				)
			)
		);
	}

	public function pk_gutenberg_block_output( $block_attributes, $content ) {
		$shortcodes_attr = array();
		if ( ! empty( $block_attributes['posts_per_page'] ) ) {
			$shortcodes_attr[] = 'posts_per_page="' . $block_attributes['posts_per_page'] . '"';
		}

		if ( ! empty( $block_attributes['template'] ) ) {
			$shortcodes_attr[] = 'template="' . $block_attributes['template'] . '"';
		}

		if ( ! empty( $block_attributes['order'] ) ) {
			$shortcodes_attr[] = 'order="' . $block_attributes['order'] . '"';
		}

		if ( ! empty( $block_attributes['cols'] ) ) {
			$shortcodes_attr[] = 'cols="' . $block_attributes['cols'] . '"';
		}

		if ( ( isset( $block_attributes['sort_panel_p'] ) && $block_attributes['sort_panel_p'] == '' ) ) {
			$shortcodes_attr[] = 'sort_panel="no"';
		} else {
			$shortcodes_attr[] = 'sort_panel="yes"';
		}

		if ( ! empty( $block_attributes['pagination'] ) ) {
			$shortcodes_attr[] = 'pagination="' . $block_attributes['pagination'] . '"';
		}

		return do_shortcode( '[portfolio_kit ' . implode( ' ', $shortcodes_attr ) . ']' );
	}

	public function pk_block_scripts() {
		wp_enqueue_style( 'pk-editor-block-css', PK_PLUGIN_URL . '/assets/css/front.css' );
	}

	public function pk_editor_block_category( $categories, $post ) {
		return array_merge(
			$categories,
			array(
				array(
					'slug'  => 'pk_blocks',
					'title' => esc_html__( 'Portfolio kit', 'portfolio-kit' ),
				),
			)
		);
	}

	public function pk_kingcomposer() {
		if ( ! in_array( 'kingcomposer/kingcomposer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			return false;
		}

		global $kc;

		$pk_settings_loop_template       = get_theme_mod( 'pk_settings_loop_template', 'classic' );
		$pk_settings_loop_posts_per_page = get_theme_mod( 'pk_settings_loop_posts_per_page', '6' );
		$pk_settings_loop_cols           = get_theme_mod( 'pk_settings_loop_cols', '2' );
		$pk_settings_loop_pagination     = get_theme_mod( 'pk_settings_loop_pagination', 'numbers' );

		$portfolio_terms        = get_terms( 'portfolio-kit-cat' );
		$portfolio_terms_select = array();
		if ( ! empty( $portfolio_terms ) ) {
			foreach ( $portfolio_terms as $portfolio_term ) {
				$portfolio_terms_select[ $portfolio_term->term_id ] = $portfolio_term->name;
			}
		}

		$kc->add_map(
			array(
				'portfolio_kit_kingcomposer' => array(
					'name'     => esc_html__( 'Portfolio kit', 'portfolio-kit' ),
					'title'    => 'Portfolio kit',
					'category' => 'Content',
					'icon'     => 'dashicons dashicons-layout',
					'params'   => array(
						'general' => array(
							array(
								'name'    => 'template',
								'label'   => esc_html__( 'Template', 'portfolio-kit' ),
								'type'    => 'dropdown',
								'value'   => $pk_settings_loop_template,
								'options' => array(
									'classic'       => esc_html__( 'Classic', 'portfolio-kit' ),
									'modern'        => esc_html__( 'Modern', 'portfolio-kit' ),
									'modern-button' => esc_html__( 'Modern button', 'portfolio-kit' ),
								)
							),
							array(
								'name'        => 'sort_panel',
								'label'       => esc_html__( 'Sort panel', 'portfolio-kit' ),
								'description' => esc_html__( 'Panel before items with taxonomy categories', 'portfolio-kit' ),
								'type'        => 'toggle',
							),
							array(
								'name'        => 'sort_posts',
								'label'       => esc_html__( 'Include only', 'portfolio-kit' ),
								'description' => esc_html__( 'Include only posts with sort parameter', 'portfolio-kit' ),
								'type'        => 'dropdown',
								'value'       => 'disabled',
								'options'     => array(
									'disabled' => esc_html__( 'Disabled', 'portfolio-kit' ),
									'posts'    => esc_html__( 'Posts', 'portfolio-kit' ),
									'cats'     => esc_html__( 'Categories', 'portfolio-kit' ),
								)
							),
							array(
								'name'     => 'posts_ids',
								'label'    => esc_html__( 'Select posts', 'portfolio-kit' ),
								'type'     => 'autocomplete',
								'options'  => array(
									'multiple'  => true,
									'post_type' => 'portfolio-kit'
								),
								'relation' => array(
									'parent'    => 'sort_posts',
									'show_when' => 'posts'
								)
							),
							array(
								'name'     => 'cats_ids',
								'label'    => esc_html__( 'Select categories', 'portfolio-kit' ),
								'type'     => 'multiple',
								'options'  => $portfolio_terms_select,
								'relation' => array(
									'parent'    => 'sort_posts',
									'show_when' => 'cats'
								)
							),
							array(
								'name'     => 'exclude',
								'label'    => esc_html__( 'Exclude selected ids', 'portfolio-kit' ),
								'type'     => 'toggle',
								'value'    => 'no',
								'relation' => array(
									'parent'    => 'sort_posts',
									'hide_when' => 'disabled'
								)
							),
							array(
								'name'        => 'order',
								'label'       => esc_html__( 'Order', 'portfolio-kit' ),
								'description' => esc_html__( 'Designates the ascending or descending order of items', 'portfolio-kit' ),
								'type'        => 'dropdown',
								'value'       => 'DESC',
								'options'     => array(
									'DESC' => esc_html__( 'Descending', 'portfolio-kit' ),
									'ASC'  => esc_html__( 'Ascending', 'portfolio-kit' ),
								)
							),
							array(
								'name'        => 'posts_per_page',
								'label'       => esc_html__( 'Items per page', 'portfolio-kit' ),
								'description' => esc_html__( 'How many portfolios show per page', 'portfolio-kit' ),
								'type'        => 'text',
								'value'       => $pk_settings_loop_posts_per_page,
							),
							array(
								'name'        => 'pagination',
								'label'       => esc_html__( 'Type of pages pagination', 'portfolio-kit' ),
								'description' => esc_html__( 'Select one of pagination types', 'portfolio-kit' ),
								'type'        => 'dropdown',
								'value'       => $pk_settings_loop_pagination,
								'options'     => array(
									'numbers' => esc_html__( 'Numbers', 'portfolio-kit' ),
									'ajax'    => esc_html__( 'Load more ajax', 'portfolio-kit' ),
								)
							),
						),
					)
				)
			)
		);
	}

	public function pk_kingcomposer_shortcode( $atts ) {
		$shortcodes_attr = array();
		if ( ! empty( $atts['posts_per_page'] ) ) {
			$shortcodes_attr[] = 'posts_per_page="' . $atts['posts_per_page'] . '"';
		}

		if ( ! empty( $atts['template'] ) ) {
			$shortcodes_attr[] = 'template="' . $atts['template'] . '"';
		}

		if ( ! empty( $atts['order'] ) ) {
			$shortcodes_attr[] = 'order="' . $atts['order'] . '"';
		}

		if ( ! empty( $atts['sort_panel'] ) ) {
			$shortcodes_attr[] = 'sort_panel="' . $atts['sort_panel'] . '"';
		}

		if ( ! empty( $atts['pagination'] ) ) {
			$shortcodes_attr[] = 'pagination="' . $atts['pagination'] . '"';
		}

		if ( ! empty( $atts['sort_posts'] && $atts['sort_posts'] == 'posts' ) ) {
			$posts_ids_out = array();
			$posts_ids     = $atts['posts_ids'];
			if ( ! empty( $posts_ids ) ) {
				$posts_ids_arr = explode( ",", $posts_ids );
				if ( ! empty( $posts_ids_arr ) ) {
					foreach ( $posts_ids_arr as $posts_ids_itm ) {
						$posts_ids_itm = explode( ":", $posts_ids_itm );
						if ( isset( $posts_ids_itm[0] ) ) {
							array_push( $posts_ids_out, $posts_ids_itm[0] );
						}
					}
				}
				$posts_ids_st = '';
				if ( ! empty( $posts_ids_out ) ) {
					$posts_ids_st = implode( ",", $posts_ids_out );
				}
				$shortcodes_attr[] = 'posts_ids="' . $posts_ids_st . '"';
			}
			if ( ! empty( $atts['exclude'] ) ) {
				$shortcodes_attr[] = 'exclude_posts="' . $atts['exclude'] . '"';
			}
		}
		if ( ! empty( $atts['sort_posts'] && $atts['sort_posts'] == 'cats' ) ) {
			$cats_ids = $atts['cats_ids'];
			if ( ! empty( $cats_ids ) ) {
				$shortcodes_attr[] = 'cats_ids="' . $cats_ids . '"';
			}
			if ( ! empty( $atts['exclude'] ) ) {
				$shortcodes_attr[] = 'exclude_cats="' . $atts['exclude'] . '"';
			}
		}

		$wrp_class 	= apply_filters( 'kc-el-class', $atts );

		return '<div class="'.implode( ' ', $wrp_class ).'">' . do_shortcode( '[portfolio_kit ' . implode( ' ', $shortcodes_attr ) . ']' ) . '</div>';
	}
}

return new PortfolioKitFrontend();