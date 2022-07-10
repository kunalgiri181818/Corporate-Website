<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class PortfolioKitAdmin extends PortfolioKit {
    /**
	 * PortfolioKitAdmin Constructor
	 */
	public function __construct() {
        $this->define_slugs();
        $this->pk_fields_set = new PortfolioKitFields();

        // Admin scripts
        add_action( 'admin_enqueue_scripts', array( $this, 'pk_admin_scripts' ) );

        // Add permalink in settings
        add_action( 'admin_init', array( $this, 'pk_add_permalink_in_settings' ) );
		add_action( 'admin_init', array( $this, 'pk_save_permalink_in_settings' ) );

        // Add column
        add_filter( 'manage_edit-portfolio-kit_columns', array( $this, 'pk_filter_admin_manage_edit_columns' ), 10, 1 );
		add_action( 'manage_portfolio-kit_posts_custom_column', array( $this, 'pk_admin_manage_custom_column'), 10, 2 );
    
        // Add meta boxes
        add_action( 'add_meta_boxes', array( $this, 'pk_add_post_meta' ) );

        // Save metadata
        add_action( 'save_post', array( $this, 'pk_update_post_meta' ) );

        // Save general settings
        add_action( 'admin_init', array( $this, 'pk_save_general_fields' ) );

        // Admin page for transfer post type
        add_action( 'admin_menu', array( $this, 'pk_post_transfer_menu_page' ) );

        // Ajax transfer post type
        add_action( 'wp_ajax_pk_post_transfer_action', array( $this, 'pk_post_transfer_func' ) );
        add_action( 'wp_ajax_nopriv_pk_post_transfer_action', array( $this, 'pk_post_transfer_func' ) );
    }

    public function pk_admin_scripts( $hook ) {
        global $post;
        wp_enqueue_style( 'pk-admin-main', PK_PLUGIN_URL . '/assets/css/main-admin.css' );
        if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
            if ( 'portfolio-kit' === $post->post_type ) {
                wp_enqueue_style( 'pk-admin', PK_PLUGIN_URL . '/assets/css/admin.css' );
                wp_enqueue_style( 'pk-select2', PK_PLUGIN_URL . '/assets/css/select2.css' );
                if( function_exists( 'wp_enqueue_editor' ) ) {
                    wp_enqueue_editor();
                }
                wp_enqueue_media();
                wp_enqueue_script( 'wp-color-picker' );
                wp_enqueue_style( 'wp-color-picker' );

                wp_enqueue_script( 'pk-select2', PK_PLUGIN_URL . '/assets/js/select2.js', array('jquery'), true );
                wp_enqueue_script( 'pk-admin', PK_PLUGIN_URL . '/assets/js/admin.js', array('jquery', 'wp-editor', 'wp-color-picker', 'pk-select2', 'media-upload'), true );
            }
        }
        if( $hook == 'toplevel_page_pk-settings-page' ){
            wp_enqueue_style( 'pk-admin', PK_PLUGIN_URL . '/assets/css/admin.css' );
            wp_enqueue_script( 'pk-admin', PK_PLUGIN_URL . '/assets/js/admin-global.js', array('jquery'), true );
	        wp_enqueue_script( 'pk-transfer', PK_PLUGIN_URL . '/assets/js/transfer.js', array('jquery'), true );
	        wp_localize_script( 'pk-transfer', 'ajax_pk', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
        }
    }

    public function pk_add_permalink_in_settings() {
		add_settings_field(
			'portfolio_kit_project_slug',
			__( 'Project base', 'portfolio-kit' ),
			array( $this, 'pk_project_slug_input' ),
			'permalink',
			'optional'
		);

		add_settings_field(
			'portfolio_kit_portfolio_slug',
			__( 'Portfolio category base', 'portfolio-kit' ),
			array( $this, 'pk_portfolio_slug_input' ),
			'permalink',
			'optional'
		);

        add_settings_field(
			'portfolio_kit_portfolio_tag_slug',
			__( 'Portfolio tag base', 'portfolio-kit' ),
			array( $this, 'pk_portfolio_slug_tag_input' ),
			'permalink',
			'optional'
		);
	}

	public function pk_project_slug_input() {
		?>
		<input type="text" name="portfolio_kit_project_slug" value="<?php echo $this->pk_slug; ?>">
		<code>/my-project</code>
		<?php
	}

	public function pk_portfolio_slug_input() {
		?>
		<input type="text" name="portfolio_kit_portfolio_slug" value="<?php echo $this->pk_taxonomy_slug; ?>">
		<code>/my-portfolio-cat</code>
		<?php
	}

    public function pk_portfolio_slug_tag_input() {
		?>
		<input type="text" name="portfolio_kit_portfolio_tag_slug" value="<?php echo $this->pk_taxonomy_tag_slug; ?>">
		<code>/my-portfolio-tag</code>
		<?php
	}

    public function pk_save_permalink_in_settings(){
        if ( ! isset( $_POST['portfolio_kit_project_slug'] ) && ! isset( $_POST['portfolio_kit_portfolio_slug'] ) && ! isset( $_POST['portfolio_kit_portfolio_tag_slug'] ) ) {
			return;
		}

		if( isset( $_POST['portfolio_kit_project_slug'] ) ){
			update_option( 'portfolio_kit_project_slug', sanitize_title_with_dashes( $_POST['portfolio_kit_project_slug'] ) );
		}

		if( isset( $_POST['portfolio_kit_portfolio_slug'] ) ){
			update_option( 'portfolio_kit_portfolio_slug', sanitize_title_with_dashes( $_POST['portfolio_kit_portfolio_slug'] ) );
		}

        if( isset( $_POST['portfolio_kit_portfolio_tag_slug'] ) ){
			update_option( 'portfolio_kit_portfolio_tag_slug', sanitize_title_with_dashes( $_POST['portfolio_kit_portfolio_tag_slug'] ) );
		}
    }

    public function pk_filter_admin_manage_edit_columns( $columns ) {
		$new_columns          = array();
		$new_columns['cb']    = $columns['cb']; // checkboxes for all projects page
		$new_columns['image'] = __( 'Cover Image', 'portfolio-kit' );

		return array_merge( $new_columns, $columns );
	}

    public function pk_admin_manage_custom_column( $column_name, $id ) {

		switch ( $column_name ) {
			case 'image':
				if ( get_the_post_thumbnail( intval( $id ) ) ) {
					$value = '<a href="' . get_edit_post_link( $id,
							true ) . '" title="' . esc_attr( __( 'Edit this item', 'portfolio-kit' ) ) . '">' .
					         wp_get_attachment_image( get_post_thumbnail_id( intval( $id ) ),
						         array( 150, 100 ),
						         true ) .
					         '</a>';
				} else {
					$value = '<img src="' . PK_PLUGIN_URL . '/assets/images/no-image.png"/>';
				}
				echo $value;
				break;

			default:
				break;
		}
	}

    public function pk_add_post_meta(){
        add_meta_box( 'pk_summary_meta', esc_html__( 'Project summary', 'portfolio-kit' ), array( $this, 'pk_add_post_summary_meta_callback' ), array('portfolio-kit') );
        add_meta_box( 'pk_gallery_meta', esc_html__( 'Project Gallery', 'portfolio-kit' ), array( $this, 'pk_add_post_gallery_meta_callback' ), array('portfolio-kit') );
        add_meta_box( 'pk_cover_page_behavior', esc_html__( 'Behavior on Portfolio page', 'portfolio-kit' ), array( $this, 'pk_add_post_page_behavior_callback' ), array('portfolio-kit') );
    }

    public function pk_add_post_summary_meta_callback( $post, $meta ){
        wp_nonce_field( plugin_basename(__FILE__), 'pk_noncename' );
        $this->pk_fields_set->output_fields( $this->pk_get_filedset('summary'), $post->ID);
    }

    public function pk_add_post_gallery_meta_callback( $post, $meta ){
        $this->pk_fields_set->output_fields( $this->pk_get_filedset('gallery'), $post->ID);
    }

    public function pk_add_post_page_behavior_callback( $post, $meta ){
        $this->pk_fields_set->output_fields( $this->pk_get_filedset('page_behavior'), $post->ID);
    }

    public function pk_update_post_meta( $post_id ){
        if ( ! isset( $_POST['pk_noncename'] ) )
		    return;

        if ( ! wp_verify_nonce( $_POST['pk_noncename'], plugin_basename(__FILE__) ) )
            return;

        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
            return;
        
        if( ! current_user_can( 'edit_post', $post_id ) )
            return;

        $options = $this->pk_get_filedset();
        
        if( empty($options) )
            return;

        $save_options = $this->pk_save_fields_types($options);

        if( !empty($save_options) && $save_options !== null ){
            foreach( $save_options as $save_option_key => $save_option_val ){
                update_post_meta( $post_id, $save_option_key, $save_option_val );
            }
        }
    }

    public function pk_save_general_fields(){
        if ( ! isset( $_POST['pk_general_noncename'] ) )
		    return;

        if ( ! wp_verify_nonce( $_POST['pk_general_noncename'], plugin_basename(__FILE__) ) )
            return;

        $options = $this->pk_get_filedset('general');

        if( empty($options) )
            return;
        
        $save_options = $this->pk_save_fields_types($options);
        if( !empty($save_options) && $save_options !== null ){
            foreach( $save_options as $save_option_key => $save_option_val ){
                update_option( $save_option_key, $save_option_val );
            }
        }

		add_action( 'admin_notices', array( $this, 'pk_save_notice' ) );
    }

    public function pk_save_notice() {
		?>
        <div class="notice notice-success">
            <p><?php echo esc_html__( 'Settings saved', 'portfolio-kit' ); ?></p>
        </div>
		<?php
	}

    public function pk_save_fields_types($options){
        if( !is_array($options) || empty($options) ){
            return null;
        }

        $save_options = array();

        foreach ( $options as $option ) {
            if ( ! isset( $option['id'] ) || ! isset( $option['type'] ) ) {
                continue;
            }

            $value = null;
            $option_name  = $option['id'];
            $raw_value = isset( $_POST[ $option['id'] ] ) ? $_POST[ $option['id'] ] : null;

            switch ( $option['type'] ) {
                case 'wysiwyg':
                    $value = wp_kses_post( $raw_value );
                    break;
                case 'checkbox':
                    $value = '1' === $raw_value || 'yes' === $raw_value ? 'yes' : 'no';
                    break;
                case 'checkboxes':
                    $value = array_filter( array_map( 'self::pk_clean_s', (array) $raw_value ) );
                    break;
                default:
                    $value = sanitize_text_field( $raw_value );
                    break;
            }

            if ( is_null( $value ) ) {
                continue;
            }

            $save_options[$option_name] = $value;
        }

        return $save_options;
    }

    public static function pk_clean_s( $var ) {
        if ( is_array( $var ) ) {
            return array_map( 'self::pk_clean_s', $var );
        } else {
            return is_scalar( $var ) ?  sanitize_text_field( $var ) : $var;
        }
    }

    public function pk_get_filedset( $metabox = '' ){
        $fields_result = array();
        $fields_summary = array(
            array(
                'type' => 'text',
                'id' => 'portfolio_kit_title',
                'title' => esc_html__( 'Title', 'portfolio-kit' ),
                'desc' => esc_html__( 'Alternative title for project', 'portfolio-kit' ),
            ),
            array(
                'type' => 'wysiwyg',
                'id' => 'portfolio_kit_descr',
                'title' => esc_html__( 'Content text', 'portfolio-kit' ),
            ),
            array(
                'type' => 'image',
                'id' => 'portfolio_kit_logo',
                'title' => esc_html__( 'Logo', 'portfolio-kit' ),
            ),
            array(
                'type' => 'color',
                'id' => 'portfolio_kit_background',
                'title' => esc_html__( 'Background color in post loop', 'portfolio-kit' ),
            ),
            array(
                'type' => 'select',
                'id' => 'portfolio_kit_single_align',
                'title' => esc_html__( 'Thumbnail / Slider align', 'portfolio-kit' ),
                'desc' => esc_html__( 'Align project media on single page', 'portfolio-kit' ),
                'options' => array(
                    'left' => esc_html__( 'Left', 'portfolio-kit' ),
                    'center' => esc_html__( 'Center', 'portfolio-kit' ),
                    'right' => esc_html__( 'Right', 'portfolio-kit' ),
                ),
                'default' => 'left'
            ),
            array(
                'type' => 'number',
                'id' => 'portfolio_kit_single_padding_top',
                'title' => esc_html__( 'Section padding top', 'portfolio-kit' ),
                'desc' => esc_html__( 'Top space in px', 'portfolio-kit' ),
            ),
            array(
                'type' => 'number',
                'id' => 'portfolio_kit_single_padding_bottom',
                'title' => esc_html__( 'Section padding bottom', 'portfolio-kit' ),
                'desc' => esc_html__( 'Bottom space in px', 'portfolio-kit' ),
            ),
            array(
                'type' => 'color',
                'id' => 'portfolio_kit_single_background',
                'title' => esc_html__( 'Background color in single post', 'portfolio-kit' ),
            ),
        );

        $fields_gallery = array(
            array(
                'type' => 'gallery',
                'id' => 'portfolio_kit_gallery',
            )
        );

        $fields_page_behavior = array(
            array(
                'type' => 'radiobutton',
                'id' => 'portfolio_kit_page_behavior',
                'options' => array(
                    'default' => esc_html__( 'Open inner project page', 'portfolio-kit' ),
                    'lightbox' => esc_html__( 'Open featured image in lightbox', 'portfolio-kit' ),
                ),
                'default' => 'default'
            )
        );

        $customizer_single_align = $this->get_customizer_option('thumbnail-align', 'left');
        $customizer_single_likes = $this->get_customizer_option('folio-likes-show', 'yes');
        if( $customizer_single_likes == '1' ){
            $customizer_single_likes = 'yes';
        }
        $customizer_single_date = $this->get_customizer_option('folio-data-show', 'yes');
        if( $customizer_single_date == '1' ){
            $customizer_single_date = 'yes';
        }
        $customizer_single_share = $this->get_customizer_option('folio-share-show', 'yes');
        if( $customizer_single_share == '1' ){
            $customizer_single_share = 'yes';
        }
        $customizer_single_share_bttns = $this->get_customizer_option('folio-social-buttons', 
        array(
            'facebook',
            'twitter',
            'linkedin',
            'pinterest'
        ));

        $customizer_single_inner_nav = $this->get_customizer_option('folio-bottom-nav', 'yes');
        if( $customizer_single_inner_nav == '1' ){
            $customizer_single_inner_nav = 'yes';
        }

        $customizer_single_primary_page = $this->get_customizer_option('folio-bottom-nav-page-select');

        $fields_general_settings = array(
            array(
                'type' => 'smart_select',
                'id' => 'portfolio_kit_single_primary_page',
                'title' => esc_html__( 'Primary portfolio page', 'portfolio-kit' ),
                'desc' => esc_html__( 'Select a page which center icon will be linked to', 'portfolio-kit' ),
                'select_set' => 'pages',
                'default' => $customizer_single_primary_page,
            ),
        );

        if( $metabox == 'summary' ){
            $fields_result = $fields_summary;
        }elseif( $metabox == 'page_behavior' ){
            $fields_result = $fields_page_behavior;
        }elseif( $metabox == 'general' ){
            $fields_result = $fields_general_settings;
        }elseif( $metabox == 'gallery' ){
            $fields_result = $fields_gallery;
        }else{
            $fields_result = array_merge($fields_summary, $fields_page_behavior, $fields_gallery);
        }

        return $fields_result;
    }

    public function pk_post_transfer_menu_page(){
        add_menu_page( __( 'The Kit Portfolio', 'portfolio-kit' ), __( 'The Kit Portfolio', 'portfolio-kit' ), 'manage_options', 'pk-settings-page', array( $this, 'pk_post_settings_menu_page_content' ), 'dashicons-layout' );
    }

    public function pk_post_settings_menu_page_content(){
        $post_link = '';
        $query = new WP_Query( array(
            'post_type' => 'portfolio-kit',
            'posts_per_page' => 1
        ) );
        $portfolio_posts = $query->get_posts();
        if( !empty($portfolio_posts) ){
            foreach($portfolio_posts as $portfolio_post){
                $post_link = get_post_permalink($portfolio_post->ID);
            }
        }
        $customizer_link = admin_url( '/customize.php?autofocus[section]=pk_settings_single&url=' . $post_link )

        ?>
        <div class="wrap wrap-pk-general">
            <h1><?php echo esc_html__( 'General settings', 'portfolio-kit' ); ?></h1>
            <div class="pk-general-settings-cont">
                <a href="<?php echo esc_url( $customizer_link ); ?>" class="button button-primary"><?php echo esc_html__( 'Design settings', 'portfolio-kit' ); ?></a>
            </div>
            <div class="pk-general-settings-cont">
                <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
				    <?php
				    wp_nonce_field( plugin_basename( __FILE__ ), 'pk_general_noncename' );
				    $this->pk_fields_set->output_fields( $this->pk_get_filedset( 'general' ), 0 );
				    submit_button( esc_html__( 'Save settings', 'portfolio-kit' ) );
				    ?>
                </form>
            </div>

            <h1><?php echo esc_html__( 'Portfolio transfer', 'portfolio-kit' ); ?></h1>
            <div class="pk-general-settings-cont">
                <div class="pk-meta-option">
                    <button class="button button-primary pk-transfer-post-type" data-action="transfer"><?php echo esc_html__( 'Transfer from Unyson extension', 'portfolio-kit' ); ?><span class="dashicons dashicons-update"></span></button>
                    <button class="button button-secondary pk-transfer-post-type" data-action="transfer_backward"><?php echo esc_html__( 'Undo the transfer action', 'portfolio-kit' ); ?><span class="dashicons dashicons-update"></span></button>
                </div>
                <div class="pk-meta-option">
                    <?php echo wp_sprintf( __( '%s', 'portfolio-kit' ), '<a href="https://crumina.net/tutorials/transfer-seosight-portfolio-items-into-portfolio-kit-plugin/"> <strong>Read Tutorial on how to transfer portfolio items</strong></a> ' ); ?>
                </div>
                <div class="pk-meta-option">
                    <button class="button button-secondary pk-transfer-post-type" data-action="scratch"><?php echo esc_html__( 'Start from scratch', 'portfolio-kit' ); ?></button>
                </div>
            </div>
        </div>
        <?php
    }

    public function pk_post_transfer_func(){
        $act = filter_input( INPUT_POST, 'act', FILTER_SANITIZE_STRING );

        if( $act == 'transfer' || $act == 'transfer_backward' ){

            // Posts
            $old_post_type = 'fw-portfolio';
            $new_post_type = 'portfolio-kit';

            if( $act == 'transfer_backward' ){
                $old_post_type = 'portfolio-kit';
                $new_post_type = 'fw-portfolio';
                $active_extensions = get_option( 'fw_active_extensions' );
            } else {
                $active_extensions = get_option( 'fw_active_extensions' );
                if ( isset( $active_extensions[ 'portfolio' ] ) ) {
                    unset( $active_extensions[ 'portfolio' ] );
                    update_option( 'fw_active_extensions', $active_extensions );
                }
            }

            update_option('pk_main_post_type', $new_post_type);

            $query = new WP_Query( array(
                'post_type' => $old_post_type,
                'posts_per_page' => -1
            ) );

            $portfolio_posts = $query->get_posts();
            if( !empty($portfolio_posts) ){
                foreach($portfolio_posts as $portfolio_post){
                    $post = (array) $portfolio_post;
                    $post['post_type'] = $new_post_type;
                    wp_update_post( $post );

                    // Post fields
                    $post_fields = maybe_unserialize( get_post_meta($post['ID'], 'seosight_fw_portfolio', true) );
                    $post_fw_options = maybe_unserialize( get_post_meta($post['ID'], 'fw_options', true) );

                    if( isset($post_fw_options['project-gallery']) && !empty($post_fw_options['project-gallery']) ) {
                        $gallery_images = '';
                        foreach( $post_fw_options['project-gallery'] as $img ) {
                            $gallery_images .= $img['attachment_id'] . ',';
                        }
                        $gallery_images = substr($gallery_images, 0, -1);
                        update_post_meta($post['ID'], 'portfolio_kit_gallery', $gallery_images);
                    }

                    if( isset($post_fw_options['project-title']) && !empty($post_fw_options['project-title']) ) {
                        update_post_meta($post['ID'], 'portfolio_kit_title', $post_fw_options['project-title']);
                    }
                    if( isset($post_fw_options['project-desc']) && !empty($post_fw_options['project-desc']) ) {
                        update_post_meta($post['ID'], 'portfolio_kit_descr', $post_fw_options['project-desc']);
                    }
                    if( isset($post_fw_options['thumbnail-align']) && !empty($post_fw_options['thumbnail-align']) ) {
                        $th_align = $post_fw_options['thumbnail-align'];
                        if( $th_align == 'default' ) {
                            $th_align = $this->get_customizer_option('thumbnail-align', 'left');
                        }
                        update_post_meta($post['ID'], 'portfolio_kit_single_align', $th_align);
                    }

                    // Lightbox
                    $portfolio_page_open = maybe_unserialize( get_post_meta($post['ID'], 'seosight_fw_portfolio_page_open', true) );
                    if( isset($portfolio_page_open['open-item']) ){
                        update_post_meta($post['ID'], 'portfolio_kit_page_behavior', sanitize_text_field($portfolio_page_open['open-item']));
                    } elseif( isset($fw_options['open-item']) ){
                        update_post_meta($post['ID'], 'portfolio_kit_page_behavior', sanitize_text_field($fw_options['open-item']));
                    }
                }
            }

            // Taxonomy
            $old_tax = 'fw-portfolio-category';
            $new_tax = 'portfolio-kit-cat';

            if( $act == 'transfer_backward' ){
                $old_tax = 'portfolio-kit-cat';
                $new_tax = 'fw-portfolio-category';
            }

            global $wpdb;
            $all_tax = $wpdb->get_results( "SELECT term_taxonomy_id FROM $wpdb->term_taxonomy WHERE taxonomy = '".$old_tax."'" );
        
            if( !empty($all_tax) ) {
                foreach($all_tax as $tax){
                    $update = $wpdb->update(
                        $wpdb->prefix . 'term_taxonomy',
                        [ 'taxonomy' => $new_tax ],
                        [ 'term_taxonomy_id' => $tax->term_taxonomy_id ],
                        [ '%s' ],
                        [ '%d' ]
                    );
                }
            }

            // Permalinks
            if( $act == 'transfer' ){
                $fw_extensions = maybe_unserialize( get_option('fw_extensions') );
                if( isset($fw_extensions['portfolio']['permalinks']) ){
                    $permalinks_options = $fw_extensions['portfolio']['permalinks'];
                    if( isset($permalinks_options['post']) ){
                        $save_opt_val = get_option('portfolio_kit_project_slug');
                        update_option('portfolio_kit_project_slug', sanitize_text_field($permalinks_options['post']));
                    }
                    if( isset($permalinks_options['taxonomy']) ){
                        $save_opt_val_tax = get_option('portfolio_kit_portfolio_slug');
                        update_option('portfolio_kit_portfolio_slug', sanitize_text_field($permalinks_options['taxonomy']));
                    }

                    $permalinks_options['post'] = $save_opt_val;
                    $permalinks_options['taxonomy'] = $save_opt_val_tax;

                    $fw_extensions['portfolio']['permalinks'] = $permalinks_options;
                }
                update_option('fw_extensions', $fw_extensions);
            } elseif( $act == 'transfer_backward' ){
                $opt_val = get_option('portfolio_kit_project_slug');
                $opt_val_tax = get_option('portfolio_kit_portfolio_slug');
                $fw_extensions = maybe_unserialize( get_option('fw_extensions') );
                if( isset($fw_extensions['portfolio']['permalinks']) ){
                    $permalinks_options = $fw_extensions['portfolio']['permalinks'];
                    if( isset($permalinks_options['post']) ){
                        $save_opt_val = $permalinks_options['post'];
                    }
                    if( isset($permalinks_options['taxonomy']) ){
                        $save_opt_val_tax = $permalinks_options['taxonomy'];
                    }

                    if( $opt_val != '' ){
                        $permalinks_options['post'] = sanitize_text_field($opt_val);
                    }
                    if( $opt_val_tax != '' ){
                        $permalinks_options['taxonomy'] = sanitize_text_field($opt_val_tax);
                    }
                    $fw_extensions['portfolio']['permalinks'] = $permalinks_options;
                    update_option('fw_extensions', $fw_extensions);

                    update_option('portfolio_kit_project_slug', sanitize_text_field($save_opt_val));
                    update_option('portfolio_kit_portfolio_slug', sanitize_text_field($save_opt_val_tax));
                }
            }

            flush_rewrite_rules();
            update_option( 'rewrite_rules', '' );

            wp_send_json_success(array('url' => admin_url( 'edit.php?post_type=portfolio-kit' )));
        } elseif( $act == 'scratch' ) {
            // Delete this option page
            //---
            update_option('pk_main_post_type', 'portfolio-kit');
            flush_rewrite_rules();
            update_option( 'rewrite_rules', '' );
            
            wp_send_json_success(array('url' => admin_url( 'edit.php?post_type=portfolio-kit' )));
        }
    }
}

return new PortfolioKitAdmin();