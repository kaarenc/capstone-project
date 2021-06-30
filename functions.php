<?php
/**
 * FWD Fitness functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package FWD_Fitness
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'fwd_fitness_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fwd_fitness_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on FWD Fitness, use a find and replace
		 * to change 'fwd-fitness' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'fwd-fitness', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'fwd-fitness' ),
				'footer' => esc_html__( 'Footer Menu', 'fwd-fitness' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'fwd_fitness_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'fwd_fitness_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fwd_fitness_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fwd_fitness_content_width', 640 );
}
add_action( 'after_setup_theme', 'fwd_fitness_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fwd_fitness_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'fwd-fitness' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'fwd-fitness' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'fwd_fitness_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fwd_fitness_scripts() {
	wp_enqueue_style( 'fwd-fitness-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'fwd-fitness-style', 'rtl', 'replace' );

	wp_enqueue_script( 'fwd-fitness-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Enqueue Swiper on the Homepage
	if (is_front_page()) {
		wp_enqueue_style(
			'swiper-styles',
			get_template_directory_uri() . '/css/swiper-bundle.css',
			array(),
			'6.6.1'
		);

		wp_enqueue_script(
			'swiper-scripts',
			get_template_directory_uri() . '/js/swiper-bundle.min.js',
			array(),
			'6.6.1',
			true
		);

		wp_enqueue_script(
			'swiper-settings',
			get_template_directory_uri() . '/js/swiper-setting.js',
			array('swiper-scripts'),
			_S_VERSION,
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'fwd_fitness_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
* Custom Post Types & Taxonomies
*/
require get_template_directory() . '/inc/cpt-taxonomy.php';


//excerpt length

function fwd_fitness_excerpt_length($length) {
	if(get_post_type(205)){
		return 100;
	}else{
		return $length;
	}
}


add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );


add_filter('excerpt_length', 'fwd_fitness_excerpt_length', 999);


//Edit the Read More Link

function fwd_fitness_excerpt_more($more){
	$more = '... <a class="read-more" href="'. get_permalink(). '">Continue Reading</a>';
	return $more;
}
add_filter('excerpt_more', 'fwd_fitness_excerpt_more');

//get rid of except on archive page

//Customizing the login page
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png);
            height: 65px;
            width: 65px;
            background-size: 65px 65px;
            padding-bottom: 10px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
function my_login_logo_url() {
    return home_url('https://fitness.bcitwebdeveloper.ca/');
}
add_filter( 'login_headerurl', 'my_login_logo_url' );
function my_login_logo_url_title() {
    return 'FWD Fitness';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
function my_login_styles() { ?>
    <style type="text/css">
        body.login {
            background-color: #284B63;  
        }
        body.login label {
            font-size: 1rem;
        }
        body.login div#login form#loginform {
            background-color: #F8F8F9;
        }
        body.login div#login form#loginform p.submit input#wp-submit {
            background-color: #284B63;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_styles' );

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
}
function custom_dashboard_help() {
echo '<p>Welcome to BCIT Fitness Support! Need help? Contact us at <a href="mailto:yourusername@gmail.com">here</a>. For WordPress Tutorials visit: <a href="https://www.wpbeginner.com" target="_blank">WPBeginner</a></p>';
}



// -----------------------------------------------------
// Home Page Widgets
// -----------------------------------------------------
add_action('wp_dashboard_setup', 'wpse_46445_dashboard_widget');
/*
 * Builds the Custom Dashboard Widget
 *
 */
function wpse_46445_dashboard_widget()
{
    $the_widget_title = 'Site Tutorials';
    wp_add_dashboard_widget('dashboard_tutorials_widget', $the_widget_title, 'wpse_46445_add_widget_content');
}
/*
 * Prints the Custom Dashboard Widget content
 *
 */
function wpse_46445_add_widget_content() 
{
    $tutorial_1 = wpse_46445_make_youtube_thumb_link(
        array(
            'id'=>'s-c_urzTWYQ', 
            'color'=>'#FF6645', 
            'title' => 'Video Tutorial', 
            'button' => 'Watch now'
        )
    );
    $tutorial_2 = wpse_46445_make_youtube_thumb_link(
        array(
            'id'=>'HIq9kkHbMCA', 
            'color'=>'#FF6645', 
            'title' => 'Video Tutorial', 
            'button' => 'Watch Now'
        )
    );
    $html = <<<HTML
    <h4 style="text-align:center">How to render videos for web using YouTube horsepower</h4>
    {$tutorial_1}
    <hr />
    <h4 style="text-align:center">How to render videos for web using YouTube horsepower</h4>
    {$tutorial_2}
HTML;
    echo $html;
}
/*
 * Makes a thumbnail with YouTube official image file 
 * the video links opens the video in the "watch_popup" mode (video fills full browser window)
 * 
 */
