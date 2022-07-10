<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$theKitClass = new PortfolioKit();

$permalink = get_the_permalink();
$open_image = $theKitClass->get_option(get_post()->ID, 'portfolio_kit_page_behavior');
$img_class = 'pk-thumbnail-image';
if( $open_image == 'lightbox' ){
    $permalink = get_the_post_thumbnail_url( get_post()->ID, 'full' );
    $img_class .= ' pk-popup-image';
}

$bg_color = ( $theKitClass->get_option(get_post()->ID, 'portfolio_kit_background') != '') ? 'background-color: ' . $theKitClass->get_option(get_post()->ID, 'portfolio_kit_background') . ';' : '';

$gallery_images = $theKitClass->get_option(get_post()->ID, 'portfolio_kit_gallery');
$gallery_images_arr = array();
if( $gallery_images != '' ){
	$gallery_images_arr = explode(",", $gallery_images);
}
?>

<div class="pk-post-utouch">
    <div class="pk-post-utouch-thumbnail pk-post-image-gallery">
        <a href="<?php echo esc_url( $permalink ) ?>" class="<?php echo esc_attr($img_class); ?>">
            <?php
            if( has_post_thumbnail() ) {
                echo get_the_post_thumbnail( get_post()->ID, 'pk-single-utouch' );
            } else {
                echo '<img src="'.PK_PLUGIN_URL.'/assets/images/noimg-utouch.png" />';
            }
            ?>
        </a>
        <?php
			if ( !empty( $gallery_images_arr ) && $open_image == 'lightbox' ) {
            foreach ( $gallery_images_arr as $thumbnail ){
        ?>
            <a href="<?php echo esc_url(wp_get_attachment_image_url($thumbnail, 'full')); ?>"></a>
        <?php
            }
            }
        ?>
    </div>
    <div class="pk-post-square-colored" style="<?php echo esc_attr($bg_color); ?>"></div>
    <div class="pk-post-utouch-content">
        <h5 class="pk-post-utouch-title"><?php the_title(); ?></h5>
        <a class="pk-post-utouch-link <?php echo esc_attr($img_class); ?>" href="<?php echo esc_url( $permalink ) ?>">
            <span><?php esc_html_e( 'View Case', 'portfolio-kit' ); ?></span>
            <div class="pk-post-btn-next">
                <svg id="pk_right1" viewBox="0 0 512 512">
                    <path d="m22 235l13 0c12 0 22 9 22 21 0 12-10 21-22 21l-13 0c-12 0-22-9-22-21 0-12 10-21 22-21z m113 0l71 0c12 0 21 9 21 21 0 12-9 21-21 21l-71 0c-11 0-21-9-21-21 0-12 10-21 21-21z m171 0l136 0c12 0 21 9 21 21 0 12-9 21-21 21l-136 0c-12 0-21-9-21-21 0-12 9-21 21-21z"></path>
                </svg>
                <svg id="pk_right" viewBox="0 0 512 512">
                    <path d="m505 239c-1-2-2-3-4-3l-92-94c-9-9-23-9-32 0-9 9-9 24 0 33l79 81-79 81c-9 9-9 24 0 33 4 5 10 7 16 7 6 0 11-2 16-7l92-94c2-1 3-2 4-3 5-5 7-11 7-17 0-6-2-13-7-17z"></path>
                </svg>
            </div>
        </a>
    </div>
</div>