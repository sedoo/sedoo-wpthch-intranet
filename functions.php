<?php
add_action( 'wp_enqueue_scripts', 'sedoo_wpthch_intranet_enqueue_styles' );
function sedoo_wpthch_intranet_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array(), filemtime(get_template_directory() . '/style.css'), false );

}

/******************************************************************
 * Activate categories to pages 
 */

function sedoo_wpthch_intranet_categories_to_pages() {
    register_taxonomy_for_object_type( 'category', 'page' );
    }
add_action( 'init', 'sedoo_wpthch_intranet_categories_to_pages' );

require 'inc/intranet-acf-fields.php';
require 'inc/intranet-acf-config.php';

?>