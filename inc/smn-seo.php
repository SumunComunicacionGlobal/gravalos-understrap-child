<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


function smn_get_attachment_alt( $attachment_ID ) {

    // Get ALT
    $thumb_alt = get_post_meta( $attachment_ID, '_wp_attachment_image_alt', true );
    
    // No ALT supplied get attachment info
    if ( empty( $thumb_alt ) )
        $attachment = get_post( $attachment_ID );

    // If is product, return product post title
    if ( empty( $thumb_alt ) ) {
        $parent_post = get_post_parent( $attachment_ID );
        if( $parent_post && 'product' == $parent_post->post_type ) {
            $thumb_alt = $parent_post->post_title;
        }
    }
    
    // Use caption if no ALT supplied
    if ( $attachment && empty( $thumb_alt ) )
        $thumb_alt = $attachment->post_excerpt;
    
    // Use title if no caption supplied either
    if ( $attachment && empty( $thumb_alt ) )
        $thumb_alt = $attachment->post_title;

    // Use current post title if no title supplied either
    if ( empty( $thumb_alt ) ) {
        global $post;
        $thumb_alt = $post->post_title;
    }

    // Return ALT
    return esc_attr( trim( strip_tags( $thumb_alt ) ) );

}

add_filter( 'render_block', 'smn_cover_block_alt', 10, 2 );
function smn_cover_block_alt( $block_content, $block ) {

    if ( $block['blockName'] !== 'core/cover' ) return $block_content;
    // if(current_user_can( 'manage_options' )) echo '<pre>'; print_r($block); echo '</pre>';

    if( !isset($block['attrs']['id']) ) return $block_content;

    $alt = smn_get_attachment_alt ( $block['attrs']['id'] );

    $block_content = str_replace('alt=""', 'alt="'.$alt.'" title="'.$alt.'" ', $block_content);

    return $block_content;

}

add_filter( 'wp_get_attachment_image_attributes', 'wpdocs_filter_gallery_img_atts', 10, 2 );
function wpdocs_filter_gallery_img_atts( $atts, $attachment ) {
    if ( !isset($atts['alt']) || !$atts['alt'] ) {
        $atts['alt'] = smn_get_attachment_alt($attachment->ID);
    }
    if ( !isset($atts['title']) || !$atts['title'] ) {
        $atts['title'] = smn_get_attachment_alt($attachment->ID);
    }
    return $atts;
}

add_action( 'wp_head', 'smn_meta_description' );
function smn_meta_description() {

    $description = '';

    if ( is_singular() ) {
        global $post;
        $description = wp_trim_words( $post->post_content, 200 );
    } elseif ( is_tax() || is_category() || is_tag() || is_author() || is_post_type_archive() ) {
        $description = get_the_archive_description();
    }

    if ( $description ) {
        // $description = strip_tags( $description );
        echo '<meta name="description" content="' . $description . '">';
    }

}