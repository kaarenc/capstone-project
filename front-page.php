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

		<section class="home-intro">
			<?php
			while ( have_posts() ) :
				the_post(); ?>

				<!-- Home ACF -->
				<!-- Output the intro message -->
				<p><?php the_field('intro_message');?></p>
		</section>
			<!-- Output the featured services -->
			<section class="featured-services">
				<?php
				$featured_posts = get_field('featured_services');
				if( $featured_posts ): ?>
					<h2>Featured Services</h2>
					<div>
					<?php foreach( $featured_posts as $post ): 

						// Setup this post for WP functions (variable must be named $post).
						setup_postdata($post); ?>
							
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
								<!-- change size of photo here?? -->
								<?php the_post_thumbnail(''); ?>
							</a>
							
							
						
					<?php endforeach; ?>
					</div>
					<?php 
					// Reset the global post object so that the rest of the page works correctly.
					wp_reset_postdata(); ?>
				<?php endif; ?>
			</section>

			<section class="featured-blog">
				<!-- Output the featured blog posts -->
				<?php
				$featured_posts = get_field('featured_blog_posts');
				if( $featured_posts ): ?>
				<h2>Featured Blog Posts</h2>
					<!-- <ul> -->
					<div>
					<?php foreach( $featured_posts as $post ): 

						// Setup this post for WP functions (variable must be named $post).
						setup_postdata($post); ?>
						<!-- <li> -->
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
								<!-- change size of photo here?? -->
								<?php the_post_thumbnail(''); ?>
							</a>
						<!-- </li> -->
					<?php endforeach; ?>
					<!-- </ul> -->
					</div>
					<?php 
					// Reset the global post object so that the rest of the page works correctly.
					wp_reset_postdata(); ?>
				<?php endif; ?>
			</section>


			<section class="team-members">
				<!-- Output the featured blog posts -->
				<?php
				$featured_posts = get_field('team_members');
				if( $featured_posts ): ?>
				<h2>Team Members</h2>
					<!-- <ul> -->
					<div>
					<?php foreach( $featured_posts as $post ): 

						// Setup this post for WP functions (variable must be named $post).
						setup_postdata($post); ?>
						<!-- <li> -->
							
							<?php the_title(); ?>
							<!-- change size of photo here?? -->
							<?php the_post_thumbnail(''); ?>
							
						<!-- </li> -->
					<?php endforeach; ?>
					<!-- </ul> -->
					</div>
					<?php 
					// Reset the global post object so that the rest of the page works correctly.
					wp_reset_postdata(); ?>
				<?php endif; ?>

				<div class="button">
					<!-- output the call to action link--shop -->
					<!-- ask jonathin about this!! -->
					<a href="<?php the_field('all_team_members'); ?>">View all Team Members</a>
				</div>

			</section>

			<div class="button">
				<!-- output the call to action link--shop -->
				<?php 
				$link = get_field('call_to_action_shop');
				if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>
			</div>


			<div class="button">
			<!-- output the call to action link--contact -->
				<?php 
				$link = get_field('call_to_action_contact');
				if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>
			</div>

			<?php
			if ( get_field('instagram') ) {
				echo do_shortcode( get_field('instagram') );
			}		

			?>


			<!-- not sure if the code below is needed -->
			<?php
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;?>
			<!-- not sure if the code above is needed -->
			<?php






		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
