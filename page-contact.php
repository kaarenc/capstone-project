<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Fitness
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			if ( function_exists ( 'get_field' ) ) :

				echo '<h2>Contact Us</h2>';

				if ( get_field( 'phone_number' ) ) {
					echo '<h3>';
						the_field('phone_number');
					echo '</h3>';	
				}
				
				if ( get_field( 'email_address' ) ) {
					echo '<h3>';
						the_field('email_address');	
					echo '</h3>';
				}

				if ( get_field( 'address' ) ) {
					echo '<div>';
						the_field('address');	
					echo '</div>';
				}

				if (get_field('instagram')) :
					echo do_shortcode(get_field('instagram'));
				endif;
        
			endif;
				

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();