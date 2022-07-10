<?php

get_header();
$theKitClass = new PortfolioKit();
$pk_settings_loop_template = get_theme_mod('pk_settings_loop_template', 'classic');
$column_class           = get_theme_mod( 'pk_settings_loop_cols', '2' );
?>
<div class="pk-archive-template pk-list-cont">
    <div class="pk-container">
        <div class="pk-posts-loop <?php echo esc_html('pk-loop-' . $pk_settings_loop_template); ?> <?php echo esc_html( 'pk-columns-' . $column_class ); ?>">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="pk-post-cont">
                    <?php 
                    include $theKitClass->get_template_dir('loop-'.$pk_settings_loop_template.'.php');
                    ?>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="main-pagination <?php echo esc_html('pk-pagin-' . $pk_settings_loop_template); ?>">
            <nav class="navigation-pages">	
                <?php 
                    echo paginate_links( array(
                        'mid_size'  => 3,
                        'prev_next' => true,
                        'prev_text' => __('«'),
                        'next_text' => __('»'),
                    ) );
                ?>
            </nav>
        </div>
    </div>
</div>
<?php

get_footer();