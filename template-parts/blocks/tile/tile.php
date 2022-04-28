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
$link = get_field('intranet_tile_block_link');
$tileIcone = get_field('intranet_tile_block_icone');

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> intranet-tile">
    <a href="<?php echo $link['url'] ?>" <?php if ($link['target']== "_blank"){echo "target=\"_blank\"";}?>>
        <span class="material-icons"><?php echo $tileIcone; ?></span>    
        <h3><?php echo $link['title']; ?></h3>
    </a>
</section>