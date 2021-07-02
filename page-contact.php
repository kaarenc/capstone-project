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
                
                echo do_shortcode('[wpforms id="94"]');
                    

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

				
                    echo do_shortcode('[instagram-feed user="bcitfitness"]');
                    
                    
                    
                    if ( is_active_sidebar( 'custom-map-widget' )) { ?>
                         <div id="contact-map-area" class="cmw-widget-area widget-area" role="complementary">
                         <?php dynamic_sidebar( 'custom-map-widget' ); ?>
                         </div>
        <?php
	}
endif;

			get_template_part( 'template-parts/content', 'page' );


		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php

get_footer();