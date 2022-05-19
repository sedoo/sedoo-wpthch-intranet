<?php 
$typeFile = get_field('intranet_super_tile_block_type_form');
$superTileIcone = get_field('intranet_super_tile_block_icone');
$titreBlock = get_field('intranet_super_tile_block_title');
$link = get_field('intranet_super_tile_block_link');
$link_url = $link['url'];
$tag = get_field('intranet_super_tile_block_tag');
?>

<a id="<?php echo esc_attr($id); ?>" href="<?php echo $link_url; ?>" title="<?php echo $titreBlock; ?>" class="">    

    <span class="typeFile"><?php echo $typeFile; ?></span>

    <span class="material-icons"><?php echo $superTileIcone; ?></span>    

    <h3><?php echo $titreBlock; ?></h3>

    <span class="tag"><?php echo $tag; ?></span>

</a>