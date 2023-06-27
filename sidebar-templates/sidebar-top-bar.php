<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );

if (is_active_sidebar( 'top-bar' )) { ?>
    
    <div id="wrapper-top-bar" class="top-bar bg-secondary text-white">

        <?php if ( 'container' === $container ) : ?>
            <div class="container">
        <?php endif; ?>

            <div class="d-flex justify-content-center justify-content-md-end">
                <?php dynamic_sidebar( 'top-bar' ); ?>
            </div>

        <?php if ( 'container' === $container ) : ?>
            </div>
        <?php endif; ?>

    </div>

<?php } ?>

