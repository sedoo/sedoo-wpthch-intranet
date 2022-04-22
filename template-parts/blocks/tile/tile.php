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

// Load values and assign defaults.
$title = get_field('intranet_tile_block_title');
$description = get_field('intranet_tile_block_description');
$external_link = get_field('intranet_tile_block_external_link');
$internal_link = get_field('intranet_tile_block_internal_link');
$bgTileColor = get_field('intranet_tile_block_bg_color');
$textTileColor = get_field('intranet_tile_block_text_color');
$tileIcone = get_field('intranet_tile_block_icone');
$textBouton = get_field('intranet_tile_block_anchor_value');

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> intranet-tile">

        <span class="material-icons"><?php echo $tileIcone; ?></span>    

        <h3><?php echo $title; ?></h3>

        <p><?php echo $description; ?></p>
    
        <a href="<?php if (get_field('intranet_tile_block_external_link')): echo $external_link; else : echo $internal_link; endif ?>" class="tileBtn"> <?php echo $textBouton ?> </a>
 


    <style type="text/css">
       #<?php echo $id; ?> {
           width:400px;
           height:250px;
            display:inline-block;
            vertical-align:top;
            padding:20px;
            margin:10px;
            box-sizing:border-box;
            border-radius:10px;
            background: <?php echo $bgTileColor; ?>;
            color: <?php echo $textTileColor; ?>; 
        }
        #<?php echo $id; ?> .material-icons{
            font-size: 37px;
            width: 50px;
            height: 50px;
            background: white;
            line-height: 50px;
            text-align: center;
            border-radius: 100%;
            float: right;
            color: <?php echo $bgTileColor; ?>;
        }
        #<?php echo $id; ?> h3{
            font-size:25px;
            margin-top:10px;
            color:<?php echo $textTileColor; ?>;
        }
        #<?php echo $id; ?> p{ 
            font-size:18px;
            height:76px;
        }
        #<?php echo $id; ?> .tileBtn{ 
            border:2px solid <?php $textTileColor;?>;
            padding:10px 15px;
            border-radius:5px;
            transition:ease all 0,3s;
            color:<?php echo $textTileColor; ?>;
        }
        #<?php echo $id; ?>  .tileBtn:hover{ 
            background-color:<?php echo $textTileColor; ?>;
            color:<?php echo $bgTileColor; ?>!important;
            border:2px solid <?php echo $bgTileColor;?>;

        }
    </style>
</div>