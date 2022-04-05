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
  <div>
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
      // var_dump($term);
        sedoo_wpthch_intranet_contact_list($themes[0]->slug);
      ?>
      <?php
      if( get_field('intranet_relatedfile') ) {
      ?>
      <section>
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
                $file= get_sub_field('intranet_relatedfile_internal_url');
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
          sedoo_wpthch_intranet_accordion_panel('Files', 'false', 'Liens', 'source',  $description, $content);
        ?>

      </section>
      <section id="apiext" class="content-list" role="listNews">
					<?php
					/////////////   Applications externes    ////////////
					ob_start(); // création d'un buffer
					sedoo_wpthch_intranet_apiext_list($themes[0]->term_id);
          $description="";
					$content = ob_get_contents();
					ob_end_clean(); //Stops saving things and discards whatever was saved
					
					sedoo_wpthch_intranet_accordion_panel('apiext', 'false', 'Applications en relation', 'miscellaneous_services',  $description, $content);
					?>
					</section>
      <?php
      }
      ?>
        
    </aside>
    <?php
    if (get_field('intranet_taxo_root', 'category' . '_' . $themes[0]->term_id)) {
      $baseFolder = get_field('intranet_taxo_root', 'category' . '_' . $themes[0]->term_id);
      if ( !empty($baseFolder)) {
      ?>
      <section id="filetree">
        <?php
        /////////////   Applications externes    ////////////
        ob_start(); // création d'un buffer
        sedoo_wpthch_intranet_filetree_section($baseFolder);
        $content = ob_get_contents();
        ob_end_clean(); //Stops saving things and discards whatever was saved
        
        $title="Tous les fichiers de la catégorie ". $themes[0]->name;
        $description="<em>Ne concerne que les documents internes hors officiels des tutelles</em>";
        sedoo_wpthch_intranet_accordion_panel('filetreemap', 'false', $title, 'account_tree',  $description, $content);
        ?>
      </section>
      <?php
      }
      ?>
    <?php
    }
    ?>
  <?php
  }
  ?>
</div>  
</article>