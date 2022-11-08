<?php
/**
 * @package labs_by_Sedoo
 */
$themes = get_the_terms( $post->ID, 'category');  
$themeSlugRewrite = "category";
// var_dump($themes);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 

  <h1> <?php echo get_the_title(); ?> 
    <?php sedoo_wpthch_intranet_get_group($post->ID); ?>
  </h1>
  <?php 
  if( function_exists('sedoo_show_categories') && $themes){
  ?>
  <div id="catList">
    <?php 
    sedoo_show_categories($themes, $themeSlugRewrite);
    ?> 
  </div>
  <?php
  }
  ?>
  <div class="sedoo-intranet-page">
    <section data-role="sedoo-intranet-page-content">
      <?php the_content() ?>
    </section>
    <?php
    if (!is_front_page()){
    ?>
    <aside id="accordionGroup" class="Accordion contextual-sidebar" data-allow-multiple>
      <?php
      $description="";
      if ( is_user_logged_in() ) {
            
        /////////////   CONTACTS    ////////////
        if ($themes) {
        sedoo_wpthch_intranet_contacts($themes[0]->slug, $description);
        }   
      } else {
        sedoo_wpthch_intranet_login_form('login-form-404', 'login-form');
      }
      ?>

      <?php
      if( (have_rows('intranet_apiext', 'option')) && ($themes) ) {
        if (sedoo_wpthch_intranet_dataOption_exist('intranet_apiext', 'intranet_apiext_application_categorie', $themes[0]->term_id)) {
          ?>
          <section id="relatedApiext" class="content-list" role="listNews">
            <?php
            /////////////   Applications externes    ////////////
            ob_start(); // création d'un buffer
            sedoo_wpthch_intranet_apiext_list($themes[0]->term_id);
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
        
    </aside>
    
  <?php
  }
  ?>
</div>  
</article>

