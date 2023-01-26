<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Create id attribute allowing for custom "anchor" value.
$id = 'breadcrumb-block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'breadcrumb-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

smn_naked_breadcrumb();