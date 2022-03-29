<?php

//////
// THE SERVICES SETTINGS ADMINISTRATION PAGE
if( function_exists('acf_add_options_page') ) {
	// check if multisite instance for capabilities
	if ( is_multisite() ) 
		{ $capability = 'manage_network'; } else { $capability = 'update_core'; }

	// the page
	acf_add_options_page(array(
		'page_title' 	=> 'Paramètres API',
		'menu_title'	=> 'Paramètres des servics REST',
		'menu_slug' 	=> 'sedoo-intranet-services-admin-page',
		'parent_slug'	=> 'sedoo-intranet-admin-main-page',
		'capability'	=> $capability,
		'redirect'		=> false
    ));
    
}
// END THE SERVICES SETTINGS ADMINISTRATION PAGE
//////

if( function_exists('acf_add_options_page') ) {
	
	// acf_add_options_page(array(
	// 	'page_title' 	=> 'Theme General Settings',
	// 	'menu_title'	=> 'Theme Settings',
	// 	'menu_slug' 	=> 'theme-general-settings',
	// 	'capability'	=> 'edit_posts',
	// 	'redirect'		=> false
	// ));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Applications externes',
		'menu_title'	=> 'Applications externes',
		'parent_slug'	=> 'sedoo-intranet-admin-main-page',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Gestion des services',
		'menu_title'	=> 'Gestion des services',
		'parent_slug'	=> 'sedoo-intranet-admin-main-page',
	));
	
}

/**
 * ACF BLOCKS
 * 
 */

add_action('acf/init', 'sedoo_wpthch_intranet_block_types');
function sedoo_wpthch_intranet_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'intranet_apiext_block',
            'title'             => __('Applications externes'),
            'description'       => __('Liste des applications externes.'),
            'render_template'   => 'template-parts/blocks/apiext/apiext.php',
            'category'          => 'widgets',
            'icon'              => 'cloud',
            'keywords'          => array( 'testimonial', 'quote' ),
        ));
    }
}

?>