<?php
/**
 * The template for displaying the Front Page
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
		?>

		<section class="landing">
			<?php the_post_thumbnail(22); ?>

			<h1>Positively Fit</h1>

			<div class="cta-buttons"> 
				<?php
				
				if(function_exists('get_field')):
					$button = get_field('call_to_action_shop');

					if( $button ):?>

						<div class="button">
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
				endif;
					
					?>

				

					<?php 
					if(function_exists('get_field')):

						$button = get_field('call_to_action_contact');

						if( $button ):?>

							<div >
								<?php 
								$link = get_field('call_to_action_contact');
								if( $link ): 
									$link_url = $link['url'];
									$link_title = $link['title'];
									$link_target = $link['target'] ? $link['target'] : '_self';
									?>
									<a  href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">Shop Now</a>
								<?php endif; ?>
							</div>


						<?php
						endif;
					endif;
					
					?>
					</div>
		</section>

		<section class="home-intro">
				<?php
				if( function_exists('get_field')):?>
				
					<p><?php the_field('intro_message');?></p>

				<?php 
				endif;
				?>
				
				
		</section>

		<section class="featured-services">

				<?php
				if(function_exists('get_field')):
				
					$featured_posts = get_field('featured_services');	
					if( $featured_posts ): ?>
						<h2>Featured Services</h2>
						
							<?php foreach( $featured_posts as $post ): ?>
								<article>

								<?php setup_postdata($post); ?>
									
									<a href="<?php the_permalink(); ?>">
										<h3><?php the_title(); ?></h3>
			
										<?php the_post_thumbnail(''); ?>
	
									</a>

									<?php 
									the_excerpt();
									
									?>

								</article>
							<?php endforeach; ?>
						
						<?php 
						wp_reset_postdata(); ?>
					<?php endif; 

				endif;

				?>
		</section>



		<section class="featured-blog">
			<?php
			if(function_exists('get_field')):
				
				$featured_posts = get_field('featured_blog_posts');

				if( $featured_posts ): ?>

					<h2>Featured Blog Posts</h2>

					<?php echo do_shortcode('[smartslider3 slider="2"]'); ?>
							
					<?php wp_reset_postdata(); ?>

				<?php endif; ?>

			<?php endif; ?>
		</section>

		<section class="team-members">
			<?php

				if(function_exists('get_field')):

					$featured_posts = get_field('team_members');

					if( $featured_posts ): ?>

					<h2>Team Members</h2>

					<div class="all-staff-members">
						<?php foreach( $featured_posts as $post ): ?>
						<article>
							<?php setup_postdata($post); ?>

							<h3><a href="<?php echo get_post_type_archive_link( 'fit-staff' ); ?>"><?php the_title(); ?></a></h3>

							<?php the_post_thumbnail(''); ?>

						</article>
						<?php endforeach; ?>
					</div>
						
					<?php wp_reset_postdata(); ?>

					<?php endif; ?>

				<?php endif; ?>

				<?php 
				if(function_exists('get_field')):

					$team_members = get_field('all_team_members');

					if( $team_members):?>

						<div class="button">
							<a href="<?php the_field('all_team_members'); ?>">View all Team Members</a>
						</div>

					<?php
					endif;
				endif;
				?>
			</section>

			<?php	
			 echo do_shortcode('[instagram-feed user="bcitfitness" cols=4 num=8 showfollow=true followcolor=#0093B8 headercolor=#131315]');
			?>

			<?php
			$args = array(
				'post_type'      => 'fit-testimonial',
				'posts_per_page' => -1
			);

			$query = new WP_Query($args);

			if(function_exists('get_field')):

				if ($query->have_posts()) : ?>
					<section class="home-slider">
						<h2>Success Stories</h2>
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
			<?php wp_reset_postdata(); endif;
		endif; ?>

		<?php endwhile; ?>
	</main>

<?php
get_footer();