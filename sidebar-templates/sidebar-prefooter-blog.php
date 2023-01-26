<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php if ( is_active_sidebar( 'prefooter-blog' ) ) : ?>

	<div id="wrapper-prefooter-blog">

		<div class="<?php echo esc_attr( $container ); ?>" id="prefooter-blog-content" tabindex="-1">

			<?php dynamic_sidebar( 'prefooter-blog' ); ?>

		</div>

	</div><!-- #wrapper-prefooter-blog -->

	<?php
endif;
