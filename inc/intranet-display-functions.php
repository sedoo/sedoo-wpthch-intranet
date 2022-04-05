<?php

/**
 *  simple panel
 */
// ne pas oublier d'ajouter sur l'élément parent class="Accordion" data-allow-multiple
function sedoo_wpthch_intranet_simple_panel($id,$ariaExpanded, $title, $icon, $description, $content) {
  ?>
  <h3>
        <span class="material-icons"><?php echo $icon;?></span>
        <?php echo $title;?>
      <!-- </button> -->
    </h3>
    <?php
    if ($description) {
    ?>
    <div><?php echo $description;?></div>
    <?php
    }
    ?>
    <div id="section-<?php echo $id;?>">
      <?php echo $content;?>
    </div>
<?php
}

/**
 *  accordion panel
 */
// ne pas oublier d'ajouter sur l'élément parent class="Accordion" data-allow-multiple
function sedoo_wpthch_intranet_accordion_panel($id,$ariaExpanded, $title, $icon, $description, $content) {
  ?>
  <!-- <h3> -->
      <button aria-expanded="<?php echo $ariaExpanded;?>"
            class="Accordion-trigger"
            aria-controls="section-<?php echo $id;?>"
            id="accordion-<?php echo $id;?>">
        <span class="Accordion-title"><span class="material-icons"><?php echo $icon;?></span>
        <?php echo $title;?>
        <span class="Accordion-icon"></span>
      </span>
      </button>
    <!-- </h3> -->
    <?php
    if ($description) {
    ?>
    <div><?php echo $description;?></div>
    <?php
    }
    ?>
    <div id="section-<?php echo $id;?>"
     role="region"
     aria-labelledby="accordion-<?php echo $id;?>"
     class="Accordion-panel">
      <?php echo $content;?>
    </div>
<?php
}

// Contact par services
function sedoo_wpthch_intranet_contact_list($termSlug) {
    if( have_rows('intranet_service', 'option') ) {
    ?>
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
            echo "<h4>".$intranet_service_nom ."</h4>";
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
      endwhile;
    ?>
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

/**
 * API EXT
 * 
 */
// display apiext
function sedoo_wpthch_intranet_apiext_display($intranet_apiext_nom, $intranet_apiext_application_description, $intranet_apiext_application_categorie, $intranet_apiext_url, $intranet_apiext_application_icone ) {
  ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
    <header class="entry-header">
        <ul>
        <?php
        if ( ! empty( $intranet_apiext_application_categorie ) ) {
            foreach ($intranet_apiext_application_categorie as $apiext_category) {
                // var_dump($apiext_category);
                echo '<li class="tag"><a href="' . get_term_link( $apiext_category->term_id, $apiext_category->taxonomy ) . '">'. $apiext_category->name .'</a></li>'; 
            }   
        }; 
        ?>
        </ul>
        
    </header><!-- .entry-header -->
    <div class="group-content">
        <div class="entry-content">
            <h3><a href="<?php echo $intranet_apiext_url; ?>" target="_blank"><span class="material-icons"><?php echo $intranet_apiext_application_icone;?></span> <?php echo $intranet_apiext_nom; ?></a></h3>
            <p><?php echo $intranet_apiext_application_description; ?></p>
            
        </div><!-- .entry-content -->
    </div>
</article><!-- #post-->
<?php
}
// list apiext
function sedoo_wpthch_intranet_apiext_list($categoryTermID) {
  // echo 

  if( have_rows('intranet_apiext', 'option') ) {
    while( have_rows('intranet_apiext', 'option') ) : the_row();
        // Load sub field value.
        $intranet_apiext_nom= get_sub_field('intranet_apiext_application_nom');
        $intranet_apiext_application_description= get_sub_field('intranet_apiext_application_description');
        $intranet_apiext_url= get_sub_field('intranet_apiext_application_url');
        $intranet_apiext_application_categorie= get_sub_field('intranet_apiext_application_categorie');
        $intranet_apiext_application_icone= get_sub_field('intranet_apiext_application_icone');
        $get_term_value=array();
        if ( ! empty( $intranet_apiext_application_categorie ) ) {
          foreach ($intranet_apiext_application_categorie as $apiext_category) {
            // echo "Term ID : ".$apiext_category->term_id." / Parent term ID :".$apiext_category->parent."<br>";
            array_push($get_term_value, $apiext_category->term_id, $apiext_category->parent);
          }
        }
        // echo "CAT=".$categoryTermID;
        if ($categoryTermID!=="none") {
          if ((in_array($categoryTermID, $get_term_value)) && ($categoryTermID!=="none")) {
            // display
            sedoo_wpthch_intranet_apiext_display($intranet_apiext_nom, $intranet_apiext_application_description, $intranet_apiext_application_categorie, $intranet_apiext_url, $intranet_apiext_application_icone ); 
          }
        }
         else {
          sedoo_wpthch_intranet_apiext_display($intranet_apiext_nom, $intranet_apiext_application_description, $intranet_apiext_application_categorie, $intranet_apiext_url, $intranet_apiext_application_icone ); 
        }

    endwhile;
    // var_dump($get_term_value);

  // No value.
  }
  else {
      ?>
      <p>Aucune application actuellement</p>
      <?php
  }
}
?>