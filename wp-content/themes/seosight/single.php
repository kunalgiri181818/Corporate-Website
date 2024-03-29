<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Seosight
 */

get_header();
$layout = seosight_sidebar_conf();
$page_wrapper_classes = seosight_geterate_page_classes( get_the_ID(), $layout );

$main_class = 'full' !== $layout['position'] ? 'site-main content-main-sidebar' : 'site-main content-main-full';
$container_width = $page_wrapper_classes['container_width'];
$padding_class   = $page_wrapper_classes['padding_class'];

$format = get_post_format();
?>

	<div id="primary" class="container">
		<div class="row <?php echo esc_attr( $padding_class ) ?>">
			<div class="<?php echo esc_attr( $layout['content-classes'] ) ?>">
				<main id="main" class="<?php echo esc_attr( $main_class ) ?>" >

					<?php if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) : the_post();
                            if ( ( 'quote' === $format ) || ( 'link' === $format ) ) {
                                get_template_part( 'post-format/post', $format );
                            } else {
                                get_template_part( 'post-format/post', 'single' );
                            }
						endwhile;

						get_template_part( 'template-parts/post', 'navigation' );
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					else :
						get_template_part( 'template-parts/content', 'none' );

					endif; ?>

				</main><!-- #main -->
			</div>
			<?php if ( 'full' !== $layout['position'] ) { ?>
				<div class="<?php echo esc_attr( $layout['sidebar-classes'] ) ?>">
					<?php get_sidebar(); ?>
				</div>
			<?php } ?>
		</div><!-- #row -->
	</div><!-- #primary -->

<?php
get_footer();
