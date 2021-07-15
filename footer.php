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
				?>
				
					<a href="mailto:<?php the_field( 'email_address', 29 ); ?>">
						<?php the_field( 'email_address', 29 ); ?>
					</a>
				
				<?php
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
			<p>Website designed and developed by <a href="https://www.evanteichman.com/">Evan Teichman</a>, <a href="https://hunterpaulson.com/">Hunter Paulson</a>, <a href="https://kaarencorrigan.com/">Kaaren Corrigan</a> and <a href="https://ainsleymarsh.ca/">Ainsley Marsh</a>.</p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
