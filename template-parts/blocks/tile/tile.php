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
$id = 'tile-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'tile';
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
$title = get_field('intranet_tile_block_title');
$description = get_field('intranet_tile_block_description');
$external_link = get_field('intranet_tile_block_external_link');
$internal_link = get_field('intranet_tile_block_internal_link');
$bgTileColor = get_field('intranet_tile_block_bg_color');
$textTileColor = get_field('intranet_tile_block_text_color');
$tileIcone = get_field('intranet_tile_block_icone');
$textBouton = get_field('intranet_tile_block_anchor_value');

if (get_field('intranet_tile_block_external_link')) {
    $link = $external_link;
} else {
    $link = $internal_link; 
} 

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> intranet-tile">
    <!-- <a href="<?php echo $link ?>"> -->
        <span class="material-icons"><?php echo $tileIcone; ?></span>    

        <h3><?php echo $title; ?>
            <span class="tooltip">
                <span class="material-icons"> info
                    <span class="tooltiptext"><?php echo $description; ?></span>
                </span>
            </span>
        </h3>
    <!-- </a> -->
    <!-- <a href="<?php echo $link ?>" class="tileBtn"> <?php echo $textBouton ?> </a> -->
 

</section>