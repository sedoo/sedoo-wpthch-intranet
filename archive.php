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

// get query string for orderby request
global $wp;
$current_url=home_url( $wp->request );
if (array_key_exists('orderby', $_GET)) {
	$orderby = esc_html($_GET['orderby']);
	$sort = esc_html($_GET['sort']);
	if(($orderby == "title")&&($sort == "ASC")) {
		echo "<h1>1- Before : ".$sort."</h1>";
		$newsort = "DESC";
		echo "<h1>after :  ".$newsort."</h1>";
	} elseif(($orderby == "title")&&($sort == "DESC")) {
		echo "<h1>3- Before : ".$sort."</h1>";
		$newsort = "ASC";
		echo "<h1>after :  ".$newsort."</h1>";
	} elseif(($orderby == "date")&&($sort == "ASC")) {
		echo "<h1>3- Before : ".$sort."</h1>";
		$newsort = "DESC";
		echo "<h1>after :  ".$newsort."</h1>";
	} elseif(($orderby == "date")&&($sort == "DESC")) {
		echo "<h1>3- Before : ".$sort."</h1>";
		$newsort = "ASC";
		echo "<h1>after :  ".$newsort."</h1>";
	}
	$sort = $newsort;
	echo "<h1>Final :".$sort."</h1>";
} else {
	$orderby = "title";
	$sort = "ASC";
}
$code_color=labs_by_sedoo_main_color();
if (( function_exists( 'get_field' ) ) && (get_field('tax_layout', $term))) {
	$tax_layout = get_field('tax_layout', $term);
} else {
	$tax_layout="content-list";
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
			<div class="sedoo-intranet-page">
				<section data-role="sedoo-intranet-page-content">
								
					<?php
					if (get_the_archive_description()) {
						the_archive_description( '<div class="archive-description">', '</div>' );
					}
					?>
					<nav id="sort-options">
						<div>
							<span class="tooltip">
								<a href="<?php echo $current_url."?orderby=title&sort=".$sort;?>" title="Classer par ordre Alphabétique">
									<span class="material-icons">
										sort_by_alpha<span class="tooltiptext tooltiptop">Classer par ordre Alphabétique</span>
									</span>
								</a> 
							</span>
							<span class="tooltip">
								<a href="<?php echo $current_url."?orderby=date&sort=".$sort;;?>" title="Classer par date de publication">
									<span class="material-icons">
										schedule<span class="tooltiptext tooltiptop">Classer par date de publication</span>
									</span>
								</a>
							</span>
						</div>
					</nav>
					<?php
					/**
					 * WP_Query pour lister tous les types de posts
					 */
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

					if ($term) {				
					/* sedoo_wpth_labs_get_queried_content_arguments(post_types, taxonomy, slug, display, paged) */
					//sedoo_wpth_labs_get_queried_content_arguments(array('page'), $term->taxonomy, $term->slug, $tax_layout, $paged);
					
					$args = array(
						'post_type'             => array('page'),
						'post_status'           => array( 'publish', 'private' ),
						'posts_per_page'        => -1,            // -1 pour liste sans limite
						'paged'					=> $paged,
						'orderby'				=> $orderby,
						'order'					=> $sort,
						// 'post__not_in'          => array($postID),    //exclu le post courant
						'tax_query' => array(
							array(
								'taxonomy' => $term->taxonomy,
								'field'    => 'slug',
								'terms'    => $term->slug,
							),
						),
						'meta_query' => array(
							array(
								'relation' => 'AND',
								array(
									'key' => 'intranet_hide_in_listing',
									'compare' => 'EXISTS',
								),
								array(
									'key'     => 'intranet_hide_in_listing',
									'value'   => '1',
									'compare' => 'NOT LIKE',
								),
							),
						),
						'meta_query' => array(
							'relation' => 'OR',
							array(
								'key' => 'intranet_hide_in_listing',
								'compare' => 'NOT EXISTS',
							),
							array(
								'relation' => 'AND',
								array(
									'key' => 'intranet_hide_in_listing',
									'compare' => 'EXISTS',
								),
								array(
									'key'     => 'intranet_hide_in_listing',
									'value'   => '1',
									'compare' => 'NOT LIKE',
								),
							),
						),
					);
					sedoo_wpth_labs_get_queried_content($tax_layout, $args);

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
					?>
				</section> 
				<aside id="accordionGroup" class="Accordion contextual-sidebar" data-allow-multiple>
					<?php
					$description=""; // init description
					if ( is_user_logged_in() ) {
						/////////////   CONTACTS    ////////////
						sedoo_wpthch_intranet_contacts($term->slug, $description);

					} else {
						sedoo_wpthch_intranet_login_form('login-form-404', 'login-form');
					}
					?>
					<?php
					if( have_rows('intranet_apiext', 'option') ) {
						if (sedoo_wpthch_intranet_dataOption_exist('intranet_apiext', 'intranet_apiext_application_categorie', $term->term_id)) {
						?>
						<section id="relatedApiext" class="content-list" role="listNews">
						<?php
						/////////////   Applications externes    ////////////
						ob_start(); // création d'un buffer
						sedoo_wpthch_intranet_apiext_list($term->term_id);
						$content = ob_get_contents();
						ob_end_clean(); //Stops saving things and discards whatever was saved
						
						sedoo_wpthch_intranet_simple_panel('apiext', 'false', 'Applications', 'miscellaneous_services',  $description, $content);
						?>
						</section>
						<?php
						}
					}
					?>
					<?php
					/////////////   Arborescence de fichiers de la catégorie    ////////////
					$baseFolder = str_replace("https://fb2.sedoo.fr/files/", "", get_field('intranet_taxo_root', 'category' . '_' . $term->term_id));
					if ( (!empty($baseFolder)) && ( is_user_logged_in() )) {
					?>
						<section id="relatedApiext" class="content-list" role="listNews">
						<?php
						
						ob_start(); // création d'un buffer
						sedoo_wpthch_intranet_filetree_section($baseFolder);

						$content = ob_get_contents();
						ob_end_clean(); //Stops saving things and discards whatever was saved
						
						$title="Fichiers de la catégorie ". $term->name;
						$description="<em>Ne concerne que les documents internes hors officiels des tutelles</em>";
						sedoo_wpthch_intranet_simple_panel('filetreemap', 'false', $title, 'account_tree',  $description, $content);
						?>
						</section>
					<?php
					}
					?>
				</aside>
				<div id="taxoNews">
				<?php
				$args = array(
					'post_type'             => 'post',
					'post_status'           => array( 'publish' ),
					'posts_per_page'        => '4',     
					// 'post__not_in'          => array(get_the_ID()), 
					'orderby'               => 'date',
					'order'                 => 'DESC',
					'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'field'    => 'slug',
							'terms'    => $term->slug,
						),
					),
				);
				$postsList = get_posts ($args);
		
				if ($postsList){       
				?>
				<h2>Actus de la catégorie <?php echo $term->name;?></h2>
				<section role="listNews" class="post-wrapper">
					
					<?php

					foreach ($postsList as $post) :
					setup_postdata( $post );
						?>
						<?php
						get_template_part( 'template-parts/content', 'grid' );
						?>
						<?php
					endforeach;
					?>	
				</section>

				<?php
				} else {
					// no posts found
				}
				/* Restore original Post Data */
				wp_reset_postdata();
				?>     
				</div>
				
			</div>
			
		
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();