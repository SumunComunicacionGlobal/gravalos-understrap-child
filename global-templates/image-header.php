<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$image_id = false;
$title = '';
$description = '';
$supertitulo = '';

if ( isset( $args['title'] ) && $args['title'] ) {
	$title = $args['title'];
}

if ( isset( $args['description'] ) && $args['description'] ) {
	$description = $args['description'];
}

if ( is_singular() ) {
	$image_id = get_post_thumbnail_id( get_the_ID() );
	$title = get_the_title();
	$supertitulo = get_post_meta( get_the_ID(), 'supertitulo', true );
} elseif ( is_archive() ) {
	$image_id = get_term_meta( get_queried_object_id(), 'thumbnail_id', true );
	$title = get_the_archive_title();
	$description = get_the_archive_description();
	$image_id = get_term_meta( get_queried_object_id(), 'supertitulo', true );
}

?>

<header class="wp-block-cover alignfull is-style-header-cover">

	<span aria-hidden="true" class="wp-block-cover__background has-primary-100-background-color has-background-dim-90 has-background-dim"></span>

	<?php if ( $image_id ) {
		
		echo wp_get_attachment_image( $image_id, 'large', false, array('class' => 'wp-block-cover__image-background') );

	 } else { ?>
		
		<img class="wp-block-cover__image-background wp-block-cover__placeholder-image-background" src="<?php echo get_stylesheet_directory_uri(); ?>/img/placeholder-gravalos.svg" alt="<?php _e( 'Icono Grávalos', 'gravalos' ); ?>" />

	 <?php } ?>

	<div class="wp-block-cover__inner-container">

		<?php if ( is_singular( 'post' ) ) { ?>

			<div class="entry-meta text-white">

				<?php understrap_posted_on(); ?>

			</div><!-- .entry-meta -->

		<?php } ?>

		<?php if ( $supertitulo ) { ?>
			<p class="is-style-supertitulo"><?php echo $supertitulo; ?></p>
		<?php } ?>

		<h1 class="entry-title display-1 animate-text" data-splitting><?php echo $title; ?></h1>

		<?php if ( $description) { ?>
			
			<div class="lead"><?php echo $description; ?></div>
		
		<?php } ?>

	</div>

</header>

<?php smn_breadcrumb(); ?>

