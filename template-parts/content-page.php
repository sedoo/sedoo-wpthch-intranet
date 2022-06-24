<?php
/**
 * @package labs_by_Sedoo
 */
$themes = get_the_terms( $post->ID, 'category');  
$themeSlugRewrite = "category";
// var_dump($themes);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 

  <h1> <?php echo get_the_title(); ?> </h1>
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
      if ( is_user_logged_in() ) {
            
        /////////////   CONTACTS    ////////////
        if( have_rows('intranet_service', 'option') ) {
          if (sedoo_wpthch_intranet_dataOption_exist('intranet_service', 'intranet_service_categorie', $themes[0]->slug)) {
            ?>
            
            <section id="contact">
            <?php
            ob_start(); // création d'un buffer
            sedoo_wpthch_intranet_tuile_contact_list($themes[0]->slug);
            $content = ob_get_contents();
            ob_end_clean(); //Stops saving things and discards whatever was saved

            sedoo_wpthch_intranet_simple_panel('Contacts', $themes[0]->slug, 'Contacts', 'contacts',  $description, $content);
            ?>
            </section>
        <?php
          }
        }
      } else {
        sedoo_wpthch_intranet_login_form('login-form-404', 'login-form');
      }
      ?>
      <?php
      /////////////   RELATED FILES / LINK    ////////////
      if( get_field('intranet_relatedfile') ) {
        ?>
        <section id="relatedFiles">
          <?php
            ob_start(); // création d'un buffer
              ///
              $description="
              <div class=\"legend\">
              <span>
                <span class=\"material-icons\">insert_drive_file</span> Fichiers internes
              </span>
              <span>
                <span class=\"material-icons\">feed</span> Formulaires internes
              </span>
              <span>
                <span class=\"material-icons\">open_in_browser</span> Liens externes
              </span>
            </div>";
              ///
              /// CONTENT
            echo '<ul>';
            while( the_repeater_field('intranet_relatedfile') ) {
              $source=get_sub_field('intranet_relatedfile_source');
              // var_dump($source);
                if (get_sub_field('intranet_relatedfile_internal_url') && ($source["value"] == "interne"))  {
                  $file= str_replace("https://fb2.sedoo.fr/files/", "", get_sub_field('intranet_relatedfile_internal_url'));
                  $api_getfile_url=get_field('intranet_API_getfile_url', 'options');
                  $file_url=$api_getfile_url.$file;
                  $target="_self";
                  $icon="insert_drive_file";
                }
                if (get_sub_field('intranet_relatedfile_internal_url_form') && ($source["value"] == "interneForm"))  {
                  $file_url_form= get_sub_field('intranet_relatedfile_internal_url_form');
                  $file_url=$file_url_form[0]->guid;
                  $target="_self";
                  $icon="feed";
                }
                if (get_sub_field('intranet_relatedfile_external_url') && ($source["value"] == "externe"))  {  
                  $file_url= get_sub_field('intranet_relatedfile_external_url');
                  $target="_blank";
                  $icon="open_in_browser";
                }
                if (!empty(get_sub_field('intranet_relatedfile_name'))){
                echo '<li><a href="'.$file_url.'" target="'.$target.'"><span class="material-icons">'.$icon.'</span> '.get_sub_field('intranet_relatedfile_name').'</a></li>';
              }
            }
            echo '</ul>';
            //// END CONTENT
            // copie du buffer dans $content
            $content = ob_get_contents();
            ob_end_clean(); //Stops saving things and discards whatever was saved
            ob_flush();// vidage buffer
            sedoo_wpthch_intranet_simple_panel('Files', 'false', 'Liens', 'source',  $description, $content);
          ?>

        </section>
        <?php
      }
      ?>
      <?php
      if( have_rows('intranet_apiext', 'option') ) {
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

