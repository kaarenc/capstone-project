<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package FWD_Fitness
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
			</header><!-- .page-header -->

			<div class="page-content">

			<p class="whoops"><?php esc_html_e( 'Woops!', 'fwd-fitness' ); ?></p>

			<p class="four-description"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below?', 'fwd-fitness' ); ?></p>
			
			<div class="four-container">
					<p class="four"> 4 
					<?php the_custom_logo(); ?>
					4</p>
						
			</div>

				
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
