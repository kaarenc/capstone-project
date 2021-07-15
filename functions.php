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
	wp_enqueue_style(
		'fwd-fitness-googlefonts',
		'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400&display=swap',
		array(),
		null);
		
	wp_enqueue_style( 'fwd-fitness-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'fwd-fitness-style', 'rtl', 'replace' );

	wp_enqueue_script( 'fwd-fitness-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	//enque google maps scripts

	wp_enqueue_script(
		'google-map',
		get_template_directory_uri() . '/js/google-map.js',
		array('jquery', 'google-server'),
		_S_VERSION,
		true
	);
	
	wp_enqueue_script(
		'google-server',
		'https://maps.googleapis.com/maps/api/js?key=AIzaSyCfFHEIf-Lp4LAaWuYhyMW9tBKcBrzKb7E',
		array(),
		_S_VERSION,
		true
	);

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
		return 30;
	}else{
		return $length;
	}
}
add_filter('excerpt_length', 'fwd_fitness_excerpt_length', 999);


// removing "Archive:" from archive pages
add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );


//Edit the Read More Link
function fwd_fitness_excerpt_more($more){
	$more = '... <a class="read-more" href="'. get_permalink(). '">Continue Reading</a>';
	return $more;
}

add_filter('excerpt_more', 'fwd_fitness_excerpt_more');

//get rid of except on archive page


//Customizing the login page
//Logo
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png);
            height: 80px;
            width: 80px;
            background-size: 80px 80px;
            padding-bottom: 10px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

//Logo URL
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'FWD Fitness';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

//Styles
function my_login_styles() { ?>
    <style type="text/css">
        body.login {
            background-color: #F5F5F5;  
			color: #131315;
        }
		body.login div#login form#loginform {
			background-color: #8CCDF8 !important;
		}
		body.login div#login form#loginform p.submit input#wp-submit{
			background-color: #131315 !important;
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


// Support Widget on Dashboard
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
            'color'=>'#0093B8', 
            'title' => 'Adding a Testimonial', 
            'button' => 'View Video'
        )
    );
    $tutorial_2 = wpse_46445_make_youtube_thumb(
        array(
            'id'=>'HIq9kkHbMCA', 
            'color'=>'#0093B8', 
            'title' => 'Adding a Blog Post', 
            'button' => 'View Video'
        )
    );

	$tutorial_3 = wpse_46445_make_youtube_thumb_link3(
        array(
            'id'=>'HIq9kkHbMCA', 
            'color'=>'#0093B8', 
            'title' => 'Adding a Product', 
            'button' => 'View Video'
        )
    );
    $html = <<<HTML
    <h4 style="text-align:center">How to add a testimonial to your Postively Fit website</h4>
    {$tutorial_1}
    <hr />
    <h4 style="text-align:center">How to add a blog post to your Positively Fit website</h4>
    {$tutorial_2}
	<hr />
    <h4 style="text-align:center">How to add a product to you Positively Fit website</h4>
    {$tutorial_3}
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
    $yt    = "https://share.vidyard.com/watch/eg6Zwp9S8QvYQwyFobxFkM?{$atts['id']}";
    $color = ($atts['color'] && $atts['color'] != '') ? ';color:' . $atts['color'] : '';
    $html  = <<<HTML
        <div class="poptube" style="text-align:center;margin-bottom:40px">
        <h2 class="poptube" style="text-shadow:none;padding:0px{$color}">{$atts['title']}</h2>
        <a href="{$yt}" target="_blank"><img class="poptube" src="{$img}" style="margin-bottom:-19px"/></a><br />
        <a class="poptube button-secondary" href="{$yt}" target="_blank">{$atts['button']}</a></div>
HTML;
    return $html;
}

function wpse_46445_make_youtube_thumb($atts, $content = null) 
{
    $img   = "http://i3.ytimg.com/vi/{$atts['id']}/default.jpg";
    $yt    = "https://share.vidyard.com/watch/QRBoCNAUFAvzsVZ8fVGnhj?{$atts['id']}";
    $color = ($atts['color'] && $atts['color'] != '') ? ';color:' . $atts['color'] : '';
    $html  = <<<HTML
        <div class="poptube" style="text-align:center;margin-bottom:40px">
        <h2 class="poptube" style="text-shadow:none;padding:0px{$color}">{$atts['title']}</h2>
        <a href="{$yt}" target="_blank"><img class="poptube" src="{$img}" style="margin-bottom:-19px"/></a><br />
        <a class="poptube button-secondary" href="{$yt}" target="_blank">{$atts['button']}</a></div>
HTML;
    return $html;
}

function wpse_46445_make_youtube_thumb_link3($atts, $content = null) 
{
    $img   = "http://i3.ytimg.com/vi/{$atts['id']}/default.jpg";
    $yt    = "https://share.vidyard.com/watch/j8ccW21CSnsKouGTgiKyev?{$atts['id']}";
    $color = ($atts['color'] && $atts['color'] != '') ? ';color:' . $atts['color'] : '';
    $html  = <<<HTML
        <div class="poptube" style="text-align:center;margin-bottom:40px">
        <h2 class="poptube" style="text-shadow:none;padding:0px{$color}">{$atts['title']}</h2>
        <a href="{$yt}" target="_blank"><img class="poptube" src="{$img}" style="margin-bottom:-19px"/></a><br />
        <a class="poptube button-secondary" href="{$yt}" target="_blank">{$atts['button']}</a></div>
HTML;
    return $html;
}


// block block editor on contact page
//changes from the block editor to the classic editor for some pages
//"removing" the block editor
function fwd_post_filter( $use_block_editor, $post ) {
    // Change ID number to your Page ID
    $page_ids = array( 29 );
    if ( in_array( $post->ID, $page_ids ) ) {
        return false;
    } else {
        return $use_block_editor;
    }
}
add_filter( 'use_block_editor_for_post', 'fwd_post_filter', 10, 2 );




// Adding new cutsom widget area for footer

function wpb_widgets_init() {
 
    register_sidebar( array(
        'name'          => 'Custom Footer Widget Area',
        'id'            => 'custom-footer-widget',
        'before_widget' => '<div class="cfw-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="cfw-title">',
        'after_title'   => '</h2>',
    ) );
 
// Adding new cutsom widget area for contact page

register_sidebar( array(
	'name'          => 'Custom Contact Map Widget Area',
	'id'            => 'custom-map-widget',
	'before_widget' => '<div class="cmw-widget">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="cmw-title">',
	'after_title'   => '</h2>',
) );

}
add_action( 'widgets_init', 'wpb_widgets_init' );

// adding google maps functionality
function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyCfFHEIf-Lp4LAaWuYhyMW9tBKcBrzKb7E';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

//remove quantity from cart

