<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FWD_Fitness
 */

?>

	<footer id="colophon" class="site-footer">

	<?php

	if ( function_exists ( 'get_field' ) ) :
					
		echo '<div class="infoWrapperFooter">';

			if ( get_field( 'phone_number', 29 ) ) {
				
					echo '<p>';
						the_field('phone_number', 29);
					echo '</p>';
				
					
			}
			
			if ( get_field( 'email_address', 29 ) ) {
				
					echo '<p>';
						the_field('email_address', 29);	
					echo '</p>';
				
				
			}

		echo '</div>';

	endif; ?>

		<nav id = "footer-navigation" class="footer-navigation">
			<?php wp_nav_menu(array('theme_location' => 'footer')); ?>
		</nav>

	<?php

	if( is_page(29) ==false ){

		//the code is same as the contact page code except I added page ID of 29 which is the contact page ID.
		//adding google map to footer

		$location = get_field('map', 29);
		if( $location ): ?>
			<div class="acf-map acf-map-footer" data-zoom="16">
				<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
			</div>
		<?php endif; 
	}
	?>
	  
 
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'fwd-fitness' ) ); ?>">
				<?php

				
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'fwd-fitness' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'fwd-fitness' ), 'fwd-fitness', '<a href="https://fitness.bcitwebdeveloper.ca">FWD27</a>' );
				?>


		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
