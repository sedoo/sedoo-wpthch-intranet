<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package labs_by_Sedoo
 */

get_header();
?>

	<div id="primary" class="content-area wrapper">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<div class="page-content">

					<div class="sedoo_404">
						<h1>
							<span class="material-icons">dangerous</span>
						</h1>
						<h2>Vous n'avez pas les droits d'accès, ou la page n'existe pas</h2>
						<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
						<div class="wp-block-columns are-vertically-aligned-top is-layout-flex wp-container-core-columns-is-layout-1 wp-block-columns-is-layout-flex">
							<?php
							if(!is_user_logged_in()) {
								?>
							<div class="wp-block-column is-vertically-aligned-top is-layout-flow wp-block-column-is-layout-flow">
								<h3>Vous n'avez pas le droit d'y accéder, authentifiez-vous ci-dessous. </h3>
								<?php														
									sedoo_wpthch_intranet_login_form('login-form-404', 'login-form');
								?>
								
							</div>
							<?php
							}
							?>
							<div class="searchform_404 wp-block-column is-vertically-aligned-top is-layout-flow wp-block-column-is-layout-flow">
								<h3>La page n'existe pas, tentez une autre recherche.</h3>
								<?php 
								get_search_form();
								?>
								<div class="widget widget_categories">
									<h3 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'labs-by-sedoo' ); ?></h2>
									<ul>
										<?php
										wp_list_categories( array(
											'orderby'    => 'count',
											'order'      => 'DESC',
											'show_count' => 1,
											'title_li'   => '',
											'number'     => 10,
										) );
										?>
									</ul>
								</div>
							</div>
							
						</div>
					</div>
					<hr />
					<div class="row row_404">
                        
						
					</div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
