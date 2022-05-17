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
$contact = get_field('intranet_super_tile_block_user');
$contactMail = get_field('mail', $contact );
$phoneNumber = get_field('intranet_super_tile_block_user_phone');
$tag = get_field('intranet_super_tile_block_tag');
$typeFile = get_field('intranet_super_tile_block_type_form');

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> flip-card intranet-super-tile-type-<?php echo $typeDeBlock; ?>">

    <?php get_template_part( 'template-parts/blocks/tile/tile', $typeDeBlock ); ?>

</section>



<style type="text/css">

#<?php echo $id; ?> h3{
    color:;
}
#<?php echo $id; ?> h4{
    color:;
}
#<?php echo $id; ?> .tag{
  
}
#<?php echo $id; ?> .tag::before{
  
}
#<?php echo $id; ?> .tag::after{
}
#<?php echo $id; ?> .flip-card-front {

}
#<?php echo $id; ?>  .flip-card-front  .material-icons {

}
</style>