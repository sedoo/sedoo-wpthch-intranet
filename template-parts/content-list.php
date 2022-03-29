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
	<header class="entry-header">
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
        <p class="date"><?php the_date('d M Y') ?>
        
	</header><!-- .entry-header -->
    <div class="group-content">
        <div class="entry-content">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_excerpt(); ?>
            
        </div><!-- .entry-content -->
    </div>
</article><!-- #post-->
