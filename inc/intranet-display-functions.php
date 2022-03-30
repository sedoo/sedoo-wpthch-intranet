<?php

// Contact par services
function sedoo_wpthch_intranet_contact_section($termSlug) {
    if( have_rows('intranet_service', 'option') ) {
    ?>
    <section id="contact">
    <h2>
      <button aria-expanded="true"
            class="Accordion-trigger"
            aria-controls="sectionContacts"
            id="accordionContact">
      <span class="Accordion-title"><span class="material-icons">contacts</span>
        Contacts
        <span class="Accordion-icon"></span>
      </span>
      </button>
    </h2>
    <div id="sectionContacts"
     role="region"
     aria-labelledby="accordionContact"
     class="Accordion-panel">
      <?php
      while( have_rows('intranet_service', 'option') ) : the_row();
        // Load sub field value.
        $serviceCategory = get_sub_field('intranet_service_categorie');
        foreach ($serviceCategory as $service) {
          // echo $service->slug.' ';
          if ($service->slug === $termSlug) {	
            $intranet_service_nom= get_sub_field('intranet_service_nom');
            $intranet_service_mail= get_sub_field('intranet_service_mail');
            $intranet_service_gestionnaires= get_sub_field('intranet_service_gestionnaires');

            // echo "<h3>Adresse générique de contact</h3>";
            echo "<h3>".$intranet_service_nom ."</h3>";
            echo "<p><span class=\"material-icons\">mail</span> ".$intranet_service_mail."</p>";
            echo "<h3><span class=\"material-icons\">contact_mail</span></h3>";
            echo "<ul id=\"gestionnaires\">";
            foreach ($intranet_service_gestionnaires as $gestionnaire) {	
              ?>
              <li>
                <figure> 
                <?php 
                  $img_id = get_user_meta($gestionnaire->ID, 'photo_auteur', true);
                  $img_url=wp_get_attachment_image_url( $img_id, 'thumbnail' );

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
    ?>
    </div>
  </section>
  <?php
    }else {
        ?>
        <p>Aucune adresse de contact actuellement</p>
        <?php
      }
      ?>
<?php
}

// Filetree 
function sedoo_wpthch_intranet_filetree_section($baseFolder) {
    ?>
    <script src="https://services.aeris-data.fr/cdn/jsrepo/v1_0/download/sandbox/release/sedoocampaigns/0.1.0"></script>
    <campaign-product viewer="tree" service="https://api.sedoo.fr/intranet-omp-service-rest/data/v1_0" campaign="intranetomp" base-folder="<?php echo $baseFolder;?>" product="intranet-filetree">
    </campaign-product>
    <?php
}
?>