<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Create id attribute allowing for custom "anchor" value.
$id = 'posts-carousel-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'posts-carousel';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and handle defaults.
$posts_ids = get_field('posts_ids') ?: false;

if ( $posts_ids ) {

	if ( count( $posts_ids ) > 1 ) {

		$args = array(
			'post_type'			=> 'any',
			'post__in'			=> $posts_ids,
			'orderby'			=> 'post__in',
			'order'				=> 'ASC',
		);
	
	} else {

		$args = array(
			'post_type'			=> 'any',
			'post_parent'		=> $posts_ids[0],
			'orderby'			=> 'menu_order',
			'order'				=> 'ASC',
		);
	
	}


} else {

	global $post;

	$args = array(
		'post_type'			=> $post->post_type,
		'post_parent'		=> $post->ID,
		'orderby'			=> 'menu_order',
		'order'				=> 'ASC',
		'post__not_in'		=> array( $post->ID ),
	);

	$children = get_children( array( 'post_parent' => $post->ID ) );

	if ( !$children ) {
		$args['post_parent'] = $post->post_parent;
	}


}

$q = new WP_Query($args);

if ( $q->have_posts() ) { 
	
	$grid = get_field('grid') ?: false;
	$html_label = get_field('html_label') ?: 'h2';

	if ( $grid ) { ?>

		<div class="hfeed">

			<div class="row">

				<?php while ( $q->have_posts() ) { $q->the_post(); ?>

					<?php if ( 'casos-exito' == get_post_type() ) { ?>

						<div class="col-md-6">

					<?php } else { ?>

						<div class="col-md-6 col-lg-4">

					<?php } ?>

						<?php $current_post = $q->current_post + 1;
						if ( 'casos-exito' == get_post_type() ) {
							get_template_part( 'loop-templates/content', '', array( 'html_label' => $html_label ) );
						} else {
							get_template_part( 'loop-templates/content', 'grid-post', array( 'current_post' => $current_post, 'html_label' => $html_label ) );
						} 
						?>

					</div>

				<?php } ?>

			</div>

		</div>

	<?php } else { ?>

		<div class="slick-carousel">

			<?php while ( $q->have_posts() ) { $q->the_post();

				$current_post = $q->current_post + 1;

				get_template_part( 'loop-templates/content', 'carousel-post', array( 'current_post' => $current_post, 'html_label' => $html_label ) );

			} ?>

		</div>

	<?php }

}

wp_reset_postdata();
