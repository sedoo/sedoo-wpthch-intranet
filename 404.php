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
						<h1>404</h1>
						<p>Soit la page n'existe pas, tentez une autre recherche.</p>
                        <p>Soit vous n'avez pas le droit d'y accéder, authentifiez-vous ci-dessous. </p>
						<div class="searchform_404">
							<?php 
                            get_search_form();
                            ?>
                            <hr />
                            <?php
                            if(!is_user_logged_in()) {
                                sedoo_wpthch_intranet_login_form('login-form-404', 'login-form');
                            }
							?>
						</div>
					</div>
					<hr />
					<div class="row row_404">
                        <div class="widget widget_categories">
							<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'labs-by-sedoo' ); ?></h2>
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
						</div><!-- .widget -->
						<?php
						the_widget( 'WP_Widget_Recent_Posts' );
						?>
						
					</div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
