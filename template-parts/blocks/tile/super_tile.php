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
$fieldArgs = array();
$typeDeBlock = get_field('intranet_super_tile_block_type_choice');
if (get_field('intranet_super_tile_block_tutelle')) {
    $tutelle = get_field('intranet_super_tile_block_tutelle');
    $typeDeBlock .= " ".$tutelle;
}
if (get_field('intranet_super_tile_block_title')) {
    $fieldArgs["titreBlock"] = get_field('intranet_super_tile_block_title');
}
if (get_field('intranet_super_tile_block_icone')) {
    $fieldArgs["superTileIcone"] = get_field('intranet_super_tile_block_icone');
}
if (!empty(get_field('intranet_super_tile_block_link'))) {
    $link = get_field('intranet_super_tile_block_link');
    $fieldArgs["link_url"] = $link['url'];    
}
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> intranet-super-tile-type-<?php echo $typeDeBlock; ?>">
    <?php 
    sedoo_wpthch_intranet_tuile($fieldArgs);
    ?>
</section>

