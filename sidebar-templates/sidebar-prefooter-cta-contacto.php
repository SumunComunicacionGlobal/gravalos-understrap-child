<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );

?>

<?php if ( is_active_sidebar( 'prefooter-cta-contacto' ) ) : ?>

	<div id="wrapper-prefooter-cta-contacto">

		<div class="<?php echo esc_attr( $container ); ?>">
		
			<div id="prefooter-cta-contacto" tabindex="-1">

				<div id="prefooter-cta-contacto-inner">

					<?php dynamic_sidebar( 'prefooter-cta-contacto' ); ?>

				</div>

			</div>

		</div>

	</div><!-- #wrapper-prefooter-cta-contacto -->

	<?php
endif;
