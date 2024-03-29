<?php
/**
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */


require( get_template_directory() . '/functions/constants.php' );
$options = fau_initoptions();
require_once ( get_template_directory() . '/functions/theme-options.php' );     
require_once(get_template_directory() .'/functions/bootstrap.php');
require_once(get_template_directory() .'/functions/shortcodes.php');
require_once(get_template_directory() .'/functions/menu.php');


/**
 * Sets up theme defaults and registers the various WordPress features that
 * FAU supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since FAU 1.0
 *
 * @return void
 */


function fau_setup() {
	global $options;
	
	/*
	 * Makes FAU available for translation.
	 *
	 */
	load_theme_textdomain( 'fau', get_template_directory() . '/languages' );

	if ( ! isset( $content_width ) ) $content_width = $options['content-width'];
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'editor-style.css' ) );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
//	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
//	add_theme_support( 'post-formats', array(
//		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
//	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'meta', __( 'Meta-Navigation oben', 'fau' ) );
	register_nav_menu( 'meta-footer', __( 'Meta-Navigation unten', 'fau' ) );
	register_nav_menu( 'main-menu', __( 'Haupt-Navigation', 'fau' ) );
	
	register_nav_menu( 'quicklinks-1', __( 'Quicklinks 1', 'fau' ) );
	register_nav_menu( 'quicklinks-2', __( 'Quicklinks 2', 'fau' ) );
	register_nav_menu( 'quicklinks-3', __( 'Quicklinks 3', 'fau' ) );
	register_nav_menu( 'quicklinks-4', __( 'Quicklinks 4', 'fau' ) );
	
	register_nav_menu( 'error-1', __( 'Fehler 1', 'fau' ) );
	register_nav_menu( 'error-2', __( 'Fehler 2', 'fau' ) );
	register_nav_menu( 'error-3', __( 'Fehler 3', 'fau' ) );
	register_nav_menu( 'error-4', __( 'Fehler 4', 'fau' ) );
	
	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 300, 150, false );

	add_image_size( 'hero', 1260, 350, true);
	add_image_size( 'page-thumb', 220, 110, true); 
	add_image_size( 'post-thumb', 220, 147, false); // 3:2
	add_image_size( 'post', 300, 200, false);
	add_image_size( 'person-thumb', 60, 80, true); // 300, 150
	add_image_size( 'person-thumb-bigger', 90, 120, true);
	add_image_size( 'topevent-thumb', 140, 90, true); 
	add_image_size( 'logo-thumb', 140, 110, true);
	
	add_image_size( 'gallery-full', 940, 470);
	add_image_size( 'gallery-thumb', 120, 80, true);
	add_image_size( 'gallery-grid', 145, 120, false);

	add_image_size( 'image-2-col', 300, 200, true);
	add_image_size( 'image-4-col', 140, 70, true);	
		
	// This theme uses its own gallery styles.
//	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'fau_setup' );

function fau_initoptions() {
    global $defaultoptions;

   return get_option('fau_theme_options', $defaultoptions);
}



/**
 * Enqueues scripts and styles for front end.
 *
 * @since FAU 1.0
 *
 * @return void
 */
function fau_scripts_styles() {
	
	wp_enqueue_style( 'fau-style', get_stylesheet_uri(), array(), '2013-08-19' );
	
	wp_enqueue_script( 'fau-libs-jquery', get_template_directory_uri() . '/js/libs/jquery-1.11.1.min.js', array(), '1.0', true );
	wp_enqueue_script( 'fau-libs-plugins', get_template_directory_uri() . '/js/libs/plugins.js', array(), '1.0', true );
	wp_enqueue_script( 'fau-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0', true );

}
add_action( 'wp_enqueue_scripts', 'fau_scripts_styles' );



/**
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since FAU 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function fau_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Seite %s', 'fau' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'fau_wp_title', 10, 2 );


/**
 * Resets the Excerpt More
 */

function fau_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'fau_excerpt_more');

/**
 * Resets the Excerpt More
 */
function fau_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'fau_excerpt_length', 999 );



