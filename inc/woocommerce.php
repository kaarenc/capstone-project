<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package FWD_Fitness
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function fwd_fitness_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 1000,
			'single_image_width'    => 1000,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);

}
add_action( 'after_setup_theme', 'fwd_fitness_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function fwd_fitness_woocommerce_scripts() {
	wp_enqueue_style( 'fwd-fitness-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'fwd-fitness-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'fwd_fitness_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function fwd_fitness_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'fwd_fitness_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function fwd_fitness_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'fwd_fitness_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'fwd_fitness_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function fwd_fitness_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'fwd_fitness_woocommerce_wrapper_before' );

if ( ! function_exists( 'fwd_fitness_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function fwd_fitness_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'fwd_fitness_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'fwd_fitness_woocommerce_header_cart' ) ) {
			fwd_fitness_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'fwd_fitness_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function fwd_fitness_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		fwd_fitness_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'fwd_fitness_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'fwd_fitness_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function fwd_fitness_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'fwd-fitness' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'fwd-fitness' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'fwd_fitness_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function fwd_fitness_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php fwd_fitness_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}





// ----------------------------------------------------------------
// PRODUCTS FUNCTIONS
// ----------------------------------------------------------------
// -------------------------------------------------
// REMOVING ELEMENTS FROM THE SINGLE PRODUCT PAGE
// -------------------------------------------------



// Remove breadcrumbs
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// Remove title
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

// Remove price field
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

// Remove meta data of product
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// Remove additional information field
remove_action( 'woocommerce_product_additional_information', 'wc_display_product_attributes', 10 );

// Remove quantity box
function custom_remove_all_quantity_fields( $return, $product ) {return true;}
add_filter( 'woocommerce_is_sold_individually','custom_remove_all_quantity_fields', 10, 2 );

// Remove Tabs
add_filter( 'woocommerce_product_tabs', 'remove_product_tabs', 9999 );

function remove_product_tabs( $tabs ) {
  unset( $tabs['additional_information'] );
  return $tabs;
}

// Remove description tab
add_filter( 'woocommerce_product_tabs', 'sd_remove_product_tabs', 98 );
function sd_remove_product_tabs( $tabs ) {
    unset( $tabs['description'] );
    return $tabs;
}

// Remove review gravatar 
remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );

// Remove related products 
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// remove rating
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

// Remove Sidebar
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// Remove product summary
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

function woocommerce_template_single_excerpt() {
        return;
}

// Add Title
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 10 );

// Add description field
add_action( 'woocommerce_single_product_summary', 'custom_description_field', 15 );
  
function custom_description_field() { ?>
 
<?php 
if(function_exists('get_field')){

if(get_field('service_description')) { ?>
	<p class="service-description"><?php the_field('service_description'); ?></p>
<?php }
}
}

// -----------------------------------------------------------------------------
// ADDING ELEMENTS AND CTA FIELDS TO INDIVIDUAL SERVICES PAGE
// add CTA field
// ----------------------------------------------------------------------------  

// Contact page CTA field
function custom_cta_field() { 

if(function_exists('get_field')){

$contact = get_field('services_call_to_action');
if($contact) { 
$contact_url = $contact['url'];
?>
<div class="contact-cta">
<a class="call-to-action" href="<?php echo esc_url( $contact_url ); ?>">Contact Us</a></div>
<?php }

}}

// Add instructors field
add_action( 'woocommerce_single_product_summary', 'custom_instructor_field', 15 );
  
function custom_instructor_field() { ?>
 
<?php 
if(function_exists('get_field')){
$service_instructor = get_field('instructors');

if( $service_instructor ) { ?>

<?php

if( $service_instructor ): ?>
<div class="instructors">
	<h3>Instructors:</h3>
    <ul>
    <?php foreach( $service_instructor as $instructor ): 
        $permalink = get_post_type_archive_link('fit-staff');
        $title = get_the_title( $instructor->ID );
		$custom_field = get_field( 'instructor', $instructor->ID );
		
        ?>
    			
			<li><a href="<?php echo $permalink ?>"><?php echo esc_html( $title ); ?></a></li>
        
    <?php endforeach; ?>
    </ul>
	</div>

<?php endif;
 }
}
}

// Add link to products archive page

  
function link_to_services() { ?>

<?php 
$permalink = get_permalink( wc_get_page_id( 'shop' ));
?>
<div class="other-services-button">
<a class="other-services-link cta-button" href="<?php echo $permalink ?>">Check out our other services </a>
</div>
<?php
}
add_action( 'woocommerce_single_product_summary', 'link_to_services', 70 );

// --------------------------------------------

// Shop edits

// --------------------------------------------

// --------------------------------
// REMOVING ELEMENTS FROM SHOP PAGE
// --------------------------------

// Remove sorting 
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_no_products_found', 'wc_no_products_found' );

// remove add to cart button
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

// Remove a tags around products
// starting tag
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
// closing tag
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);


// Remove image
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

// remove product rating
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

// Add short description field 
function excerpt_in_product_archives() {
      
    the_excerpt();
}

add_action( 'woocommerce_after_shop_loop_item_title', 'excerpt_in_product_archives', 20 );

// Customize page title
add_filter( 'woocommerce_page_title', 'custom_woocommerce_page_title');
function custom_woocommerce_page_title( $page_title ) {
  if( $page_title == 'Services' ) {
    return "Services";
  }
}

// Add Image
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 30 );

// Add contact cta to shop page
add_action( 'woocommerce_after_shop_loop_item', 'custom_cta_field', 5 );

// function add new shop now button with screen reader text

function shop_now_button() { ?>

	<?php 
	$permalink = get_permalink(get_post());
	?>

	<a class="add_to_cart_button" href="<?php echo $permalink ?>">Shop Now <span class="screen-reader-text">for <?php the_title()?></span></a>
	
	<?php

	}

	add_action( 'woocommerce_after_shop_loop_item', 'shop_now_button', 10 );