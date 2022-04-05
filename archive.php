<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package labs_by_Sedoo
 */

get_header();   

// get the current taxonomy term
$term = get_queried_object();
$termchildren = get_term_children( $term->term_id, $term->taxonomy );

$code_color=labs_by_sedoo_main_color();
if (( function_exists( 'get_field' ) ) && (get_field('tax_layout', $term))) {
	$tax_layout = get_field('tax_layout', $term);
} else {
	$tax_layout="grid";
}
$cover = get_field( 'tax_image', $term);
$no_result_text = get_field('no_results_text_tax');	
$affichage_portfolio = get_field('sedoo_affichage_en_portfolio', $term);

?>

	<div id="content-area" class="wrapper archives">
		<main id="main" class="site-main">
		<?php
		if ( !empty($cover)) {
				$coverStyle = "background-image:url(".$cover['url'].")";
			?>
			
			<header id="cover" class="page-header" style="<?php echo $coverStyle;?>;animation: cover_homepage 2s linear 1 alternate;">
				
			</header><!-- .page-header -->
			<?php
			}
			?>	
			<h1 class="page-title">
				<?php
				if ($term) {
					single_cat_title('', true);
				} else {
					the_archive_title(); 
				}?>
			</h1>
			<div class="sedoo-intranet-page">
				<section data-role="sedoo-intranet-page-content">
					<?php
					if ($termchildren) {
					?>
					<nav id="subterms">
						<ul>
						
						<?php					
						foreach ( $termchildren as $child ) {
							$childTerm = get_term_by( 'id', $child, $term->taxonomy );
							if ($childTerm->count > 0) {
							echo '<li class="tag"><a href="' . get_term_link( $child, $term->taxonomy ) . '">' . $childTerm->name .' ('. $childTerm->count .')</a></li>';
							}
						}
						?> 
						</ul>
					</nav>
					<?php
					}

					?>
					
				<?php
				if (get_the_archive_description()) {
					the_archive_description( '<div class="archive-description">', '</div>' );
				}
				?>
				<?php
		
				if($affichage_portfolio != true) { // if portfolio then display it, if not just do the normal script
					/**
					 * WP_Query pour lister tous les types de posts
					 */
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

					if ($term) {				
					/* sedoo_wpth_labs_get_queried_content_arguments(post_types, taxonomy, slug, display, paged) */
					sedoo_wpth_labs_get_queried_content_arguments(array('any'), $term->taxonomy, $term->slug, $tax_layout, $paged);
					}
					else {
						// Case for archive by month (back to default wordpress config)
						if ( have_posts() ) {
						?>
						<section role="listNews" class="post-wrapper noimage">
						<?php
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content', 'grid-noimage' );
							?>
							<?php
							endwhile; // End of the loop.
							?>
						<?php
						} 
					}

				} else {
					?>
					<script>
						ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
					</script>
					<style>
						.sedoo_port_action_btn li:hover {
							background-color: <?php echo $code_color; ?> !important;
						}

						.sedoo_port_action_btn li.active {
							background-color: <?php echo $code_color; ?> !important;
						}
					</style>
					<?php 
					
					archive_do_portfolio_display($term);
				}
			
			?>
				</section> 
				<aside id="accordionGroup" class="Accordion contextual-sidebar" data-allow-multiple>
					<?php
					/////////////   CONTACTS    ////////////
					if( have_rows('intranet_service', 'option') ) {
						?>
						<section id="contact">
						<?php
						ob_start(); // création d'un buffer
						sedoo_wpthch_intranet_contact_list($term->slug);
						$content = ob_get_contents();
						ob_end_clean(); //Stops saving things and discards whatever was saved

						sedoo_wpthch_intranet_simple_panel('Contacts', 'false', 'Contacts', 'contacts',  $description, $content);
						?>
						</section>
					<?php
					}
					?>

					<section id="apiext" class="content-list" role="listNews">
					<?php
					/////////////   Applications externes    ////////////
					ob_start(); // création d'un buffer
					sedoo_wpthch_intranet_apiext_list($term->term_id);
					$content = ob_get_contents();
					ob_end_clean(); //Stops saving things and discards whatever was saved
					
					sedoo_wpthch_intranet_simple_panel('apiext', 'false', 'Applications', 'miscellaneous_services',  $description, $content);
					?>
					</section>
				</aside>

				<?php
				$baseFolder = get_field('intranet_taxo_root', 'category' . '_' . $term->term_id);
				if ( !empty($baseFolder)) {
				?>
				<section id="filetree">
					<?php
					/////////////   Applications externes    ////////////
					ob_start(); // création d'un buffer
					sedoo_wpthch_intranet_filetree_section($baseFolder);
					$content = ob_get_contents();
					ob_end_clean(); //Stops saving things and discards whatever was saved
					
					$title="Tous les fichiers de la catégorie ". $term->name;
					$description="<em>Ne concerne que les documents internes hors officiels des tutelles</em>";
					sedoo_wpthch_intranet_simple_panel('filetreemap', 'false', $title, 'account_tree',  $description, $content);
					?>
				</section>
				<?php
				}
				?>
			</div>
			
		
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();