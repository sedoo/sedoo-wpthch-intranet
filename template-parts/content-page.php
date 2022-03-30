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
        <h2>
          <button aria-expanded="false"
                class="Accordion-trigger"
                aria-controls="sectionFiles"
                id="accordionFiles">
          <span class="Accordion-title">
          <span class="material-icons">cloud</span> Fichiers / liens en relation
            <span class="Accordion-icon"></span>
          </span>
          </button>
        </h2>
        <div id="sectionFiles"
         role="region"
         aria-labelledby="accordionFiles"
         class="Accordion-panel">
          <?php
          echo '<ul>';
          while( the_repeater_field('intranet_relatedfile') ) {
              if (get_sub_field('intranet_relatedfile_internal_url')) {
                $file= get_sub_field('intranet_relatedfile_internal_url');
                $api_getfile_url=get_field('intranet_API_getfile_url', 'options');
                $file_url=$api_getfile_url.$file;
                $icon="insert_drive_file";
              }
              if (get_sub_field('intranet_relatedfile_external_url')) {
                $file_url= get_sub_field('intranet_relatedfile_external_url');
                $icon="open_in_browser";
              }
              // echo $api_getfile_url;
              echo '<li><a href="'.$file_url.'" target="_blank"><span class="material-icons">'.$icon.'</span> '.get_sub_field('intranet_relatedfile_name').'</a></li>';
          }
          echo '</ul>';
          ?>
        </div>
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