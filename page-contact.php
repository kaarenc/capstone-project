<?php
/**
 * The template for displaying the contact page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Fitness
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php

		get_template_part( 'template-parts/content', 'page' );
		
		while ( have_posts() ) :

			the_post();

			if ( function_exists ( 'get_field' ) ) :
                
                echo do_shortcode('[wpforms id="94"]');
                    
				echo '<div class="infoWrapper">';

					if ( get_field( 'phone_number' ) ) {
						echo '<div>';
							echo '<h3>';
								the_field('phone_number');
							echo '</h3>';
						echo '</div>';
							
					}
					
					if ( get_field( 'email_address' ) ) {
						echo '<div>';
							echo '<h3>';
								the_field('email_address');	
							echo '</h3>';
						echo '</div>';
						
					}

					if ( get_field( 'address' ) ) {
						echo '<div>';
							echo '<h3>';
								the_field('address');	
							echo '</h3>';
						echo '</div>';
						
					}

				echo '</div>';

 
                if ( is_active_sidebar( 'custom-map-widget' )) : ?>
                		<div id="contact-map-area" class="cmw-widget-area widget-area" role="complementary">
                    		<?php dynamic_sidebar( 'custom-map-widget' ); ?>
                        </div>
        			<?php
				endif;
			endif;

			echo do_shortcode('[instagram-feed user="bcitfitness"]');

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php

get_footer();