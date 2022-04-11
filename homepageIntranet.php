<?php
/*
Template Name: Homepage intranet
 * @package labs_by_Sedoo
 */

get_header();
$query_object = get_queried_object();
$page_id = get_queried_object_id();
$termsSlugRewrite = "category";
$args = [
    'taxonomy'     => $termsSlugRewrite,
    'parent'        => 0,
    'number'        => 10,
    'hide_empty'    => false           
];
$terms = get_terms( $args );

?>
<div id="primary" class="content-area" data-role="homepageIntranet">
    <main id="main" class="site-main">
        <?php
        while ( have_posts() ) : the_post();
        
            if($terms) {
            ?>
            <div id="catList">
                <div class="tag">
                <?php 
                foreach ($terms as $term) {
                    // var_dump($term);
                    if ($term->slug !== "non-classe") {
                    ?>
                    <a class="<?php echo $term->slug;?>" href="#<?php echo $term->slug;?>"><?php echo $term->name;?></a>
                    <?php 
                    } 
                }
                ?> 
                </div>
            </div>
            <?php
            }
            ?>

            <?php
            foreach ($terms as $term) {
                // var_dump($term);
                if ($term->slug !== "non-classe") {
                ?>
                <section id="<?php echo $term->slug;?>">
                    <h2 class="<?php echo $term->slug;?>-bg"><?php echo $term->name;?></h2>
                    <div class="row1">
                    <!--------------  CONTACTS ---------------->
                    <?php
                    if( have_rows('intranet_service', 'option') ) {
                        if (sedoo_wpthch_intranet_dataOption_exist('intranet_service', 'intranet_service_categorie', $term->slug)) {
                        ?>
                        <section id="contact">
                        <?php
                        ob_start(); // création d'un buffer
                        sedoo_wpthch_intranet_contact_list($term->slug);
                        $content = ob_get_contents();
                        ob_end_clean(); //Stops saving things and discards whatever was saved

                        sedoo_wpthch_intranet_simple_panel('Contacts', 'false', 'Contacts', 'contacts',  $description, $content);
                        ?>
                        </section>
                        <?php
                        }
                    }
                    ?>

                    <!--------------  APPLICATIONS ---------------->
                    <?php
                    if( have_rows('intranet_apiext', 'option') ) {
                        if (sedoo_wpthch_intranet_dataOption_exist('intranet_apiext', 'intranet_apiext_application_categorie', $term->term_id)) {
                        ?>
                        <section id="relatedApiext" class="content-list" role="listNews">
                            <?php
                            /////////////   Applications externes    ////////////
                            ob_start(); // création d'un buffer
                            sedoo_wpthch_intranet_apiext_list($term->term_id);
                            $description="";
                            $content = ob_get_contents();
                            ob_end_clean(); //Stops saving things and discards whatever was saved
                            
                            sedoo_wpthch_intranet_simple_panel('apiext', 'false', 'Applications en relation', 'miscellaneous_services',  $description, $content);
                            ?>
                            </section>
                    <?php
                        }
                    }
                    ?>
                    
                    <!--------------  PAGES ---------------->
                        <section id="pageList">
                        <?php
                        ob_start(); // création d'un buffer
                        
                        sedoo_wpthch_intranet_page_list($term->slug);
                        $content = ob_get_contents();
                        ob_end_clean(); //Stops saving things and discards whatever was saved
                        sedoo_wpthch_intranet_simple_panel('PageList', 'false', 'Documents', 'description',  $description, $content);
                        ?>
                        </section>
                    </div>
                    <div class="row2">
                    <!--------------  FILEBROWSER ---------------->
                    <?php
                    if (get_field('intranet_taxo_root', 'category' . '_' . $term->term_id)) {
                    $baseFolder = get_field('intranet_taxo_root', 'category' . '_' . $term->term_id);
                    if ( !empty($baseFolder)) {
                    ?>
                        <section id="filetree">
                            <?php
                            /////////////   Applications externes    ////////////
                            ob_start(); // création d'un buffer
                            sedoo_wpthch_intranet_filetree_section($baseFolder);
                            $content = ob_get_contents();
                            ob_end_clean(); //Stops saving things and discards whatever was saved
                            
                            $title="Tous les fichiers de la catégorie ". $term->name;
                            $description="<em>Ne concerne que les documents internes hors officiels des tutelles</em>";
                            sedoo_wpthch_intranet_simple_panel('filetreemap', 'false', $title, 'account_tree',  $description, $content);
                            ?>
                        </section>
                    <?php
                    }
                    ?>
                    <?php
                    }
                    ?>
                    </div>
                </section>
                
                <?php 
                }

            }
            ?> 

        <?php
        endwhile; // End of the loop.
        ?>
    </main><!-- #main -->
    
</div><!-- #primary -->
<?php

get_footer();

