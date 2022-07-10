<?php
$theKitClass = new PortfolioKit;

get_header();

locate_template( $theKitClass->get_template_dir( 'post-content.php' ) );

the_content();

get_footer();