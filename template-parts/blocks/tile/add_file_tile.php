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
$id = 'add_file_tile-' . $block['id'];
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
$typeDeBlock = 'add_file_tile';
$addFileBlockURL = 'intranet_add_file_tile_block_type_choice';


?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> intranet-tile-type-<?php echo $typeDeBlock; ?>">

    <div>

      <span class="material-icons">cloud_upload</span>    
        
      <h3>Uploader un fichier</h3>

    </div>


</section>

<style>
.intranet-tile-type-add_file_tile > div {
   
    padding: 10 15px;
    border-radius:10px;
    background-color:rgb(30, 52, 219);
    color:white;
    position:relative;
    z-index:2;
    padding:15px;
    text-align:center;
    width:280px;
    border:2px solid white;
    box-sizing:border-box;
}
.intranet-tile-type-add_file_tile > div h3{
    color:white;
    vertical-align:middle;
    display:inline-block;
    vertical-align:middle;
    margin:0;

}
.intranet-tile-type-add_file_tile:hover h3 {
    text-decoration:underline;
}
.intranet-tile-type-add_file_tile span{
    cursor:pointer;
    display:inline-block;
    vertical-align:middle;
    font-size:37px!important;
    color:rgb(30, 52, 219)!important;
    background:white;
    width:50px;
    height:50px;
    line-height:50px;
    border-radius:50px;
    text-align:center;
    margin:0;
    transform: scale(0.8);
    -webkit-transform: scale(0.8);
    transition:ease all 0.3s;
}
.intranet-tile-type-add_file_tile:hover .material-icons{
    transform: scale(1);
    -webkit-transform: scale(1);
}
/* .intranet-tile-type-add_file_tile > div::before {
    content:''; 
    display:inline-block;
    position:absolute;
    width:150px;
    height:100px; 
    border-radius:70px;
    left:-35px;
    bottom:0;
    background:red;
    z-index:0;
}
.intranet-tile-type-add_file_tile > div::after {
    content:''; 
    display:inline-block;
    position:absolute;
    width:150px;
    height:100px; 
    border-radius:70px;
    right:-35px;
    bottom:0;
    background:red;
    z-index:0;
} */
</style>