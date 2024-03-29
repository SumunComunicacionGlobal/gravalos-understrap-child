<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-content">

		<?php get_template_part( 'global-templates/image-header' ); ?>

		<?php if ( 'casos-exito' == get_post_type() ) {
			get_template_part( 'sidebar-templates/sidebar-toc-casos-exito' );
		} ?>

		<?php
		the_content();
		understrap_link_pages();
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer entry-meta mt-3">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
