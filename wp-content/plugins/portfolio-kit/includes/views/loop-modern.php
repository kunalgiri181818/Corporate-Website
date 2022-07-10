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
<div class="pk-post-modern" style="<?php echo esc_attr($bg_color); ?>">
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
        <a href="<?php echo esc_url( $permalink ) ?>" class="pk-post-modern-arrow<?php echo esc_attr($img_class); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="14" viewBox="0 0 22 14">
                <path id="arrow" d="M1127.81,834.193a0.836,0.836,0,0,0-1.11,0,0.66,0.66,0,0,0,0,.993l5.62,5.091h-18.55a0.743,0.743,0,0,0-.78.7,0.75,0.75,0,0,0,.78.713h18.55l-5.62,5.082a0.672,0.672,0,0,0,0,1,0.838,0.838,0,0,0,1.11,0l6.95-6.3a0.646,0.646,0,0,0,0-.993Z" transform="translate(-1113 -834)"/>
            </svg>
        </a>
        <?php } else { ?>
        <p class="pk-post-modern-title"><?php the_title(); ?>
        <?php } ?>
    </div>
</div>