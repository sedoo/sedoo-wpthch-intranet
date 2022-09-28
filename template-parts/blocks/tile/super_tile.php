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
if (get_field('intranet_super_tile_block_tutelle')) {
    $tutelle = get_field('intranet_super_tile_block_tutelle');
    $typeDeBlock .= " ".$tutelle;
}
if (get_field('intranet_super_tile_block_title')) {
$titreBlock = get_field('intranet_super_tile_block_title');
}
if (get_field('intranet_super_tile_block_icone')) {
    $superTileIcone = get_field('intranet_super_tile_block_icone');
}
// var_dump(get_field('intranet_super_tile_block_link'));
if (!empty(get_field('intranet_super_tile_block_link'))) {
    $link = get_field('intranet_super_tile_block_link');
    $link_url = $link['url'];
} else {
    $link="";
    $link_url="";
}
// if (get_field('intranet_super_tile_block_user')) {
//     $contact = get_field('intranet_super_tile_block_user');
// }
// if (!empty(get_field('intranet_super_tile_block_user_service'))) {
//     $userService = get_field('intranet_super_tile_block_user_service');
// } else {
//     $userService="";
// }
// if (get_field('intranet_super_tile_block_user_phone')) {
//     $phoneNumber = get_field('intranet_super_tile_block_user_phone');
// }

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> flip-card intranet-super-tile-type-<?php echo $typeDeBlock; ?>">
    <?php 
        // load template wich are set in functions -> intranet-display-function.php
        // if($typeDeBlock == 'contact'){
        //     sedoo_wpthch_intranet_tuile_contact($contact, $phoneNumber, $userService);
        // } else {
            sedoo_wpthch_intranet_tuile($superTileIcone, $titreBlock, $link, $link_url);
        // }
    ?>
</section>

