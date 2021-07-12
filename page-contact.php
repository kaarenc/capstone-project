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
                
                echo do_shortcode('[wpforms id="390" title="false"]');
                    
				echo '<div class="infoWrapper">';

					if ( get_field( 'phone_number' ) ) {
						echo '<div>';
							echo '<h3>';
								the_field('phone_number');
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
					
					if ( get_field( 'email_address' ) ) {
						echo '<div>';
							echo '<h3>';
								the_field('email_address');	
							echo '</h3>';
						echo '</div>';
						
					}

				echo '</div>';

				$location = get_field('map');
				if( $location ): ?>
					<div class="acf-map" data-zoom="16">
						<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
					</div>
				<?php endif;
                
			endif;

			echo do_shortcode('[instagram-feed num=4 user="bcitfitness"]');

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php

get_footer();