<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article class="testimonio" id="post-<?php the_ID(); ?>">

	<div class="row no-gutters">

		<div class="col-sm-5 testimonial-image-column">

			<?php echo get_the_post_thumbnail( $post->ID, 'medium' ); ?>

		</div>

		<div class="col-sm-7 testimonial-content-column">

			<div class="entry-content">

				<?php
				the_content();
				understrap_link_pages();
				?>

			</div><!-- .entry-content -->

			<?php
			the_title(
				'<p class="testimonial-name">', 
				'</p>'
			);
			?>

			<footer class="entry-footer">

				<?php understrap_entry_footer(); ?>

			</footer><!-- .entry-footer -->

		</div>

	</div>

</article><!-- #post-## -->
