<?php
/**
 * Template part for displaying posts - simple list
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package labs_by_Sedoo
 */

$categories = get_the_category();
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
    <div class="group-content">
        <div class="entry-content">
            <p>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <?php sedoo_wpthch_intranet_get_group($post->ID); ?>
            </p>

            <ul>
            <?php
            if ( ! empty( $categories ) ) {
                foreach ($categories as $category) {
                    // var_dump($category);
                    echo '<li class="tag"><a href="' . get_term_link( $category->term_id, $category->taxonomy ) . '">' . $category->name .'</a></li>'; 
                }   
            }; 
            ?>
            </ul>
            <?php //the_excerpt(); ?>
        </div><!-- .entry-content -->
    </div>
</article><!-- #post-->
