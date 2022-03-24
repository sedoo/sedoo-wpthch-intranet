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
					/////////


					////////

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
				<aside class="contextual-sidebar">
					<section id="contact">
					<?php
					if( have_rows('intranet_service', 'option') ) {
						while( have_rows('intranet_service', 'option') ) : the_row();
							// Load sub field value.
							$serviceCategory = get_sub_field('intranet_service_categorie');
							// echo $serviceCategory->slug ."=".$term->slug;
							// var_dump($serviceCategory);
							foreach ($serviceCategory as $service) {
								if ($service->slug === $term->slug) {	
									$intranet_service_nom= get_sub_field('intranet_service_nom');
									$intranet_service_mail= get_sub_field('intranet_service_mail');
									$intranet_service_gestionnaires= get_sub_field('intranet_service_gestionnaires');
									echo "<h2>".$intranet_service_nom ."</h2>".
									"<h3>Adresse générique de contact</h3>".
									"<p>".$intranet_service_mail."</p>";
									if ($intranet_service_gestionnaires) {
									echo "<h3>Vos gestionnaires</h3>";
									echo "<ul id=\"gestionnaires\">";
										foreach ($intranet_service_gestionnaires as $gestionnaire) {
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
									}
									echo "</ul>";
									
								}
							}
						endwhile;
					
					// No value.
					}
					else {
						?>
						<p>Aucune adresse de contact actuellement</p>
						<?php
					}
					?>
					</section>
					<section>
						<h2>Arborescence</h2>
						<?php
						$baseFolder = get_field('intranet_taxo_root', 'category' . '_' . $term->term_id);
						?>
						<script src="https://services.aeris-data.fr/cdn/jsrepo/v1_0/download/sandbox/release/sedoocampaigns/0.1.0"></script>
						<campaign-product viewer="tree" service="https://api.sedoo.fr/intranet-omp-service-rest/data/v1_0" campaign="intranetomp" base-folder="<?php echo $baseFolder;?>" product="intranet-filetree">
						</campaign-product>
					</section>
				</aside>
			</div>
			
		
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();