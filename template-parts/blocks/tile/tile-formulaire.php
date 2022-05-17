<?php 
$typeFile = get_field('intranet_super_tile_block_type_form');
$superTileIcone = get_field('intranet_super_tile_block_icone');
$titreBlock = get_field('intranet_super_tile_block_title');
$tag = get_field('intranet_super_tile_block_tag');


?>
<span class="typeFile"><?php echo $typeFile; ?></span>

<span class="material-icons"><?php echo $superTileIcone; ?></span>    

<h3><?php echo $titreBlock; ?></h3>

<span class="tag"><?php echo $tag; ?></span>