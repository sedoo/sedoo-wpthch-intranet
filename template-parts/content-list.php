<?php
/**
 * Template part for displaying posts - simple list
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package labs_by_Sedoo
 */

$categories = get_the_category();
$test = get_queried_object();
var_dump($test);
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
    <div class="group-content">
        <div class="entry-content">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

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
            <?php the_excerpt(); ?>
        </div><!-- .entry-content -->
    </div>
</article><!-- #post-->
