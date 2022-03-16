<?php

//////
// THE SERVICES SETTINGS ADMINISTRATION PAGE
if( function_exists('acf_add_options_page') ) {
	// check if multisite instance for capabilities
	if ( is_multisite() ) 
		{ $capability = 'manage_network'; } else { $capability = 'update_core'; }

	// the page
	acf_add_options_page(array(
		'page_title' 	=> 'Paramètres de services',
		'menu_title'	=> 'Paramètres de services',
		'menu_slug' 	=> 'sedoo-intranet-services-admin-page',
		'parent_slug'	=> 'sedoo-intranet-admin-main-page',
		'capability'	=> $capability,
		'redirect'		=> false
    ));
    
	acf_add_local_field_group(array(
		'key' => 'group_60548a8e93475',
		'title' => 'Url de services',
		'fields' => array(
			array(
				'key' => 'field_6056902922fe1',
				'label' => '',
				'name' => '',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 0,
				'max' => 0,
				'layout' => 'table',
				'button_label' => '',
				'sub_fields' => array(
					array(
						'key' => 'field_6054923222fe2',
						'label' => 'Type de produit',
						'name' => 'intranet_type_de_produit',
						'type' => 'text',
						'instructions' => 'Ex : calendarbasedproduct, filetree',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_6055a04c22fe3',
						'label' => 'URL du service',
						'name' => 'intranet_url_du_service',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_60b7905222fe4',
						'label' => 'URL du package',
						'name' => 'intranet_url_du_package',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'sedoo-intranet-services-admin-page',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

    
}
// END THE SERVICES SETTINGS ADMINISTRATION PAGE
//////
?>