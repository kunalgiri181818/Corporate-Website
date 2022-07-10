<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$pk_title = $this->get_option(get_the_ID(), 'portfolio_kit_title');
$pk_desrc = $this->get_option(get_the_ID(), 'portfolio_kit_descr');
$pk_bttn_label = $this->get_option(get_the_ID(), 'portfolio_kit_link_title');
$pk_bttn_background = $this->get_option(get_the_ID(), 'portfolio_kit_link_background');
$pk_bttn_target = $this->get_option(get_the_ID(), 'portfolio_kit_link_target');
$pk_bttn_url_type = $this->get_option(get_the_ID(), 'portfolio_kit_link_source');
$pk_bttn_url = $this->get_option(get_the_ID(), 'portfolio_kit_link_url');
$pk_bttn_source = $this->get_option(get_the_ID(), 'portfolio_kit_link_page');
$pk_bttn_target_v = '';
if($pk_bttn_target == 'yes'){
	$pk_bttn_target_v = 'target="_blank"';
}
if($pk_bttn_url_type == 'page'){
	$pk_bttn_url = get_permalink( $pk_bttn_source );
}

$gallery_images = $this->get_option(get_the_ID(), 'portfolio_kit_gallery');
$gallery_images_arr = array();
if( $gallery_images != '' ){
	$gallery_images_arr = explode(",", $gallery_images);
}

$video_link = $this->get_option(get_the_ID(), 'portfolio_kit_cover_video_source');
$video_link_type = $this->get_option(get_the_ID(), 'portfolio_kit_cover_video');
$video_html = '';
if( $video_link != '' ){
	$video_html = "<video controls src=\"{$video_link}\"></video>";
	if( $video_link_type == 'link' ){
		$video_link = $this->get_option(get_the_ID(), 'portfolio_kit_cover_video_link');
		$matches = array();
		preg_match( '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $video_link, $matches );

		if ( isset( $matches[ 7 ] ) ) {
			$video_html = "<iframe src=\"https://www.youtube.com/embed/{$matches[ 7 ]}\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";
		}

		$matches = array();
		preg_match( '/(http|https)?:\/\/(www\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|)(\d+)(?:|\/\?)/', $video_link, $matches );

		if ( isset( $matches[ 4 ] ) ) {
			$video_html = "<iframe src=\"https://player.vimeo.com/video/{$matches[ 4 ]}?title=0&byline=0&portrait=0\" frameborder=\"0\" allow=\"autoplay; fullscreen\" allowfullscreen></iframe>";
		}
	}
}

$allowed_video_tags = array(
	'video' => array(
		'controls' => array(),
		'src' => array(),
	),
	'iframe' => array(
		'src' => array(),
		'frameborder' => array(),
		'allow' => array(),
		'allowfullscreen' => array(),
	)
);

// Likes
$like_url_nonce = wp_create_nonce( 'pk-likes-nonce' );
$count_like = get_post_meta( get_the_ID(), "_post_like_count", true );
$count_like = $this->pk_format_count( intval($count_like) );
$already_liked = ( $this->pk_already_liked( get_the_ID() ) ) ? 'liked' : '';

// General settings
$customizer_single_align = $this->get_customizer_option('thumbnail-align', 'left');
$customizer_single_likes = $this->get_customizer_option('folio-likes-show', 'yes');
if( $customizer_single_likes == '1' ){
    $customizer_single_likes = 'yes';
}
$customizer_single_date = $this->get_customizer_option('folio-data-show', 'yes');
if( $customizer_single_date == '1' ){
    $customizer_single_date = 'yes';
}
$gen_single_align = $this->get_option(0, 'portfolio_kit_single_align', $customizer_single_align);
$gen_single_likes = $this->get_option(0, 'portfolio_kit_single_likes', $customizer_single_likes);
$gen_single_date = $this->get_option(0, 'portfolio_kit_single_date', $customizer_single_date);
?>

<div class="pk-single-cont <?php echo esc_attr($gen_single_align); ?>">
	<div class="pk-single-cont-row">
		<div class="pk-single-image-cont">
			<?php
			if( $video_link_type != 'none' ) {
				echo wp_kses($video_html, $allowed_video_tags);
			} elseif ( !empty( $gallery_images_arr ) ) {
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
			<?php if( $gen_single_likes == 'yes' || $gen_single_date == 'yes' ){ ?>
			<div class="pk-single-meta">
				<p class="pk-single-meta-time"><?php echo esc_html( get_the_date( 'F d, Y' ) ); ?></p>
				<?php if( $gen_single_likes == 'yes' ){ ?>
				<div class="pk-like-wrap <?php echo esc_attr($already_liked); ?>" data-post="<?php echo esc_attr(get_the_ID()); ?>" data-nonce="<?php echo esc_attr($like_url_nonce); ?>">
					<svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="heart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M462.3 62.7c-54.5-46.4-136-38.7-186.6 13.5L256 96.6l-19.7-20.3C195.5 34.1 113.2 8.7 49.7 62.7c-62.8 53.6-66.1 149.8-9.9 207.8l193.5 199.8c6.2 6.4 14.4 9.7 22.6 9.7 8.2 0 16.4-3.2 22.6-9.7L472 270.5c56.4-58 53.1-154.2-9.7-207.8zm-13.1 185.6L256.4 448.1 62.8 248.3c-38.4-39.6-46.4-115.1 7.7-161.2 54.8-46.8 119.2-12.9 142.8 11.5l42.7 44.1 42.7-44.1c23.2-24 88.2-58 142.8-11.5 54 46 46.1 121.5 7.7 161.2z" class=""></path></svg>
					<span><?php echo esc_html($count_like); ?></span>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
			<div class="pk-single-descr">
				<?php 
				if($pk_title != ''){
					echo '<h2>' . esc_html($pk_title) . '</h2>';
				}
				if($pk_desrc != ''){
					echo wpautop($pk_desrc);
				}	
				?>
			</div>

			<div class="pk-single-button">
			<?php if($pk_bttn_label != ''){ ?>
				<a href="<?php echo esc_url( $pk_bttn_url ) ?>" style="background-color: <?php echo esc_attr( $pk_bttn_background ? $pk_bttn_background : '#2f2c2c'  ); ?>;" <?php echo esc_attr( $pk_bttn_target_v ) ?> class="pk-btn">
					<span class="text"><?php echo esc_html( $pk_bttn_label ); ?></span>
					<span class="pk-semicircle"></span>
				</a>
			<?php } ?>
			</div>
		</div>
	</div>
</div>
					