function wpse_46445_make_youtube_thumb_link($atts, $content = null) 
{
    $img   = "http://i3.ytimg.com/vi/{$atts['id']}/default.jpg";
    $yt    = "http://www.youtube.com/watch_popup?v={$atts['id']}";
    $color = ($atts['color'] && $atts['color'] != '') ? ';color:' . $atts['color'] : '';
    $html  = <<<HTML
        <div class="poptube" style="text-align:center;margin-bottom:40px">
        <h2 class="poptube" style="text-shadow:none;padding:0px{$color}">{$atts['title']}</h2>
        <a href="{$yt}" target="_blank"><img class="poptube" src="{$img}" style="margin-bottom:-19px"/></a><br />
        <a class="poptube button-secondary" href="{$yt}" target="_blank">{$atts['button']}</a></div>
HTML;
    return $html;
}


// Enqueue Swiper on the Homepage
if (is_front_page()) {
	wp_enqueue_style(
		'swiper-styles',
		get_template_directory_uri() . '/css/swiper-bundle.css',
		array(),
		'6.6.1'
	);
	wp_enqueue_script(
		'swiper-scripts',
		get_template_directory_uri() . '/js/swiper-bundle.min.js',
		array(),
		'6.6.1',
		true
	);
	wp_enqueue_script(
		'swiper-settings',
		get_template_directory_uri() . '/js/swiper-setting.js',
		array('swiper-scripts'),
		_S_VERSION,
		true
	);
}






// ----------------------------------------------------------------
// PRODUCTS FUNCTIONS
// ----------------------------------------------------------------

// remove zoom on product images

function remove_image_zoom_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
}
add_action( 'wp', 'remove_image_zoom_support', 100 );

// move price field
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
// add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 70 );

// remove meta data of product
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// remove additional information field
remove_action( 'woocommerce_product_additional_information', 'wc_display_product_attributes', 10 );



add_filter( 'woocommerce_product_tabs', 'remove_product_tabs', 9999 );

function remove_product_tabs( $tabs ) {

  unset( $tabs['additional_information'] );

  return $tabs;

}


// remove quantity box

function custom_remove_all_quantity_fields( $return, $product ) {return true;}
add_filter( 'woocommerce_is_sold_individually','custom_remove_all_quantity_fields', 10, 2 );



// remove description tab
add_filter( 'woocommerce_product_tabs', 'sd_remove_product_tabs', 98 );
function sd_remove_product_tabs( $tabs ) {
    unset( $tabs['description'] );
    return $tabs;
}


// add ACF to products


// add description field
add_action( 'woocommerce_single_product_summary', 'custom_description_field', 15 );
  
function custom_description_field() { ?>
 
<?php 

if(get_field('service_description')) { ?>
	<div class="service-description"><?php the_field('service_description'); ?></div>	
<?php }

}

// remove product short description from product page
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );


// add CTA field
add_action( 'woocommerce_after_single_product_summary', 'custom_cta_field', 3 );
  
function custom_cta_field() { ?>
 
<?php 

 
$contact = get_field('services_call_to_action');


if($contact) { 
$contact_url = $contact['url'];
?>

<a class="call-to-action" href="<?php echo esc_url( $contact_url ); ?>">Contact Us</a>
<?php }

}



// add instructors field

add_action( 'woocommerce_before_single_product_summary', 'custom_instructor_field', 70 );
  
function custom_instructor_field() { ?>
 
<?php 

$service_instructor = get_field('instructors');

if( $service_instructor ) { ?>

<?php

if( $service_instructor ): ?>
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


<?php endif; ?>

	
<?php }

}

// add link to products archive page

add_action( 'woocommerce_single_product_summary', 'link_to_services', 15 );
  
function link_to_services() { ?>

<?php 
$permalink = get_permalink( wc_get_page_id( 'shop' ));
?>
<a href="<?php echo $permalink ?>">Check out our other services </a>
<?php


}


// --------------------------------------------
// Shop edits
// --------------------------------------------


function excerpt_in_product_archives() {
      
    the_excerpt();
}


add_action( 'woocommerce_after_shop_loop_item_title', 'excerpt_in_product_archives', 20 );

// change select options text to more info
add_filter( 'woocommerce_product_add_to_cart_text', function( $text ) {
	global $product;
	if ( $product->is_type( 'variable' ) ) {
		$text = $product->is_purchasable() ? __( 'More Info', 'woocommerce' ) : __( 'More Info', 'woocommerce' );
	}
	return $text;
}, 10 );



