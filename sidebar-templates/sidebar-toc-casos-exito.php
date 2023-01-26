<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php if ( is_active_sidebar( 'toc-casos-exito' ) ) : ?>

	<div class="wrapper" id="wrapper-toc-casos-exito">

		<?php dynamic_sidebar( 'toc-casos-exito' ); ?>

	</div><!-- #wrapper-toc-casos-exito -->

	<?php
endif;
