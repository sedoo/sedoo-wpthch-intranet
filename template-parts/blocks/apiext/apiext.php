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
$id = 'apiext-' . $block['id'];
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
$title = get_field('intranet_apiext_block_title');
$categories = get_field('intranet_apiext_block_category');
$description = get_field(' intranet_apiext_block_description');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> content-list">
    <h2><?php echo $title;?></h2>
    <div><?php echo $description;?></div>
    <?php
    // if ($categories) {
        
    // }else {

    // }
    if( have_rows('intranet_apiext', 'option') ) {
        while( have_rows('intranet_apiext', 'option') ) : the_row();
            // Load sub field value.
            $intranet_apiext_nom= get_sub_field('intranet_apiext_application_nom');
            $intranet_apiext_application_description= get_sub_field('intranet_apiext_application_description');
            $intranet_apiext_url= get_sub_field('intranet_apiext_application_url');
            $intranet_apiext_application_categorie= get_sub_field('intranet_apiext_application_categorie');
            $intranet_apiext_application_icone= get_sub_field('intranet_apiext_application_icone');

            // echo $apiextCategory->slug ."=".$term->slug;
            // var_dump($intranet_apiext_application_categorie);
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
            <?php //the_permalink(); ?>
                <header class="entry-header">
                    <ul>
                    <?php
                    if ( ! empty( $intranet_apiext_application_categorie ) ) {
                        foreach ($intranet_apiext_application_categorie as $category) {
                            // var_dump($category);
                            echo '<li class="tag"><a href="' . get_term_link( $category->term_id, $category->taxonomy ) . '">' . $category->name .'</a></li>'; 
                        }   
                    }; 
                    ?>
                    </ul>
                    
                </header><!-- .entry-header -->
                <div class="group-content">
                    <div class="entry-content">
                        <h2><a href="<?php echo $intranet_apiext_url; ?>" target="_blank"><?php echo $intranet_apiext_nom; ?></a></h2>
                        <?php echo $intranet_apiext_application_description; ?>
                        
                    </div><!-- .entry-content -->
                </div>
            </article><!-- #post-->

        <?php
        endwhile;
    
    // No value.
    }
    else {
        ?>
        <p>Aucune application actuellement</p>
        <?php
    }
    ?>
</section>


