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

	<!-- add map to footer -->
	<?php
if ( is_active_sidebar( 'custom-footer-widget' ) && is_page( 29 ) === false) : ?>
	 <div id="footer-footer-area" class="cfw-widget-area widget-area" role="complementary">
	 <?php dynamic_sidebar( 'custom-footer-widget' ); ?>
	 </div>
	  
 <?php endif; ?>
			<nav id = "footer-navigation" class="footer-navigation">
				<?php
				wp_nav_menu(array('theme_location' => 'footer'));
		
				?>
			</nav>
		
 
 
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
