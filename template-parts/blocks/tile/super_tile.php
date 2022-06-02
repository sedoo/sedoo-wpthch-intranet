<?php

/**
 * Tile Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'super_tile-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'super-tile';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

if ( ! empty( $block['backgroundColor'] ) ) {
	$className .= ' has-background';
	$className .= ' has-' . $block['backgroundColor'] . '-background-color';
}
if ( ! empty( $block['textColor'] ) ) {
	$className .= ' has-text-color';
	$className .= ' has-' . $block['textColor'] . '-color';
}

// Load values and assign defaults.
$typeDeBlock = get_field('intranet_super_tile_block_type_choice');
$titreBlock = get_field('intranet_super_tile_block_title');
$superTileIcone = get_field('intranet_super_tile_block_icone');
$link = get_field('intranet_super_tile_block_link');
$link_url = $link['url'];
$contact = get_field('intranet_super_tile_block_user');
$userService = get_field('intranet_super_tile_block_user_service');
$phoneNumber = get_field('intranet_super_tile_block_user_phone');
$tag = get_field('intranet_super_tile_block_tag');
if ($typeDeBlock == 'formulaire') {
    $typeFile = get_field('intranet_super_tile_block_type_form');
} else {
    $typeFile=false;
}


?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> flip-card intranet-super-tile-type-<?php echo $typeDeBlock; ?>">

    <?php 
        // load template wich are set in functions -> intranet-display-function.php
        if($typeDeBlock == 'contact'){
            sedoo_wpthch_intranet_tuile_contact($contact, $phoneNumber, $userService);
        }
        if (($typeDeBlock == 'formulaire') || ($typeDeBlock == 'application') ){
            // sedoo_wpthch_intranet_tuile_formulaire($superTileIcone, $titreBlock, $link, $link_url, $typeFile);
            sedoo_wpthch_intranet_tuile($superTileIcone, $titreBlock, $link, $link_url, $typeFile);
        }
        // if{            
        //     sedoo_wpthch_intranet_tuile_application($superTileIcone, $titreBlock, $link, $link_url);
        // }
    ?>

</section>

