<?php 
// Load values and assign defaults.
$titreBlock = get_field('intranet_super_tile_block_title');
$superTileIcone = get_field('intranet_super_tile_block_icone');
$link = get_field('intranet_super_tile_block_link');
$link_url = $link['url'];
$tag = get_field('intranet_super_tile_block_tag');
?>
<a id="<?php echo esc_attr($id); ?>" href="<?php echo $link_url; ?>" title="<?php echo $titreBlock; ?>" class="">    

<span class="material-icons"><?php echo $superTileIcone; ?></span>    

    <h3><?php echo $titreBlock; ?></h3>

    <p><?php echo $description; ?></p>

    <span class="tag"><?php echo $tag; ?></span>

</a>