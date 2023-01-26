<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $post;
setup_postdata( $post );

$current_post = '';
if ( $args['current_post'] ) {
	$current_post = '<span class="current-post-number">' . str_pad( $args['current_post'], 2, '0', STR_PAD_LEFT ) . '</span>';
}

$html_label = 'h2';
if ( isset( $args['html_label'] ) ) $html_label = $args['html_label'];
?>

<article class="carousel-post" id="post-<?php the_ID(); ?>">

	<div class="wp-block-cover has-background-dim">

		<span aria-hidden="true" class="wp-block-cover__background"></span>

		<?php echo get_the_post_thumbnail( $post->ID, 'medium_large', array( 'class' => 'wp-block-cover__image-background' ) ); ?>

		<div class="wp-block-cover__inner-container container">

			<header class="entry-header">

				<?php if ( 'post' === get_post_type() ) : ?>

					<div class="entry-meta">
						<?php understrap_posted_on(); ?>
					</div><!-- .entry-meta -->

				<?php endif; ?>

				<?php
				echo $current_post;
				the_title(
					sprintf( '<%s class="h4 entry-title"><a class="stretched-link" href="%s" rel="bookmark">', $html_label, esc_url( get_permalink() ) ),
					'</a></'.$html_label.'>'
				);
				?>

			</header><!-- .entry-header -->

			<div class="entry-content">

				<?php
				echo wpautop( $post->post_excerpt );
				understrap_link_pages();
				?>

				<?php understrap_entry_footer(); ?>

			</div><!-- .entry-content -->

		</div>

	</div>

</article><!-- #post-## -->
