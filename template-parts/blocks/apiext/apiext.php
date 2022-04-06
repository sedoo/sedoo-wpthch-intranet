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
$id = 'relatedApiext-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'apiext';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
if (get_field('intranet_apiext_block_title')) {
$title = get_field('intranet_apiext_block_title');
}
if (get_field('intranet_apiext_block_category')) {
$categories = get_field('intranet_apiext_block_category');
}

if (get_field('intranet_apiext_block_description')) {
$description = get_field('intranet_apiext_block_description');
} else {
    $description=false;
}

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> content-list Accordion" data-allow-multiple>

    <?php
    ob_start(); // création d'un buffer
    if ($categories) {

        foreach ($categories as $category) {
            echo "<h4>".$category->name. "</h4>";
            sedoo_wpthch_intranet_apiext_list($category->term_id);
        }
        
    }else {
        $category="none";
        sedoo_wpthch_intranet_apiext_list($category);
    }
    ?>


<?php
    // copie du buffer dans $content
    $content = ob_get_contents();
    ob_end_clean(); //Stops saving things and discards whatever was saved
    
    sedoo_wpthch_intranet_simple_panel('apiext-' . $block['id'], 'false', $title, 'miscellaneous_services',  $description, $content);

?>
</section>