/**
 * Sets up the WordPress core custom header arguments and settings.
 *
 * @uses add_theme_support() to register support for 3.4 and up.
 * @uses twentythirteen_header_style() to style front-end.
 * @uses register_default_headers() to set up the bundled header images.
 *
 * @since FAU 1.0
 */
function fau_custom_header_setup() {
	$args = array(
		// Text color and image (empty to use none).
		'default-image'          => '%s/img/logo-fau.png',

		// Set height and width, with a maximum value for the width.
		'height'                 => 65,
		'width'                  => 240,

		// Callbacks for styling the header and the admin preview.
	'admin-head-callback'    => 'fau_admin_header_style',
	);

	add_theme_support( 'custom-header', $args );

	/*
	 * Default custom headers packaged with the theme.
	 * %s is a placeholder for the theme template directory URI.
	 */
	register_default_headers( array(
		'fau' => array(
			'url'           => '%s/img/logo-fau.png',
			'thumbnail_url' => '%s/img/logo-fau.png',
			'description'   => _x( 'FAU', 'header image description', 'fau' )
		),
		'fak-med' => array(
			'url'           => '%s/img/logo-fak-med.png',
			'thumbnail_url' => '%s/img/logo-fak-med.png',
			'description'   => _x( 'FAKMED', 'header image description', 'fau' )
		),
		'fak-nat' => array(
			'url'           => '%s/img/logo-fak-nat.png',
			'thumbnail_url' => '%s/img/logo-fak-nat.png',
			'description'   => _x( 'FAKNAT', 'header image description', 'fau' )
		),
		'fak-phil' => array(
			'url'           => '%s/img/logo-fak-phil.png',
			'thumbnail_url' => '%s/img/logo-fak-phil.png',
			'description'   => _x( 'FAKPHIL', 'header image description', 'fau' )
		),
		'fak-rechtswiwi' => array(
			'url'           => '%s/img/logo-fak-rechtswiwi.png',
			'thumbnail_url' => '%s/img/logo-fak-rechtswiwi.png',
			'description'   => _x( 'FAKRECHTSWIWI', 'header image description', 'fau' )
		),
		'fak-tech' => array(
			'url'           => '%s/img/logo-fak-tech.png',
			'thumbnail_url' => '%s/img/logo-fak-tech.png',
			'description'   => _x( 'FAKTECH', 'header image description', 'fau' )
		),
	) );
}
add_action( 'after_setup_theme', 'fau_custom_header_setup' );



function fau_admin_style() {
    wp_register_style( 'themeadminstyle', get_template_directory_uri().'/css/admin.css' );	   
    wp_enqueue_style( 'themeadminstyle' );	
    wp_enqueue_media();
    wp_register_script('themeadminscripts', get_template_directory_uri().'/js/admin.js', array('jquery'));    
    wp_enqueue_script('themeadminscripts');	   
}
add_action( 'admin_enqueue_scripts', 'fau_admin_style' );

/**
 * Registers our main widget area and the front page widget areas.
 *
 * @since FAU 1.0
 */
