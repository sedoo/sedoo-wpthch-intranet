<?php

/**
 * Application exterieure Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'filetree-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'filetree';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// $term = get_queried_object();
// Load values and assign defaults.
$title = get_field('intranet_filetree_block_title');
$term_categories = get_field('intranet_filetree_block_category');
$description = get_field('intranet_filetree_block_description');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> content-list">
    <h2><span class="material-icons">account_tree</span> <span><?php echo $title;?></span></h2>
    <div><?php echo $description;?></div>
    <?php
    if (get_field('intranet_filetree_block_association')) {
        $baseFolder = get_field('intranet_taxo_root', 'category' . '_' . $term_categories->term_id);   
    } else {
        $baseFolder = get_field('intranet_filetree_block_root');
    }
    if ( !empty($baseFolder)) {

    sedoo_wpthch_intranet_filetree_section($baseFolder);

    } else {
        echo "<p><em>Aucun dossier sélectionné dans l'arborescence de fichier</em></p>";
    }
    ?>
</section>


