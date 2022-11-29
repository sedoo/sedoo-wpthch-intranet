<?php
/** 
 * tuile 
 * ******************************************
 * 
 * */ 

// Used in sidebar
function sedoo_wpthch_intranet_contacts($slug, $description) {
  if( have_rows('intranet_service', 'option') ) {
    if (sedoo_wpthch_intranet_dataOption_exist('intranet_service', 'intranet_service_categorie', $slug)) {
    ?>
    <section id="contact">
    <?php
    ob_start(); // création d'un buffer
    sedoo_wpthch_intranet_contact_sidelist($slug);
    $content = ob_get_contents();
    ob_end_clean(); //Stops saving things and discards whatever was saved
    sedoo_wpthch_intranet_simple_panel('Contacts', $slug, 'Contacts', 'contacts',  $description, $content);
    ?>
    </section>
  <?php
    }
  }
}

// Liste Contact par services simple
function sedoo_wpthch_intranet_contact_sidelist($termSlug) {
  while( have_rows('intranet_service', 'option') ) : the_row();
    $restrict=FALSE; //set default, update if $intranet_service_application_restrict
    // Load sub field value.
    $serviceCategory = get_sub_field('intranet_service_categorie');
    foreach ($serviceCategory as $service) {
      // echo $service->slug.' ';
      if ($service->slug === $termSlug) {	
        $intranet_service_nom= get_sub_field('intranet_service_nom');
        $intranet_service_mail= explode('@', get_sub_field('intranet_service_mail'));
        $intranet_service_gestionnaires= get_sub_field('intranet_service_gestionnaires');
        $intranet_service_application_restrict= get_sub_field('intranet_service_application_restrict');
        if ($intranet_service_application_restrict) {
          $intranet_service_application_group= get_sub_field('intranet_service_application_group');
          $restrict = sedoo_wpthch_intranet_get_restrict_value($intranet_service_application_group);
        }
        if (!$restrict) {
        ?>
          <div class="h4">
            <strong><?php echo $intranet_service_mail[0]."<span class=\"hide\">Dear bot, you won't get my mail</span>@<span class=\"hide\">Dear bot, you won't get my mail</span>".$intranet_service_mail[1];?></strong> 
            <small>(<?php echo $intranet_service_nom;?> )</small>
          </div>
          <section id="gestionnaires">
          <?php
          foreach ($intranet_service_gestionnaires as $gestionnaire) {	
            ?>
            <div class="gestionnaire">
                <!-- <span class="material-icons">face</span>   -->
              <p>
                <a href="<?php echo get_site_url();?>/recherche-dans-lannuaire/?searchUser=<?php echo get_user_meta( $gestionnaire->ID,'last_name', true);?>">
                  <!-- <span class="material-icons">call</span> -->
                
                  <span class="material-icons">face</span>
                  <span>
                    <?php echo get_user_meta( $gestionnaire->ID,'first_name', true); ?>
                    <?php echo get_user_meta( $gestionnaire->ID,'last_name', true); ?>
                  </span>
                </a>
              </p>       
              
              <?php 
              $user_mail = explode('@', $gestionnaire->user_email);
              //echo "<p>".$user_mail[0]."<span class=\"hide\">Dear bot, you won't get my mail</span>@<span class=\"hide\">Dear bot, you won't get my mail</span>".$user_mail[1]."</p>";
              ?> 
    
            </div>  
            <?php
          }
          echo "</section>";
        }
      }
    }
  endwhile;
}

/** 
 * tuile Formulaire / application 
 * **/ 
function sedoo_wpthch_intranet_tuile($fieldArgs) { 
  ?> 
  <a href="<?php if (array_key_exists("link_url", $fieldArgs)){echo $fieldArgs["link_url"]; }?>" title="<?php echo $fieldArgs["titreBlock"]; ?>" class="">  
    <?php
      if (array_key_exists("superTileIcone", $fieldArgs))  {
      ?>
        <span class="material-icons"><?php echo $fieldArgs["superTileIcone"]; ?></span>    
      <?php 
      }
      ?>
      <h4><?php echo $fieldArgs["titreBlock"]; ?></h4>
  </a>
<?php 
}

/**
 *  simple panel
 * *******************************************/ 
