<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php if ( is_active_sidebar( 'prefooter-home' ) ) : ?>

	<div id="wrapper-prefooter-home">

		<div class="<?php echo esc_attr( $container ); ?>" id="prefooter-home-content" tabindex="-1">

			<?php dynamic_sidebar( 'prefooter-home' ); ?>

		</div>

	</div><!-- #wrapper-prefooter -->

	<?php
endif;
