<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$html_label = 'p';
if ( isset( $args['html_label'] ) ) $html_label = $args['html_label'];

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<header class="entry-header">

		<?php if ( 'post' === get_post_type() ) : ?>

			<div class="entry-meta">
				<?php understrap_posted_on(); ?>
			</div><!-- .entry-meta -->

		<?php endif; ?>

		<?php
		the_title(
			sprintf( '<%s class="h5 entry-title mb-2"><a class="stretched-link" href="%s" rel="bookmark">', $html_label, esc_url( get_permalink() ) ),
			'</a></'.$html_label.'>'
		);
		?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
		the_excerpt();
		understrap_link_pages();
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer entry-meta">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
