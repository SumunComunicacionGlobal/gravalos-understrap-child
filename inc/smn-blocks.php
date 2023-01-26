<?php 

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


if ( function_exists( 'register_block_style' ) ) {

    register_block_style(
        'core/cover',
        array(
            'name'         => 'header-cover',
            'label'        => __( 'Cabecera', 'smn-admin' ),
            'is_default'   => false,
        )
    );
    
    register_block_style(
        'core/cover',
        array(
            'name'         => 'cover-lined',
            'label'        => __( 'Con línea a la izquierda', 'smn-admin' ),
            'is_default'   => false,
        )
    );
    
    register_block_style(
        'core/cover',
        array(
            'name'         => 'card',
            'label'        => __( 'Tarjeta', 'smn-admin' ),
            'is_default'   => false,
        )
    );
    
    register_block_style(
        'core/button',
        array(
            'name'         => 'arrow-link',
            'label'        => __( 'Con flecha', 'smn-admin' ),
            'is_default'   => false,
        )
    );

    register_block_style(
        'core/columns',
        array(
            'name'         => 'gapless',
            'label'        => __( 'Sin espacio', 'smn-admin' ),
            'is_default'   => false,
        )
    );

    register_block_style(
        'core/list',
        array(
            'name'         => 'list-unstyled',
            'label'        => __( 'Sin viñetas', 'smn-admin' ),
            'is_default'   => false,
        )
    );
       
    register_block_style(
        'core/image',
        array(
            'name'         => 'bleed-left',
            'label'        => __( 'A sangre izquierda', 'smn-admin' ),
            'is_default'   => false,
        )
    );
       
    $display_text_block_types = array(
        'core/paragraph',
        'core/heading',
        'core/post-title',
    );

    foreach( $display_text_block_types as $block_type ) {

        for ($i=1; $i <= 6; $i++) { 

            register_block_style(
                $block_type,
                array(
                    'name'         => 'h' . $i,
                    'label'        => sprintf( __( 'Imita un h%s', 'smn-admin' ), $i ),
                    'is_default'   => false,
                )
            );

        }
            
        for ($i=1; $i <= 4; $i++) { 

            register_block_style(
                $block_type,
                array(
                    'name'         => 'display-' . $i,
                    'label'        => sprintf( __( 'Display %s', 'smn-admin' ), $i ),
                    'is_default'   => false,
                )
            );

        }

        register_block_style(
            $block_type,
            array(
                'name'         => 'supertitulo',
                'label'        => __( 'Super-título', 'smn-admin' ),
                'is_default'   => false,
            )
        );
        
        register_block_style(
            $block_type,
            array(
                'name'         => 'titulo-rotado',
                'label'        => __( 'Rotado 90º izda', 'smn-admin' ),
                'is_default'   => false,
            )
        );
        
        register_block_style(
            $block_type,
            array(
                'name'         => 'titulo-rotado-derecha',
                'label'        => __( 'Rotado 90º dcha', 'smn-admin' ),
                'is_default'   => false,
            )
        );
        
    }

    $carousel_block_types = array(
        'core/group',
        'core/gallery',
    );

    foreach( $carousel_block_types as $block_type ) {

        register_block_style(
            $block_type,
            array(
                'name'         => 'slick-carousel',
                'label'        => sprintf( __( 'Carrusel', 'smn-admin' ), $i ),
                'is_default'   => false,
            )
        );
    }
            

}

add_filter( 'render_block', 'remove_is_style_prefix', 10, 2 );
function remove_is_style_prefix( $block_content, $block ) {

    if ( isset( $block['attrs']['className'] ) ) {
    
        $components = array(
            'h1',
            'h2',
            'h3',
            'h4',
            'h5',
            'h6',
            'display-1',
            'display-2',
            'display-3',
            'display-4',
            'lead',
            'list-unstyled',
        );

        $prefixed_components = array();
    
        foreach ( $components as $component ) {
            $prefixed_components[] = 'is-style-' . $component;
        }

        $block_content = str_replace(
            $prefixed_components,
            $components,
            $block_content
        );

    }

    
    // echo '<pre class="bg-light mb-5">'; print_r( $block ); echo '</pre><p class="text-center">***</p>';
    // echo '<pre class="bg-light mb-5">'; print_r( $block_content ); echo '</pre><p class="text-center">***</p>';
    
    return $block_content;
}

add_filter( 'render_block', 'list_block_wrapper', 10, 2 );
function list_block_wrapper( $block_content, $block ) {
    if ( $block['blockName'] === 'core/list' ) {
        $block_content = str_replace( 
            array( '<ul>', '<ol>'), 
            array( '<ul class="wp-block-list">', '<ol class="wp-block-list">'), $block_content );
    }

    return $block_content;
}
 
add_filter( 'render_block', 'header_cover_breadcrumb', 10, 2 );
function header_cover_breadcrumb( $block_content, $block ) {
    if ( $block['blockName'] === 'core/cover' && isset( $block['attrs']['className'] ) && str_contains( $block['attrs']['className'], 'is-style-header-cover' ) ) {
        // echo '<pre>'; print_r($block); echo '</pre>';
        ob_start();
        smn_breadcrumb();
        $block_content .= ob_get_clean(); 
    }

    return $block_content;
}
 
add_action('acf/init', 'smn_acf_blocks_init');
function smn_acf_blocks_init() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        acf_register_block_type(array(
            'name'              => 'posts-carousel',
            'title'             => __('Carrusel de páginas o posts', 'smn-admin'),
            // 'description'       => __('Inserta un carrusel', 'smn-admin'),
            'render_template'   => 'block-templates/posts-carousel.php',
            'category'          => 'formatting',
            'mode'              => 'edit',
            'supports'          => array(
                                        'mode'      => false,
                                    ),
        ));
        
        acf_register_block_type(array(
            'name'              => 'breadcrumb',
            'title'             => __('Miga de pan - Breadcrumb GRÁVALOS', 'smn-admin'),
            'render_template'   => 'block-templates/breadcrumb.php',
            'category'          => 'formatting',
            'mode'              => 'preview',
            'supports'          => array(
                                        'mode'      => false,
                                    ),
        ));
        
    }
}

function set_editor_font_sizes()
{
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => __('Small'),
            'size' => 14,
            'slug' => 'small'
        ),
        array(
            'name' => __('Mediano', 'smn'),
            'size' => 24,
            'slug' => 'medium'
        ),
        array(
            'name' => __('Grande', 'smn'),
            'size' => 36,
            'slug' => 'large'
        ),
        array(
            'name' => __('Muy grande', 'smn'),
            'size' => 42,
            'slug' => 'x-large'
        )
    ));
}

/**
 * Hook: after_setup_theme.
 *
 * @uses after_setup_theme https://developer.wordpress.org/reference/hooks/after_setup_theme/
 * @uses add_action() https://developer.wordpress.org/reference/functions/add_action/
 */
add_action('after_setup_theme', 'set_editor_font_sizes');