function sedoo_wpthch_intranet_simple_panel($id, $term, $title, $icon, $description, $content) {
  ?>
  <div class="h3 <?php echo $term;?>-bg">
      <span class="material-icons"><?php echo $icon;?></span>
      <?php echo $title;?>
  </div>
  <?php
  if ($description) {
  ?>
  <div class="description"><?php echo $description;?></div>
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
 * *******************************************/ 
// ne pas oublier d'ajouter sur l'élément parent class="Accordion" data-allow-multiple
// UNUSED
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

// Test d'existance de valeurs dans ACF repeater field pour une catégorie donnée
// utilisé sur apiExt et contact des services
function sedoo_wpthch_intranet_dataOption_exist($acfField, $acfSubField, $attributeValue) {
  $exist=false;
  while( have_rows($acfField, 'option') ) : the_row();
    // Load sub field value.
    $serviceCategory = get_sub_field($acfSubField);

    switch ($acfField) {
      case 'intranet_service':
        foreach ($serviceCategory as $service) {
          // echo $service->slug.' ';
          if ($service->slug === $attributeValue) {	
            $exist=true;
          }
        }
        break;
      case 'intranet_apiext':
        if ( ! empty( $serviceCategory ) ) {
          $get_term_value=array();
          $toto="YES";
          foreach ($serviceCategory as $apiext_category) {
            // echo "Term ID : ".$apiext_category->term_id." / Parent term ID :".$apiext_category->parent."<br>";
            array_push($get_term_value, $apiext_category->term_id, $apiext_category->parent);
          }
        }
        // echo "CAT=".$categoryTermID;
        if ($attributeValue!=="none") {
          if ((in_array($attributeValue, $get_term_value)) && ($attributeValue!=="none")) {
            $exist=true;
          }
        }        
        break;
    }
    
    endwhile;
    return $exist;  
}

/** 
 *   Liste Contact par service
 * *******************************************/
function sedoo_wpthch_intranet_contact_list($termSlug) {
  while( have_rows('intranet_service', 'option') ) : the_row();
    // Load sub field value.
    $serviceCategory = get_sub_field('intranet_service_categorie');
    foreach ($serviceCategory as $service) {
      // echo $service->slug.' ';
      if ($service->slug === $termSlug) {	
        $intranet_service_nom= get_sub_field('intranet_service_nom');
        $intranet_service_mail= explode('@', get_sub_field('intranet_service_mail'));
        $intranet_service_gestionnaires= get_sub_field('intranet_service_gestionnaires');

        // echo "<h3>Adresse générique de contact</h3>";
        ?>
        <div class="h4">
          <strong><?php echo $intranet_service_mail[0]."<span class=\"hide\">Dear bot, you won't get my mail</span>@<span class=\"hide\">Dear bot, you won't get my mail</span>".$intranet_service_mail[1];?></strong> <small>(<?php echo $intranet_service_nom;?> )</small>
          <!--<span class="material-icons">mail</span>-->
        </div>
        <ul id="gestionnaires">
        <?php
        foreach ($intranet_service_gestionnaires as $gestionnaire) {	
          ?>
          <li>
              <a href="<?php echo get_site_url();?>/recherche-dans-lannuaire/?searchUser=<?php echo get_user_meta( $gestionnaire->ID,'last_name', true);?>">
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
            </a>
          </li>
        <?php
        }
        echo "</ul>";
        
      }
    }
  endwhile;
}



// Liste de page / catégories
function sedoo_wpthch_intranet_page_list($termSlug) {
  $args = array(
    'post_type' => array( 'page' ),
    'orderby' => 'date',
    'posts_per_page' => 10,
    'tax_query' => array(
      array(
          'taxonomy' => 'category',
          'field'    => 'slug',
          'terms'    => $termSlug,
      ),
    ),
  );
  $the_query = new WP_Query( $args );
  if ( $the_query->have_posts() ) {
    echo '<ul>';
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        echo '<li><a href="'.get_permalink().'">' . get_the_title() . '</a></li>';
        // the_permalink();
    }
    echo '</ul>';
  } else {
      // no posts found
  }
  /* Restore original Post Data */
  wp_reset_postdata();

}

// Filetree 
function sedoo_wpthch_intranet_filetree_section($baseFolder) {
    ?>
    <script src="https://api.sedoo.fr/aeris-cdn-rest/jsrepo/v1_0/download/sandbox/release/sedoocampaigns/0.1.0"></script>
    <campaign-product viewer="tree" service="https://api.sedoo.fr/intranet-omp-service-rest/data/v1_0" campaign="intranetomp" base-folder="<?php echo $baseFolder;?>" product="intranet-filetree">
    </campaign-product>
    <?php
}

/**
 * API EXT
 * 
 */

// display apiext  OBSOLETE A PRIORI
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
            <h3><a href="<?php echo $intranet_apiext_url; ?>" target="_blank"><span class="material-icons"><?php echo $intranet_apiext_application_icone;?></span> <?php echo $intranet_apiext_nom; ?></a>
              <span class="tooltip"><span class="material-icons"> info
                <span class="tooltiptext"><?php echo $intranet_apiext_application_description; ?></span>
              </span>
            </h3>
            
        </div><!-- .entry-content -->
    </div>
  </article><!-- #post-->
<?php
}
/*************** */
// display apiext 2  
function sedoo_wpthch_intranet_apiext_display2($intranet_apiext_nom, $intranet_apiext_application_description, $intranet_apiext_application_categorie, $intranet_apiext_url, $intranet_apiext_application_icone ) {
  ?>
  <article>
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
    <div class="entry-content">
        <a href="<?php echo $intranet_apiext_url; ?>" target="_blank"><span class="material-icons"><?php echo $intranet_apiext_application_icone;?></span> <?php echo $intranet_apiext_nom; ?></a>
          <span class="tooltip"><span class="material-icons"> info
            <span class="tooltiptext"><?php echo $intranet_apiext_application_description; ?></span>
          </span>
        
    </div><!-- .entry-content -->
  </article><!-- #post-->
<?php
}
// list apiext
function sedoo_wpthch_intranet_apiext_list($categoryTermID) {
  // $restrict=FALSE; //set default, update if $intranet_apiext_application_restrict

  while( have_rows('intranet_apiext', 'option') ) : the_row();
    $restrict=FALSE; //set default, update if $intranet_apiext_application_restrict
    // Load sub field value.
    $intranet_apiext_nom= get_sub_field('intranet_apiext_application_nom');
    $intranet_apiext_application_description= get_sub_field('intranet_apiext_application_description');
    $intranet_apiext_url= get_sub_field('intranet_apiext_application_url');
    $intranet_apiext_application_categorie= get_sub_field('intranet_apiext_application_categorie');
    if (get_sub_field('intranet_apiext_application_icone')) {
      $intranet_apiext_application_icone= get_sub_field('intranet_apiext_application_icone');
    }
    
    $intranet_apiext_application_restrict= get_sub_field('intranet_apiext_application_restrict');
    if ($intranet_apiext_application_restrict) {
      $intranet_apiext_application_group= get_sub_field('intranet_apiext_application_group');
      $restrict = sedoo_wpthch_intranet_get_restrict_value($intranet_apiext_application_group);
    }

    $get_term_value=array();
    if ( ! empty( $intranet_apiext_application_categorie ) ) {
      foreach ($intranet_apiext_application_categorie as $apiext_category) {
        array_push($get_term_value, $apiext_category->term_id, $apiext_category->parent);
      }
    }
    
    // if ($categoryTermID!=="none") {
    if ((in_array($categoryTermID, $get_term_value)) && ($categoryTermID!=="none")) {
      // display
      if (!$restrict) {
        sedoo_wpthch_intranet_apiext_display2($intranet_apiext_nom, $intranet_apiext_application_description, $intranet_apiext_application_categorie, $intranet_apiext_url, $intranet_apiext_application_icone );
      }
        
    }
    // }
    // else {
    //   sedoo_wpthch_intranet_apiext_display2($intranet_apiext_nom, $intranet_apiext_application_description, $intranet_apiext_application_categorie, $intranet_apiext_url, $intranet_apiext_application_icone ); 
    // }

  endwhile;
}

