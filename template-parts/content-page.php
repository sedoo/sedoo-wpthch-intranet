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
    <aside class="contextual-sidebar">
      <?php
      // var_dump($term);
      if( have_rows('intranet_service', 'option') ) {
      ?>
      <section id="contact">
        <h2>Contacts</h2>
        <?php
        // var_dump($term);
          while( have_rows('intranet_service', 'option') ) : the_row();
            // Load sub field value.
            $serviceCategory = get_sub_field('intranet_service_categorie');
            // echo $themes[0]->slug ."=";
            // var_dump($themes);
            foreach ($serviceCategory as $service) {
              // echo $service->slug.' ';
              if ($service->slug === $themes[0]->slug) {	
                $intranet_service_nom= get_sub_field('intranet_service_nom');
                $intranet_service_mail= get_sub_field('intranet_service_mail');
                $intranet_service_gestionnaires= get_sub_field('intranet_service_gestionnaires');
                // echo "<h2>".$intranet_service_nom ."</h2>";
                echo "<h3>Adresse générique de contact</h3>";
                echo "<p>".$intranet_service_mail."</p>";
                echo "<h3>Vos gestionnaires</h3>";
                echo "<ul id=\"gestionnaires\">";
                foreach ($intranet_service_gestionnaires as $gestionnaire) {
                  // var_dump($gestionnaire);	
                  ?>
                  <li>
                    <figure> 
                    <?php 
                      $img_id = get_user_meta($gestionnaire->ID, 'photo_auteur', true);
                      $img_url=wp_get_attachment_image_url( $img_id, 'thumbnail' );
                      // var_dump($img_url);
                      if($img_url) {
                      ?>
                        <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo get_user_meta( $gestionnaire->ID,'first_name', true). ' '.get_user_meta( $gestionnaire->ID,'last_name', true); ?>" />
                        <?php	
                        } else {
                        echo "<span class=\"userLetters\">".substr($gestionnaire->last_name, 0, 1).substr($gestionnaire->first_name, 0, 1)."</span>";
                      }
                      ?>
                    </figure> 
                    <p>
                      <?php echo $gestionnaire->last_name." ".$gestionnaire->first_name;?>
                    </p>
                <?php
                }
                echo "</ul>";
                
              }
            }
            // var_dump($serviceCategory);			
            // echo"<br>";	
            // echo $serviceCategory[0]->slug;
            // echo"<hr>";	
          endwhile;
        
        // No value.
        
        ?>
      </section>
      <?php
      }
      ?>
      <?php
      if( get_field('intranet_relatedfile') ) {
      ?>
      <section>
        <h2>Fichiers / liens en relation</h2>
        <?php
        
            echo '<ul>';
            while( the_repeater_field('intranet_relatedfile') ) {
                if (get_sub_field('intranet_relatedfile_internal_url')) {
                  $file= get_sub_field('intranet_relatedfile_internal_url');
                  $api_getfile_url=get_field('intranet_API_getfile_url', 'options');
                  $file_url=$api_getfile_url.$file;
                }
                if (get_sub_field('intranet_relatedfile_external_url')) {
                  $file_url= get_sub_field('intranet_relatedfile_external_url');
                }
                // echo $api_getfile_url;
                echo '<li><a href="'.$file_url.'" target="_blank">'.get_sub_field('intranet_relatedfile_name').'</a></li>';
            }
            echo '</ul>';
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
      <h2>Tous les fichiers de la catégorie <?php echo $themes[0]->name;?></h2>
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