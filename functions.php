<?php
add_action( 'wp_enqueue_scripts', 'sedoo_wpthch_intranet_enqueue_styles' );
function sedoo_wpthch_intranet_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array(), filemtime(get_template_directory() . '/style.css'), false );
}
// Enqueue Javascript files
function sedoo_wpthch_intranet_js_files() {
    wp_enqueue_script( 'sedoo_wpthch_intranet-accordion', get_stylesheet_directory_uri() . '/js/accordion.js', array(), '1.0.0', true );
    wp_enqueue_script( 'sedoo_wpthch_intranet-global', get_stylesheet_directory_uri() . '/js/global.js',  array('jquery'), '', true );
}
add_action( 'wp_enqueue_scripts', 'sedoo_wpthch_intranet_js_files' );
/******************************************************************
 * Activate categories to pages 
 */

function sedoo_wpthch_intranet_categories_to_pages() {
    register_taxonomy_for_object_type( 'category', 'page' );
    }
add_action( 'init', 'sedoo_wpthch_intranet_categories_to_pages' );

/******************************************************************
 * remove "Private: " from title private pages
 *
 */ 

function sedoo_wpthch_intranet_private_prefix() {
    return '<span class="material-icons">lock</span>  %s';
}
add_filter('private_title_format', 'sedoo_wpthch_intranet_private_prefix');

require 'inc/intranet-backoffice-config.php';
require 'inc/intranet-acf-fields.php';
require 'inc/intranet-acf-config.php';
require 'inc/intranet-display-functions.php';
require 'inc/intranet-user-hooks.php';
require 'inc/intranet-patterns.php';

?>