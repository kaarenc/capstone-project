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
				the_post(); ?>

		<section class="home-intro">
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
					<article>
						<?php foreach( $featured_posts as $post ): 

							// Setup this post for WP functions (variable must be named $post).
							setup_postdata($post); ?>
								
								<a href="<?php the_permalink(); ?>">
									<h3><?php the_title(); ?></h3>
									<!-- change size of photo here?? -->
									<?php the_post_thumbnail(''); ?>
								</a>
						<?php endforeach; ?>
					</article>
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

					<article>
					<?php foreach( $featured_posts as $post ): 
						// Setup this post for WP functions (variable must be named $post).
						setup_postdata($post); ?>
							<a href="<?php the_permalink(); ?>">
								<h3><?php the_title(); ?></h3>
								<!-- change size of photo here?? -->
								<?php the_post_thumbnail(''); ?>
							</a>
					<?php endforeach; ?>
					</article>
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
					<article>
					<?php foreach( $featured_posts as $post ): 
						// Setup this post for WP functions (variable must be named $post).
						setup_postdata($post); ?>

							<h3><?php the_title(); ?></h3>
							<!-- change size of photo here?? -->
							<?php the_post_thumbnail(''); ?>

					<?php endforeach; ?>

					</article>
					<?php 
					// Reset the global post object so that the rest of the page works correctly.
					wp_reset_postdata(); ?>
				<?php endif; ?>


				<?php 
				$team_members = get_field('all_team_members');

				if( $team_members):?>

					<div class="button">
						<!-- output the call to action link--shop -->
						<!-- ask jonathin about this!! -->
						<a href="<?php the_field('all_team_members'); ?>">View all Team Members</a>
					</div>

				<?php
				endif;
				?>

				

			</section>

			<?php 
				$button = get_field('call_to_action_shop');

				if( $button ):?>

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


				<?php
				endif;
				?>

			

				<?php 

				$button = get_field('call_to_action_contact');

				if( $button ):?>

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
				endif;
				?>
	

			<!-- Output the instagram grid -->
			<?php
			if ( get_field('instagram') ) :
				echo do_shortcode( get_field('instagram') );
			endif;	
			?>


			<!-- Output the custom testimonial slider -->
			<?php
			$args = array(
				'post_type'      => 'fit-testimonial',
				'posts_per_page' => -1
			);

			$query = new WP_Query($args);

			if ($query->have_posts()) : ?>
				<section class="home-slider">
					<h2>Testimonials</h2>
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<?php while ($query->have_posts()) : $query->the_post(); ?>
								<div class="swiper-slide">
									<h3><?php the_title()?></h3>
									<?php the_field('testimonial_content'); ?>
									<p><?php the_field('author') ?></p>
								</div>
							<?php endwhile; ?>
						</div>
						<div class="swiper-pagination"></div>
						<div class="swiper-button-prev"></div>
						<div class="swiper-button-next"></div>
					</div>
				</section>
		<?php
			wp_reset_postdata();
		endif;
		?>

		<?php

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
