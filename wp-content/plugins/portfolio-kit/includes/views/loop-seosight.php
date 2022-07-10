<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$theKitClass = new PortfolioKit();

$permalink = get_the_permalink();
$open_image = $theKitClass->get_option(get_post()->ID, 'portfolio_kit_page_behavior');
$img_class = '';
if( $open_image == 'lightbox' ){
    $permalink = get_the_post_thumbnail_url( get_post()->ID, 'full' );
    $img_class = 'pk-popup-image';
}
$bg_color = ( $theKitClass->get_option(get_post()->ID, 'portfolio_kit_background') != '') ? 'background-color: ' . $theKitClass->get_option(get_post()->ID, 'portfolio_kit_background') . ';' : '';
?>
<div class="pk-post-seosight" style="<?php echo esc_attr($bg_color); ?>">
    <div class="pk-post-thumbnail">
        <a href="<?php echo esc_url( $permalink ) ?>" class="<?php echo esc_attr($img_class); ?>">
            <?php echo get_the_post_thumbnail( get_post()->ID, 'medium_large' ); ?>
        </a>
    </div>
    <a href="<?php echo esc_url( $permalink ) ?>" class="pk-post-title <?php echo esc_attr($img_class); ?>"><?php the_title(); ?></a>
	<?php the_terms( get_post()->ID, 'portfolio-kit-cat', '<div class="pk-post-cat">', ', ', '</div>' ); ?>
</div>