function fau_widgets_init() {

	

	register_sidebar( array(
		'name' => __( 'News Sidebar', 'fau' ),
		'id' => 'news-sidebar',
		'description' => __( 'Sidebar auf der News-Kategorieseite', 'fau' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="small">',
		'after_title' => '</h2>',
	) );

	register_sidebar( array(
		'name' => __( 'Suche Sidebar', 'fau' ),
		'id' => 'search-sidebar',
		'description' => __( 'Sidebar auf der Such-Ergebnisseite links', 'fau' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="small">',
		'after_title' => '</h2>',
	) );
	
	if (function_exists('workflow_dropdown_pages')) {
	    // Widget nur wenn CMS-Workflow vorhanden und aktiviert ist
	    register_sidebar( array(
		    'name' => __( 'Sprachwechsler', 'fau' ),
		    'id' => 'language-switcher',
		    'description' => __( 'Sprachwechsler im Header der Seite', 'fau' ),
		    'before_widget' => '',
		    'after_widget' => '',
		    'before_title' => '',
		    'after_title' => '',
	    ) );
	}
	
}
add_action( 'widgets_init', 'fau_widgets_init' );




add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );



function add_video_embed_note($html, $url, $attr) {
	return '<div class="oembed">'.$html.'</div>';
}
add_filter('embed_oembed_html', 'add_video_embed_note', 10, 3);



function fau_protected_attribute ($classes, $item) {
	if($item->post_password != '')
	{
		$classes[] = 'protected-page';
	}
	return $classes;
}
add_filter('page_css_class', 'fau_protected_attribute', 10, 3);


function custom_error_pages()
{
    global $wp_query;
 
    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 403)
    {
        $wp_query->is_404 = FALSE;
        $wp_query->is_page = TRUE;
        $wp_query->is_singular = TRUE;
        $wp_query->is_single = FALSE;
        $wp_query->is_home = FALSE;
        $wp_query->is_archive = FALSE;
        $wp_query->is_category = FALSE;
        add_filter('wp_title','custom_error_title',65000,2);
        add_filter('body_class','custom_error_class');
        status_header(403);
        get_template_part('403');
        exit;
    }
 
    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 401)
    {
        $wp_query->is_404 = FALSE;
        $wp_query->is_page = TRUE;
        $wp_query->is_singular = TRUE;
        $wp_query->is_single = FALSE;
        $wp_query->is_home = FALSE;
        $wp_query->is_archive = FALSE;
        $wp_query->is_category = FALSE;
        add_filter('wp_title','custom_error_title',65000,2);
        add_filter('body_class','custom_error_class');
        status_header(401);
        get_template_part('401');
        exit;
    }
}
 
function custom_error_title($title='',$sep='')
{
    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 403)
        return "Forbidden ".$sep." ".get_bloginfo('name');
 
    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 401)
        return "Unauthorized ".$sep." ".get_bloginfo('name');
}
 
function custom_error_class($classes)
{
    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 403)
    {
        $classes[]="error403";
        return $classes;
    }
 
    if(isset($_REQUEST['status']) && $_REQUEST['status'] == 401)
    {
        $classes[]="error401";
        return $classes;
    }
}
 
add_action('wp','custom_error_pages');


add_action( 'contextual_help', 'wptuts_screen_help', 10, 3 );
function wptuts_screen_help( $contextual_help, $screen_id, $screen ) {
 
    // The add_help_tab function for screen was introduced in WordPress 3.3.
    if ( ! method_exists( $screen, 'add_help_tab' ) )
        return $contextual_help;
 
    global $hook_suffix;
 
    // List screen properties
    $variables = '<ul style="width:50%;float:left;"> <strong>Screen variables </strong>'
        . sprintf( '<li> Screen id : %s</li>', $screen_id )
        . sprintf( '<li> Screen base : %s</li>', $screen->base )
        . sprintf( '<li>Parent base : %s</li>', $screen->parent_base )
        . sprintf( '<li> Parent file : %s</li>', $screen->parent_file )
        . sprintf( '<li> Hook suffix : %s</li>', $hook_suffix )
        . '</ul>';
 
    // Append global $hook_suffix to the hook stems
    $hooks = array(
        "load-$hook_suffix",
        "admin_print_styles-$hook_suffix",
        "admin_print_scripts-$hook_suffix",
        "admin_head-$hook_suffix",
        "admin_footer-$hook_suffix"
    );
 
    // If add_meta_boxes or add_meta_boxes_{screen_id} is used, list these too
    if ( did_action( 'add_meta_boxes_' . $screen_id ) )
        $hooks[] = 'add_meta_boxes_' . $screen_id;
 
    if ( did_action( 'add_meta_boxes' ) )
        $hooks[] = 'add_meta_boxes';
 
    // Get List HTML for the hooks
    $hooks = '<ul style="width:50%;float:left;"> <strong>Hooks </strong> <li>' . implode( '</li><li>', $hooks ) . '</li></ul>';
 
    // Combine $variables list with $hooks list.
    $help_content = $variables . $hooks;
 
    // Add help panel
    $screen->add_help_tab( array(
        'id'      => 'wptuts-screen-help',
        'title'   => 'Screen Information',
        'content' => $help_content,
    ));
 
    return $contextual_help;
}


