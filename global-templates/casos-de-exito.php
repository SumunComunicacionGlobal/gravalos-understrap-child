<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$post_type = 'casos-exito';

$args = array(
	'post_type'			=> $post_type,
	'posts_per_page'	=> 4,
);

$q = new WP_Query($args);

if ( $q->have_posts() ) { ?>

	<div class="wrapper hfeed casos-de-exito">

		<div class="row">

			<?php while ( $q->have_posts() ) { $q->the_post(); ?>

				<div class="col-md-6">

					<?php get_template_part( 'loop-templates/content', $post_type ); ?>

				</div>

			<?php } ?>

		</div>

	</div>

<?php }

wp_reset_postdata();