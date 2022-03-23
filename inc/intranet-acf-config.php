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

?>