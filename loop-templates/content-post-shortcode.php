<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article class="post type-post" id="post-<?php the_ID(); ?>">

	<?php if ( 'post' === get_post_type() ) : ?>

		<div class=" mb-2">
			<div class="entry-meta d-flex align-items-center flex-wrap">
				<?php understrap_entry_footer(); ?>
				<?php understrap_posted_on(); ?>
				<span class="filler-line"></span>
			</div><!-- .entry-meta -->
		</div>

	<?php endif; ?>

	<div class="post-inner position-relative">

		<div class="row">

			<div class="col-md-6 col-xl-3">

				<?php echo get_the_post_thumbnail( $post->ID, 'medium_large'); ?>

			</div>

			<div class="col-md-6 col-xl-3 position-static d-flex flex-column justify-content-between">

				<header class="entry-header">

					<?php
					the_title(
						sprintf( '<p class="entry-title"><a class="stretched-link" href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
						'</a></h2>'
					);
					?>

				</header><!-- .entry-header -->

				<div class="wp-block-buttons">
					<div class="wp-block-button is-style-arrow-link">
						<a class="wp-block-button__link"><?php echo __('Saber más','smn' ) ; ?></a>
					</div>
				</div>

			</div>

			<div class="col-md-6">

				<div class="entry-content">

					<?php
					if ( $post->post_excerpt ) {
						echo wpautop( $post->post_excerpt );
					} else {
						echo wpautop( wp_trim_words( $post->post_content, 35, null ) );					
					}
					understrap_link_pages();
					?>

				</div><!-- .entry-content -->

			</div>

		</div>

	</div>

</article><!-- #post-## -->
