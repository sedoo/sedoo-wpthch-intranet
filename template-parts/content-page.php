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
        sedoo_wpthch_intranet_contact_section($themes[0]->slug);
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
          sedoo_wpthch_intranet_accordion_panel('Files', 'false', 'Liens externes', 'source',  $description, $content);
        ?>

      </section>
      <?php
      }
      ?>
        
    </aside>
    <?php
    if (get_field('intranet_taxo_root', 'category' . '_' . $themes[0]->term_id)) {
    ?>
    <section id="filetree">
      <h2><span class="material-icons">account_tree</span> Tous les fichiers internes de la catégorie <?php echo $themes[0]->name;?></h2>
      <p><em>Ne concerne que les documents internes hors officiels des tutelles</em></p>
      <?php
      $baseFolder = get_field('intranet_taxo_root', 'category' . '_' . $themes[0]->term_id);
      ?>
      <script src="https://services.aeris-data.fr/cdn/jsrepo/v1_0/download/sandbox/release/sedoocampaigns/0.1.0"></script>
      <campaign-product viewer="tree" service="https://api.sedoo.fr/intranet-omp-service-rest/data/v1_0" campaign="intranetomp" base-folder="<?php echo $baseFolder;?>" product="intranet-filetree">
      </campaign-product>
    </section>
    <?php
    }
    ?>
  <?php
  }
  ?>
</div>  
</article>