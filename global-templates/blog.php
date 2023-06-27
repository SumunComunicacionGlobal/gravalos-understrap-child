<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$post_type = 'post';

$args = array(
	'post_type'			=> $post_type,
	'posts_per_page'	=> 4,
);

$q = new WP_Query($args);

if ( $q->have_posts() ) { ?>

	<div class="wrapper hfeed blog-shortcode">

		<?php while ( $q->have_posts() ) { $q->the_post(); ?>

				<?php get_template_part( 'loop-templates/content', 'post-shortcode' ); ?>

		<?php } ?>

	</div>

<?php }

wp_reset_postdata();

$blog_page_id = get_option( 'page_for_posts' );

if ( $blog_page_id ) { ?>

	<p class="text-right lead"><a class="right-arrow-link" href="<?php echo get_the_permalink( $blog_page_id ); ?>" title="<?php _e( 'Explorar el blog', 'smn' ); ?>"><?php _e( 'Explorar el blog', 'smn' ); ?></a></p>

<?php }