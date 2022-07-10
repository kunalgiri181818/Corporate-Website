<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$theKitClass = new PortfolioKit();

$permalink = get_the_permalink();
$open_image = $theKitClass->get_option(get_post()->ID, 'portfolio_kit_page_behavior');
$img_class = ' pk-thumbnail-image';
if( $open_image == 'lightbox' ){
    $permalink = get_the_post_thumbnail_url( get_post()->ID, 'full' );
    $img_class .= ' pk-popup-image';
}

$cat_list = get_the_term_list( get_post()->ID, 'portfolio-kit-cat', '', ', ' );
$bg_color = ( $theKitClass->get_option(get_post()->ID, 'portfolio_kit_background') != '') ? 'background-color: ' . $theKitClass->get_option(get_post()->ID, 'portfolio_kit_background') . ';' : '';

$gallery_images = $theKitClass->get_option(get_post()->ID, 'portfolio_kit_gallery');
$gallery_images_arr = array();
if( $gallery_images != '' ){
	$gallery_images_arr = explode(",", $gallery_images);
}
?>
<div class="pk-post-modern pk-post-modern-button" style="<?php echo esc_attr($bg_color); ?>">
    <div class="pk-post-image-gallery">
        <a href="<?php echo esc_url( $permalink ) ?>" class="<?php echo esc_attr($img_class); ?>">
            <?php echo get_the_post_thumbnail( get_post()->ID, 'pk-thumbnail-modern' ); ?>
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
    <div class="pk-post-modern-content">
        <?php if($cat_list){ ?>
        <div class="pk-post-modern-cats">
        <?php echo $cat_list; ?>
        </div>
        <?php } ?>
        <?php if( $open_image != 'lightbox' ){ ?>
        <a href="<?php echo esc_url( $permalink ) ?>" class="pk-post-modern-title"><?php the_title(); ?></a>
        <a class="pk-post-datails-bttn" href="<?php echo esc_url( $permalink ) ?>">
            <span><?php echo esc_html__( 'More Details', 'portfolio-kit' ); ?></span>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="14px">
                <path d="M14.809,0.193 C14.510,-0.090 14.011,-0.090 13.700,0.193 C13.401,0.464 13.401,0.916 13.700,1.186 L19.324,6.278 L0.768,6.278 C0.336,6.278 -0.008,6.589 -0.008,6.980 C-0.008,7.372 0.336,7.692 0.768,7.692 L19.324,7.692 L13.700,12.775 C13.401,13.056 13.401,13.508 13.700,13.779 C14.011,14.059 14.510,14.059 14.809,13.779 L21.764,7.482 C22.074,7.211 22.074,6.759 21.764,6.490 L14.809,0.193 Z"/>
            </svg>
        </a>
        <?php } else { ?>
        <p class="pk-post-modern-title"><?php the_title(); ?>
        <?php } ?>
    </div>
</div>