/************
 *  login Form
 */
function sedoo_wpthch_intranet_login_form($id, $className) {
    ?>
    <section id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?>">
      <div class="h3">
        <span class="material-icons">login</span> Authentification
      </div>
        <!-- <h3><span class="material-icons">login</span> <span>Authentification</span></h3> -->
        <p>Pour accéder à plus de contenus, veuillez vous authentifier avec vos identifiants OMP</p>
        <div>
        <?php
            wp_login_form();
        ?>
            <a href="https://socle.obs-mip.fr" target="_blank"> Mot de passe oublié<br>Récupérer mes identifiants OMP</a>
        </div>
    </section>
  <?php 
}

/*********** 
 *  Get Restricted value
 */
function sedoo_wpthch_intranet_get_restrict_value($fieldGroup) {
  $restrict=TRUE;
  ////////   CHECK CURRENT USER / If restrict group 
  // check current user group_id, show only api with same group_id
  global $wpdb;
  if ( is_user_logged_in() ) {
    $current_user_results = $wpdb->get_results(
      "
      SELECT group_id 
      FROM {$wpdb->prefix}groups_user_group
      WHERE user_id = '".get_current_user_id()."'
      "
    ) or die(mysql_error());
    $current_user_group_ID = array();
    
    foreach ($current_user_results as $current_user_result) {
      // var_dump($current_user_result);
      if (($current_user_result->group_id == $fieldGroup) || ( current_user_can( 'setup_network' ) )) {
        // user group is same as apiext_group at least one time
        $restrict=FALSE;
      }
    }
  }
  return $restrict;
}

/*********** 
 *  Get post group
 */

function sedoo_wpthch_intranet_get_group($postID) {

  $labo = array(
    '1' => 'OMP',
    '2' => 'IRAP',
    '3' => 'UAR831',
    '4' => 'CESBIO',
    '5' => 'GET',
    '6' => 'LAERO',
    '7' => 'LEGOS',
    '9' => 'LEFE',
    '10' => 'RESTRICT',
  );

  $groups = get_post_meta($postID, 'groups-read');

  if ($groups) {
    ?>
    <div class="groupID">
      <span class="material-icons">lock</span>
    <?php
    foreach ($groups as $group) {
      ?>
      <span><?php echo $labo[$group];?></span>
    <?php
    }
    ?>
    </div>
  <?php
  }
}

?>