add_filter('post_gallery', 'fau_post_gallery', 10, 2);
function fau_post_gallery($output, $attr) {
    global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => '',
		'type' => NULL,
		'lightbox' => FALSE,
		'captions' => FALSE
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';

	$output = '';
	
	switch($attr['type'])
	{
		case "grid":
			{
				$rand = rand();
				
				$output .= "<div class=\"image-gallery-grid clearfix\">\n";
			    $output .= "<ul class=\"grid\">\n";
			
				foreach ($attachments as $id => $attachment) {
			        $img = wp_get_attachment_image_src($id, 'gallery-grid');
					$meta = get_post($id);
					
					$img_full = wp_get_attachment_image_src($id, 'gallery-full');
					
					if($attr['captions'])
					{
						$output .= "<li class=\"has-caption\">\n";
					}
			        else
					{
						$output .= "<li>\n";
					}
							if($attr['lightbox']) 
							{
								$output .= '<a href="'.$img_full[0].'" class="lightbox"';
									if($meta->post_excerpt != '') $output .= ' title="'.$meta->post_excerpt.'"';
								$output .= ' rel="lightbox-'.$rand.'">';
							}
							
			        			$output .= "<img src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />";
							if($attr['lightbox']) $output .= '</a>';
							if($attr['captions'] && $meta->post_excerpt) $output .= '<div class="caption">'.$meta->post_excerpt.'</div>';
			        $output .= "</li>\n";
			    }
			
				$output .= "</ul>\n";
			    $output .= "</div>\n";
				
				break;
			}
			
		case "2cols":
			{
				$rand = rand();
				
				$output .= '<div class="row">';
				$i = 0;
				
				foreach ($attachments as $id => $attachment) {
					$img = wp_get_attachment_image_src($id, 'image-2-col');
					$meta = get_post($id);
					
					$output .= '<div class="span4">';

		        		$output .= "<img class=\"content-image-cols\" src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />";
						if($attr['captions'] && $meta->post_excerpt) $output .= '<div class="caption">'.$meta->post_excerpt.'</div>';
						
					$output .= '</div>';
					
					$i++;
					
					if($i % 2 == 0)
					{
						$output .= '</div><div class="row">';
					}
				}
					
				$output .= '</div>';
				
				break;
			}
		
		case "4cols":
			{
				$rand = rand();

				$output .= '<div class="row">';
				$i = 0;

				foreach ($attachments as $id => $attachment) {
					$img = wp_get_attachment_image_src($id, 'image-4-col');
					$meta = get_post($id);

					$output .= '<div class="span2">';

		        		$output .= "<img class=\"content-image-cols\" src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />";
						if($attr['captions'] && $meta->post_excerpt) $output .= '<div class="caption">'.$meta->post_excerpt.'</div>';

					$output .= '</div>';

					$i++;

					if($i % 3 == 0)
					{
						$output .= '</div><div class="row">';
					}
				}

				$output .= '</div>';

				break;
			}
					
		default:
			{
				$output .= "<div class=\"image-gallery-slider\">\n";
			    $output .= "<ul class=\"slides\">\n";

			    foreach ($attachments as $id => $attachment) {
			        $img = wp_get_attachment_image_src($id, 'gallery-full');
					$meta = get_post($id);


			        $output .= "<li>\n";
			        	$output .= "<img src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />\n";
						if($meta->post_excerpt != '') $output .= '<div class="gallery-image-caption">'.$meta->post_excerpt.'</div>';
			        $output .= "</li>\n";
			    }

			    $output .= "</ul>\n";
			    $output .= "</div>\n";

				$output .= "<div class=\"image-gallery-carousel\">\n";
			    $output .= "<ul class=\"slides\">\n";

			    foreach ($attachments as $id => $attachment) {
			        $img = wp_get_attachment_image_src($id, 'gallery-thumb');

			        $output .= "<li>\n";
			        	$output .= "<img src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />\n";
			        $output .= "</li>\n";
			    }

			    $output .= "</ul>\n";
			    $output .= "</div>\n";
			}
	}

    

    return $output;
}

