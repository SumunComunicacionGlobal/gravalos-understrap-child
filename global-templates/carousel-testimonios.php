<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$post_type = 'testimonio';

$args = array(
	'post_type'			=> $post_type,
	'posts_per_page'	=> 4,
	'orderby'			=> 'rand',
);

$q = new WP_Query($args);

if ( $q->have_posts() ) { ?>

	<div class="wrapper hfeed testimonios">

		<div class="slick-carousel-testimonios slick-padded slick-left-arrows">

			<?php while ( $q->have_posts() ) { $q->the_post(); ?>

				<?php get_template_part( 'loop-templates/content', $post_type ); ?>

			<?php } ?>

		</div>

	</div>

<?php }

wp_reset_postdata();