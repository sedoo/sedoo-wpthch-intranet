<?php

/**
 * ACF BLOCKS
 * 
 */

add_action('acf/init', 'sedoo_wpthch_intranet_block_types');
function sedoo_wpthch_intranet_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        acf_register_block_type(array(
            'name'              => 'intranet_apiext_block',
            'title'             => __('Applications externes'),
            'description'       => __('Liste des applications externes.'),
            'render_template'   => 'template-parts/blocks/apiext/apiext.php',
            'category'          => 'widgets',
            'icon'              => 'cloud',
            'keywords'          => array( 'application', 'utile', 'intranet' ),
        ));

        acf_register_block_type(array(
            'name'              => 'intranet_filetree_block',
            'title'             => __('Arborescence de fichiers'),
            'description'       => __('Arborescence de fichiers à partir d\'un emplacement donné.'),
            'render_template'   => 'template-parts/blocks/filetree/filetree.php',
            'category'          => 'widgets',
            'icon'              => 'networking',
            'keywords'          => array( 'file', 'intranet' ),
		));

		acf_register_block_type(array(
            'name'              => 'intranet_login_form',
            'title'             => __('Formulaire de connexion'),
            'description'       => __('bloc d\'authentification'),
            'render_template'   => 'template-parts/blocks/login-form/login-form.php',
            'category'          => 'widgets',
            'icon'              => 'unlock',
            'keywords'          => array( 'login', 'intranet' ),
		));

		acf_register_block_type(array(
            'name'              => 'intranet_tile_super_block',
            'title'             => __('Tuile cliquable'),
            'description'       => __('Tuile sous forme de bouton permettant d\intégrer des liens.'),
            'render_template'   => 'template-parts/blocks/tile/super_tile.php',
            'category'          => 'widgets',
            'icon'              => 'grid-view',
			'supports'			=>array(
				'color' => [
					'background' => true,
					'gradients'  => false,
					'text'       => true,
				],
			),
            'keywords'          => array( 'tile', 'lien', 'bouton', 'intranet', 'contact' ),
		));
    }
}



?>