<?php
/**
 * The template for displaying the staff archive page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Fitness
 */

get_header();
?>

	<main id="primary" class="site-main">

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header>

			<?php

			$args = array(
				'post_type' => 'fit-staff',
				'posts_per_page' => -1,
			);

			$query = new WP_Query( $args );

			if( $query -> have_posts() ) :

				while ( $query -> have_posts() ) :
					$query -> the_post();

					if ( function_exists ( 'get_field' ) ) :

						if ( has_post_thumbnail() ) {
							the_post_thumbnail();	
						}

						if ( get_field( 'specialization_and_title' ) ) {
								the_field('specialization_and_title');	
						}

						if ( get_field( 'team_member_bio' ) ) {
							the_field('team_member_bio');	
						}

						if ( get_field( 'team_member_classes' ) ) {
							the_field('team_member_classes');	
						}
					endif;

				endwhile;
				wp_reset_postdata();

			endif;
			?>

	</main>

<?php
get_sidebar();
get_footer();