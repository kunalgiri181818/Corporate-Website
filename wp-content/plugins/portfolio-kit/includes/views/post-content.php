<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$gallery_images = $this->get_option(get_the_ID(), 'portfolio_kit_gallery');
$gallery_images_arr = array();
if( $gallery_images != '' ){
	$gallery_images_arr = explode(",", $gallery_images);
}

$single_align_customizer = get_theme_mod('pk_settings_single_align', 'left');
$single_likes = get_theme_mod('pk_settings_single_likes', '1');
$single_date = get_theme_mod('pk_settings_single_date', '1');

// Likes
$like_url_nonce = wp_create_nonce( 'pk-likes-nonce' );
$count_like = get_post_meta( get_the_ID(), "_post_like_count", true );
$count_like = $this->pk_format_count( intval($count_like) );
$already_liked = ( $this->pk_already_liked( get_the_ID() ) ) ? 'liked' : '';

$post_title = get_the_title();
$custom_title = $this->get_option(get_the_ID(), 'portfolio_kit_title');
if( $custom_title != '' ) {
    $post_title = $custom_title;
}
$custom_desc = $this->get_option(get_the_ID(), 'portfolio_kit_descr');
$single_align = $this->get_option(get_the_ID(), 'portfolio_kit_single_align', $single_align_customizer);
?>

<div class="pk-single-cont <?php echo esc_attr($single_align); ?>">
	<div class="pk-single-cont-row pk-container">
		<div class="pk-single-image-cont">
			<?php
			if ( !empty( $gallery_images_arr ) ) {
				?>
				<div class="pk-swiper-container">
					<div class="swiper-wrapper">
						<?php
							foreach ( $gallery_images_arr as $thumbnail ){
						?>
							<div class="swiper-slide">
								<?php echo wp_get_attachment_image( $thumbnail, 'large' ) ?>
							</div>
						<?php } ?>
					</div>
					<div class="pk-swiper-pagination"></div>
				</div>
				<?php
			} elseif ( has_post_thumbnail() ) {
				the_post_thumbnail( 'large' );
			}
			?>
		</div>
		<div class="pk-single-descr-cont">
			<div class="pk-single-meta">
				<?php if( $single_likes || $single_date ){ ?>
				<?php if( $single_date ){ ?>
				<p class="pk-single-meta-time"><?php echo esc_html( get_the_date( 'F d, Y' ) ); ?></p>
				<?php } ?>
				<?php if( $single_likes ){ ?>
				<div class="pk-like-wrap <?php echo esc_attr($already_liked); ?>" data-post="<?php echo esc_attr(get_the_ID()); ?>" data-nonce="<?php echo esc_attr($like_url_nonce); ?>">
					<svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="heart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M462.3 62.7c-54.5-46.4-136-38.7-186.6 13.5L256 96.6l-19.7-20.3C195.5 34.1 113.2 8.7 49.7 62.7c-62.8 53.6-66.1 149.8-9.9 207.8l193.5 199.8c6.2 6.4 14.4 9.7 22.6 9.7 8.2 0 16.4-3.2 22.6-9.7L472 270.5c56.4-58 53.1-154.2-9.7-207.8zm-13.1 185.6L256.4 448.1 62.8 248.3c-38.4-39.6-46.4-115.1 7.7-161.2 54.8-46.8 119.2-12.9 142.8 11.5l42.7 44.1 42.7-44.1c23.2-24 88.2-58 142.8-11.5 54 46 46.1 121.5 7.7 161.2z" class=""></path></svg>
					<span><?php echo esc_html($count_like); ?></span>
				</div>
				<?php } ?>
				<?php } ?>
			</div>
			<div class="pk-single-descr">
				<?php 
				echo '<h2>' . esc_html($post_title) . '</h2>';
				if( $custom_desc != '' ) {
                    echo wp_kses($custom_desc, 'post');
                } else {
                    echo get_the_content();
                }
				?>
			</div>
		</div>
	</div>
</div>
					