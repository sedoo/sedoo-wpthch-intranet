<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package labs_by_Sedoo
 */

// ACF fields Sigle contact
// $contact_name = get_field('intranet_contact_name');

// Taxonomy terms for application
// $instances = get_the_terms( get_the_ID(), $taxo_names_instance );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
    <section class="sedoo-intranet-page">
        <?php 
            $product = get_field('id'); // get product id and name
            $breadcrumb = get_field('name'); // get product id and name
            $type_produit = get_field('type');

            $campaign = get_field('nom_de_la_campagne', 'option');   

            // get service url and package url from option page
            while( have_rows('field_6056902922fe1', 'option') ) : the_row();
            if(get_sub_field('type_de_produit') == $type_produit) {
                $service_url = get_sub_field('url_du_service');
                $package_url = get_sub_field('url_du_package');
            }
            endwhile;

        ?>
        <h1> <?php echo get_the_title(); ?> </h1>
        <?php
        if ( ! post_password_required() ) {
        ?>
        <div class="tabs">
            <nav role="tablist" aria-label="Description et informations">

                <button role="tab" aria-selected="true" aria-controls="intranet-page-content" id="tab-1" tabindex="0">
                    Informations
                </button>
                <button role="tab" aria-selected="false" aria-controls="intranet-contacts" id="tab-2" tabindex="-1">
                    Contacts
                </button>
                <button role="tab" aria-selected="false" aria-controls="intranet-page-files" id="tab-3" tabindex="-1">
                    Documents
                </button>
                
            </nav>
            <section id="intranet-page-content" role="tabpanel" tabindex="0" aria-labelledby="tab-1">
                <?php the_content() ?>
            </section>
            <section id="intranet-contacts" role="tabpanel" tabindex="0" aria-labelledby="tab-2" hidden>
                <p>Contact</p>
            </section>
            <section id="intranet-page-files" role="tabpanel" tabindex="0" aria-labelledby="tab-3" hidden>
                <p>File</p>
            </section>
            
        </div>
        <?php
        // if ( ! post_password_required() ) {
        ?>
        
        <?php
        } else {
            the_content();
        }
        ?>
    </section> 
</article>
<script>

/**
 *  TABS ON FRONT
 */
/*
 *   This content is licensed according to the W3C Software License at
 *   https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document
 */
window.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('[role="tab"]');
    const tabList = document.querySelector('[role="tablist"]');
    console.log("YOOO");
    // Add a click event handler to each tab
    tabs.forEach(tab => {
      tab.addEventListener('click', changeTabs);
    });
  
    // Enable arrow navigation between tabs in the tab list
    let tabFocus = 0;
  
    tabList.addEventListener('keydown', e => {
      // Move right
      if (e.keyCode === 39 || e.keyCode === 37) {
        tabs[tabFocus].setAttribute('tabindex', -1);
        if (e.keyCode === 39) {
          tabFocus++;
          // If we're at the end, go to the start
          if (tabFocus >= tabs.length) {
            tabFocus = 0;
          }
          // Move left
        } else if (e.keyCode === 37) {
          tabFocus--;
          // If we're at the start, move to the end
          if (tabFocus < 0) {
            tabFocus = tabs.length - 1;
          }
        }
  
        tabs[tabFocus].setAttribute('tabindex', 0);
        tabs[tabFocus].focus();
      }
    });
  });
  
  function changeTabs(e) {
    const target = e.target;
    const parent = target.parentNode;
    const grandparent = parent.parentNode;
  
    // Remove all current selected tabs
    parent
      .querySelectorAll('[aria-selected="true"]')
      .forEach(t => t.setAttribute('aria-selected', false));
  
    // Set this tab as selected
    target.setAttribute('aria-selected', true);
  
    // Hide all tab panels
    grandparent
      .querySelectorAll('[role="tabpanel"]')
      .forEach(p => p.setAttribute('hidden', true));
  
    // Show the selected panel
    grandparent.parentNode
      .querySelector(`#${target.getAttribute('aria-controls')}`)
      .removeAttribute('hidden');
  }
</script>