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
$logo = $theKitClass->get_option(get_post()->ID, 'portfolio_kit_logo');

$gallery_images = $theKitClass->get_option(get_post()->ID, 'portfolio_kit_gallery');
$gallery_images_arr = array();
if( $gallery_images != '' ){
	$gallery_images_arr = explode(",", $gallery_images);
}
?>
<div class="pk-post-modern pk-post-modern-button pk-post-classic" style="<?php echo esc_attr($bg_color); ?>">
    <div class="pk-post-image-gallery">
        <a href="<?php echo esc_url( $permalink ) ?>" class="<?php echo esc_attr($img_class); ?>">
            <?php echo get_the_post_thumbnail( get_post()->ID, 'medium_large' ); ?>
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
    <div class="pk-post-modern-content <?php if( $logo != '' ){ echo 'pk-post-modern-content-row'; } ?>">
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
        <?php if( $logo != '' ){ ?>
        <div class="pk-post-modern-content-logo">
            <?php echo wp_get_attachment_image($logo, 'pk-logo'); ?>
        </div>
        <?php } ?>
    </div>
</div>