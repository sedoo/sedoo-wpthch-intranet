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
					sedoo_wpthch_intranet_contact_section($term->slug);
					?>
					
				</aside>
				<section id="filetree">
					<h2>Tous les fichiers de la catégorie <?php echo $term->name;?></h2>
					<p><em>Ne concerne que les documents internes hors officiels des tutelles</em></p>
					<?php
					$baseFolder = get_field('intranet_taxo_root', 'category' . '_' . $term->term_id);

					sedoo_wpthch_intranet_filetree_section($baseFolder);
					?>
				</section>
			</div>
			
		
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();