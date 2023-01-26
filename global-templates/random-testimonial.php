<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$post_type = 'testimonio';

$args = array(
	'post_type'			=> $post_type,
	'posts_per_page'	=> 1,
	'orderby'			=> 'rand',
);

$q = new WP_Query($args);

if ( $q->have_posts() ) { ?>

	<div class="wrapper random-testimonial alignwide">

		<?php while ( $q->have_posts() ) { $q->the_post(); ?>

			<?php get_template_part( 'loop-templates/content', $post_type ); ?>

		<?php } ?>

	</div>

<?php }

wp_reset_postdata();