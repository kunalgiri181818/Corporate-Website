<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Seosight
 */
if ( ! is_page_template( 'landing-template.php' ) ) {
	$copyright_class = $totop_icon_size = $totop_bg_color = $footer_contacts_show = $footer_contacts = $description_enable = $description_title = $description_text = $description_columns = $description_class = $description_socials = $footer_fixed = $footer_text = $custom_icon = $to_top_icon_style = '';

	global $allowedtags;
	global $allowedposttags;
	$my_theme = wp_get_theme();

	$show_search      = seosight_get_option_value( 'search-icon/value', true, array('bool_val' => 'yes') );
	$search_style     = seosight_get_option_value( 'search-icon/style', 'fullscreen', array('name' => 'search-icon/yes/style') );
	$footer_copyright = '<span>Copyright &copy; ' . date( 'Y' ) . ' <a href="' . esc_html( $my_theme->get( 'AuthorURI' ) ) . '">SEO WP Theme</a></span>';

	$footer_fixed = seosight_get_option_value( 'footer_fixed', false );
	$footer_text  = seosight_get_option_value( 'footer_text_color', '' );
	$footer_title = seosight_get_option_value( 'footer_title_color', '' );

	$description_enable = seosight_get_option_value( 'site-description/value', false, array('bool_val' => 'yes') );
	$description_title = seosight_get_option_value( 'site-description/description/title', '', array('name' => 'site-description/yes/description/title') );
	$description_text = seosight_get_option_value( 'site-description/description/desc', '', array('name' => 'site-description/yes/description/desc') );
	$description_columns = seosight_get_option_value( 'site-description/width-columns', 7, array('name' => 'site-description/yes/width-columns') );
	$description_class = seosight_get_option_value( 'site-description/class', '', array('name' => 'site-description/yes/class') );
	$description_socials = seosight_get_option_value( 'site-description/social-networks', array(), array('name' => 'site-description/yes/social-networks') );

	$footer_contacts_show = seosight_get_option_value( 'footer_contacts_show', false, array('bool_val' => 'yes') );
	$footer_contacts = seosight_get_option_value( 'footer_contacts', array() );
	$footer_copyright = seosight_get_option_value( 'footer_copyright', 'Site is built on WordPress <a href="https://wordpress.org">WordPress</a>' );
	$copyright_class = seosight_get_option_value( 'size_copyright_section', 'large' );

	$copyright_text = seosight_get_option_value( 'copyright_text_color', '' );

	$show_to_top     = seosight_get_option_value( 'scroll_top_icon/value', true, array('bool_val' => 'yes') );
	$fixed_totop     = seosight_get_option_value( 'scroll_top_icon/fixed', false, array('name' => 'scroll_top_icon/yes/fixed') );
	$custom_icon     = seosight_get_option_value( 'scroll_top_icon/custom_icon', '', array('name' => 'scroll_top_icon/yes/custom_icon/url') );
	$totop_icon_size = seosight_get_option_value( 'scroll_top_icon/icon_size', 40, array('name' => 'scroll_top_icon/yes/icon_size') );
	$totop_bg_color  = seosight_get_option_value( 'scroll_top_icon/bg_color', '', array('name' => 'scroll_top_icon/yes/bg_color') );

	$footer_class = $footer_fixed ? 'js-fixed-footer footer-parallax' : '';
	if ( ! empty( $footer_text ) || ! empty( $footer_title ) ) {
		$footer_class .= ' font-color-custom';
	}
	if ( ! empty( $copyright_text ) ) {
		$copyright_class .= ' font-color-custom';
	}

	// Back to top customization.
	$scroll_button_class = $fixed_totop ? 'back-to-top-fixed' : '';
	if ( $totop_bg_color ) {
		$scroll_button_class .= ' with-bg ';
		$to_top_icon_style .= 'background:' . $totop_bg_color.'; ';
		$totop_icon_size =  intval( $totop_icon_size + 20 );
	}
	$to_top_icon_style .= 'width:' . $totop_icon_size . 'px; ';
	$to_top_icon_style .= 'height:' . $totop_icon_size . 'px; ';


	$desc_columns_class = 'col-lg-' . $description_columns . ' col-md-' . $description_columns . ' col-sm-12 col-xs-12';

	if ( $description_enable ) {
		$column = intval( 11 - $description_columns );
		$offset = '1';
		if ( $column < 2 ) {
			$column = 12;
			$offset = '0';
		}
		$sidebar_columns = 'col-lg-offset-' . $offset . ' col-md-offset-' . $offset . ' col-lg-' . $column . ' col-md-' . $column . ' col-sm-12 col-xs-12';
	} else {
		$sidebar_columns = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 row info';
	}
	?>
	
	<?php get_template_part( 'template-parts/subscribe', 'section' ); ?>

    </div><!-- ! .content-wrapper Close -->
    <!-- Footer -->
    <footer id="site-footer" class="footer <?php echo esc_attr( $footer_class ) ?>">
        <div class="container">
			<?php
			if ( ( $description_enable && ( ! empty( $description_title ) || ! empty( $description_text ) ) ) ||
			     ( $description_enable && ( ! empty( $description_socials ) && is_array( $description_socials ) ) )
			) {
			?>
            <div class="row info" itemscope itemtype="http://schema.org/Organization">
                <div class="<?php echo esc_attr( $desc_columns_class ) ?>">
					<?php if ( ! empty( $description_title ) || ! empty( $description_text ) ) { ?>
                        <div class="crumina-heading widget-heading">
							<?php if ( ! empty( $description_title ) ) { ?>
                                <h4 class="heading-title"
                                    itemprop="name"><?php echo esc_html( $description_title ) ?></h4>
                                <div class="heading-decoration"><span class="first"></span><span class="second"></span>
                                </div>
								<?php
							}
							if ( ! empty( $description_text ) ) {
								?>
                                <div class="heading-text" itemprop="description">
									<?php echo wp_kses( wpautop( $description_text ), $allowedposttags ); ?>
                                </div>
							<?php } ?>
                        </div>
					<?php } ?>
					<?php if ( ! empty( $description_socials ) && is_array( $description_socials ) ) { ?>
                        <div class="socials">
                            <link itemprop="url" href="<?php echo esc_url(home_url()); ?>"/>
							<?php
							foreach ( $description_socials as $social ) {
								echo '<a href="' . esc_attr( $social['link'] ) . '" class="social__item" target="_blank" itemprop="sameAs" rel="nofollow">';
								echo '<img loading="lazy" src="' . get_template_directory_uri() . '/svg/socials/' . esc_attr( $social['icon'] ) . '" width="24" height="24"  alt="' . esc_attr( ucfirst( trim( $social['icon'], '.svg' ) ) ) . '">';
								echo '</a>';
							}
							?>
                        </div>
					<?php } ?>
                </div>

				<?php } ?>
				<?php if ( is_active_sidebar( 'sidebar-footer' ) ) { ?>
                    <div class="<?php echo esc_attr( $sidebar_columns ); ?>">
                        <div class="row">
							<?php
							ob_start();
							dynamic_sidebar( 'sidebar-footer' );
							$output                 = ob_get_clean();
							$footer_sibebar_columns = seosight_get_widget_columns( 'sidebar-footer' );
							$footer_sibebar_columns = 'col-lg-' . $footer_sibebar_columns . ' col-md-' . $footer_sibebar_columns . ' col-sm-12 col-xs-12';
							echo str_replace( 'columns_class_replace', $footer_sibebar_columns, $output );
							?>
                        </div>
                    </div>
				<?php } ?>
				<?php
				if ( ( $description_enable && ( ! empty( $description_title ) || ! empty( $description_text ) ) ) ||
				     ( $description_enable && ( ! empty( $description_socials ) && is_array( $description_socials ) ) )
				) {
				?>
            </div>
		<?php } ?>
			<?php if ( $footer_contacts_show ) {
				if ( ! empty( $footer_contacts ) && is_array( $footer_contacts ) ) {
					?>
                    <div class="row" itemscope itemtype="http://schema.org/Organization">
                        <div class="contacts">
							<?php
							$grid_class = 'col-lg-' . intval( 12 / count( $footer_contacts ) );
							$grid_class = count( $footer_contacts ) > 1 ? $grid_class . ' col-md-6' : $grid_class . ' col-md-12';

							foreach ( $footer_contacts as $contacts_item ) {
								if ( isset( $contacts_item['color'] ) && ! empty( $contacts_item['color'] ) ) {
									$icon_attr = array(
										'class' => 'icon',
										'style' => 'color:' . esc_attr( $contacts_item['color'] ),
									);
								} else {
									$icon_attr = array(
										'class' => 'icon c-secondary'
									);
								} ?>
                                <div class="<?php echo esc_attr( $grid_class ) ?> col-sm-12 col-xs-12">
                                    <div class="contacts-item">
                                        <div <?php echo seosight_attr_to_html( $icon_attr ) ?>>
											<?php
											if ( isset( $contacts_item['icon'] ) ) {
												get_template_part( 'svg/' . $contacts_item['icon'] . '.svg' );
											}
											?>
                                        </div>
                                        <div class="content">
											<?php
											if ( ! empty( $contacts_item['title'] ) ) {
												if ( is_email( $contacts_item['title'] ) ) {
													echo '<a href="mailto:' . esc_html( $contacts_item['title'] ) . '" class="title" itemprop="email">' . esc_html( $contacts_item['title'] ) . '</a>';
												} elseif ( false !== strpos( $contacts_item['icon'], 'phone' ) ) {
													echo '<a href="tel:' . esc_html( $contacts_item['title'] ) . '" class="title" itemprop="telephone">' . esc_html( $contacts_item['title'] ) . '</a>';
												} else {
													$microdata = 'address';
													echo '<span class="title" itemprop="' . esc_attr( $microdata ) . '">' . wp_kses( $contacts_item['title'], $allowedtags ) . '</span>';
												}
											}
											if ( ! empty( $contacts_item['subtitle'] ) ) {
												echo '<p class="sub-title">' . wp_kses( $contacts_item['subtitle'], $allowedtags ) . '</p>';
											}
											?>
                                        </div>
                                    </div>
                                </div>
							<?php } ?>
                        </div>
                    </div>
				<?php }
			}
			?>
        </div>
		<?php if ( ! empty( $footer_copyright ) ) { ?>
            <div class="sub-footer <?php echo esc_attr( $copyright_class ) ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <span class="site-copyright-text">
                                <?php echo wp_kses( $footer_copyright, $allowedtags ) ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
		<?php } ?>

		<?php if ( $show_to_top ) {

			$scroll_image_class = 'back-to-top ' . $scroll_button_class . ''; ?>
            <div <?php echo seosight_attr_to_html(
				array(
					'class' => $scroll_image_class,
					'style' => $to_top_icon_style,
				)
			); ?> >
				<?php if ( $custom_icon != '' ) { ?>
                    <img loading="lazy" src="<?php echo esc_url( $custom_icon ) ?>"
                         alt="<?php esc_attr_e( 'Back to top', 'seosight' ) ?>">
				<?php } else { ?>
                    <svg>
                        <use xlink:href="#to-top"></use>
                    </svg>
				<?php } ?>
            </div>
		<?php } ?>

    </footer>

    <!-- End Footer -->
    <svg class="hide">
        <symbol id="arrow-left" viewBox="122.9 388.2 184.3 85">
            <path d="M124.1,431.3c0.1,2,1,3.8,2.4,5.2c0,0,0.1,0.1,0.1,0.1l34.1,34.1c1.6,1.6,3.7,2.5,5.9,2.5s4.3-0.9,5.9-2.4
              c1.6-1.6,2.4-3.7,2.4-5.9s-0.9-3.9-2.4-5.5l-19.9-19.5h11.1c1.5,0,2.7-1.5,2.7-3c0-1.5-1.2-3-2.7-3h-17.6c-1.1,0-2.1,0.6-2.5,1.6
              c-0.4,1-0.2,2.1,0.6,2.9l24.4,24.4c0.6,0.6,0.9,1.3,0.9,2.1s-0.3,1.6-0.9,2.1c-0.6,0.6-1.3,0.9-2.1,0.9s-1.6-0.3-2.1-0.9
              l-34.2-34.2c0,0,0,0,0,0c-0.6-0.6-0.8-1.4-0.9-1.9c0,0,0,0,0,0c0-0.2,0-0.4,0-0.6c0.1-0.6,0.3-1.1,0.7-1.6c0-0.1,0.1-0.1,0.2-0.2
              l34.1-34.1c0.6-0.6,1.3-0.9,2.1-0.9s1.6,0.3,2.1,0.9c0.6,0.6,0.9,1.3,0.9,2.1s-0.3,1.6-0.9,2.1l-24.4,24.4c-0.8,0.8-1,2-0.6,3
              c0.4,1,1.4,1.7,2.5,1.7h125.7c1.5,0,2.7-1,2.7-2.5c0-1.5-1.2-2.5-2.7-2.5H152.6l19.9-20.1c1.6-1.6,2.4-3.8,2.4-6s-0.9-4.4-2.4-6
              c-1.6-1.6-3.7-2.5-5.9-2.5s-4.3,0.9-5.9,2.4l-34.1,34.1c-0.2,0.2-0.3,0.3-0.5,0.5c-1.1,1.2-1.8,2.8-2,4.4
              C124.1,430.2,124.1,430.8,124.1,431.3C124.1,431.3,124.1,431.3,124.1,431.3z"></path>
            <path d="M283.3,427.9h14.2c1.7,0,3,1.3,3,3c0,1.7-1.4,3-3,3H175.1c-1.5,0-2.7,1.5-2.7,3c0,1.5,1.2,3,2.7,3h122.4
              c4.6,0,8.4-3.9,8.4-8.5c0-4.6-3.8-8.5-8.4-8.5h-14.2c-1.5,0-2.7,1-2.7,2.5C280.7,426.9,281.8,427.9,283.3,427.9z"></path>
        </symbol>
        <symbol id="arrow-right" viewBox="122.9 388.2 184.3 85">
            <path d="M305.9,430.2c-0.1-2-1-3.8-2.4-5.2c0,0-0.1-0.1-0.1-0.1l-34.1-34.1c-1.6-1.6-3.7-2.5-5.9-2.5c-2.2,0-4.3,0.9-5.9,2.4
              c-1.6,1.6-2.4,3.7-2.4,5.9s0.9,4.1,2.4,5.7l19.9,19.6h-11.1c-1.5,0-2.7,1.5-2.7,3c0,1.5,1.2,3,2.7,3h17.6c1.1,0,2.1-0.7,2.5-1.7
              c0.4-1,0.2-2.2-0.6-2.9l-24.4-24.5c-0.6-0.6-0.9-1.3-0.9-2.1s0.3-1.6,0.9-2.1c0.6-0.6,1.3-0.9,2.1-0.9c0.8,0,1.6,0.3,2.1,0.9
              l34.2,34.2c0,0,0,0,0,0c0.6,0.6,0.8,1.4,0.9,1.9c0,0,0,0,0,0c0,0.2,0,0.4,0,0.6c-0.1,0.6-0.3,1.1-0.7,1.6c0,0.1-0.1,0.1-0.2,0.2
              l-34.1,34.1c-0.6,0.6-1.3,0.9-2.1,0.9s-1.6-0.3-2.1-0.9c-0.6-0.6-0.9-1.3-0.9-2.1s0.3-1.6,0.9-2.1l24.4-24.4c0.8-0.8,1-1.9,0.6-2.9
              c-0.4-1-1.4-1.6-2.5-1.6H158.1c-1.5,0-2.7,1-2.7,2.5c0,1.5,1.2,2.5,2.7,2.5h119.3l-19.9,20c-1.6,1.6-2.4,3.7-2.4,6s0.9,4.4,2.4,5.9
              c1.6,1.6,3.7,2.5,5.9,2.5s4.3-0.9,5.9-2.4l34.1-34.1c0.2-0.2,0.3-0.3,0.5-0.5c1.1-1.2,1.8-2.8,2-4.4
              C305.9,431.3,305.9,430.8,305.9,430.2C305.9,430.2,305.9,430.2,305.9,430.2z"></path>
            <path d="M146.7,433.9h-14.2c-1.7,0-3-1.3-3-3c0-1.7,1.4-3,3-3h122.4c1.5,0,2.7-1.5,2.7-3c0-1.5-1.2-3-2.7-3H132.4
              c-4.6,0-8.4,3.9-8.4,8.5c0,4.6,3.8,8.5,8.4,8.5h14.2c1.5,0,2.7-1,2.7-2.5C149.3,434.9,148.1,433.9,146.7,433.9z"></path>
        </symbol>
            <symbol id="to-top" viewBox="0 0 32 32">
                <path d="M17,22 L25.0005601,22 C27.7616745,22 30,19.7558048 30,17 C30,14.9035809 28.7132907,13.1085075 26.8828633,12.3655101
                  L26.8828633,12.3655101 C26.3600217,9.87224935 24.1486546,8 21.5,8 C20.6371017,8 19.8206159,8.19871575 19.0938083,8.55288165
                  C17.8911816,6.43144875 15.6127573,5 13,5 C9.13400656,5 6,8.13400656 6,12 C6,12.1381509 6.00400207,12.275367 6.01189661,12.4115388
                  L6.01189661,12.4115388 C4.23965876,13.1816085 3,14.9491311 3,17 C3,19.7614237 5.23249418,22 7.99943992,22 L16,22 L16,16 L12.75,19.25
                  L12,18.5 L16.5,14 L21,18.5 L20.25,19.25 L17,16 L17,22 L17,22 Z M16,22 L16,27 L17,27 L17,22 L16,22 L16,22 Z"
                      id="cloud-upload"></path>
            </symbol>

    </svg>
	<?php
	if ( $show_search && 'fullscreen' === $search_style ) {
		get_template_part( 'template-parts/search', $search_style );
	}
}
?>
<?php wp_footer(); ?>
</body>
</html>
