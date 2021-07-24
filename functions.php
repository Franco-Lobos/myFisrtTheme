<?php

function myResources(){

    wp_enqueue_style('style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'myResources');

 

//Get top ancester

function get_top_ancestor_id() {

    global $post;

    if ($post->post_parent) {
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        return $ancestors[0];
    }

    return $post-> ID;

}

// Does page have children?
function has_children() {

    global $post;

    $pages = get_pages('child_of=' . $post->ID);
    return count($pages);
}


// Customize excerpt word count length
function custom_excerpt_length() {
    return 25;
}

add_filter('excerpt_length', 'custom_excerpt_length');


//Theme Setup

function learningWordpress_setup() {

    // Navigation menus

    register_nav_menus(array(
        'primary' => __('Primary Menu'),
        'footer' => __('Footer Menu'),
    ));

    //Add featured image support
    add_theme_support('post-thumbnails');
    add_image_size('small-thumbnail', 180, 120, true);
    add_image_size('banner-image', 920, 210, array('left', 'top'));

    //Add post format support
    add_theme_support('post-formats', array('aside', 'gallery', 'link'));

}

add_action('after_setup_theme', 'learningWordpress_setup');


//Add Our Widget Locations

function ourWidgetsInit(){

    register_sidebar( array(
        'name'=> 'Sidebar',
        'id' => 'sidebar1',
        'before_widget' => '<div class = "widget-item">',
        'after_widget' =>  '</div>',
        'before_title' => '<hp class ="my-special-class">',
        'after_title' =>  '</h4>'
    ));

    register_sidebar( array(
        'name'=> 'Footer Area 1',
        'id' => 'footer1'
    ));

    register_sidebar( array(
        'name'=> 'Footer Area 2',
        'id' => 'footer2'
    ));

    register_sidebar( array(
        'name'=> 'Footer Area 3',
        'id' => 'footer3'
    ));

    register_sidebar( array(
        'name'=> 'Footer Area 4',
        'id' => 'footer4'
    ));

}

add_action('widgets_init', 'ourWidgetsInit');


//Customize Appearance Options 
function learningworddPress_customize_register($wp_customize) {

    $wp_customize->add_setting('lwp_link_color', array(
        'default' => '006ec3',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting('lwp_btn_color', array(
        'default' => '006ec3',
        'transport' => 'refresh',
    ));

    $wp_customize->add_section('lwp_standar_colors', array(
        'title'=> __('Standard colors', 'myFisrtTheme'),
        'priority'=> 30,
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'lwp_link_color_control', array (
        'label' => __('Link Color', 'myFisrtTheme'),
        'section' => 'lwp_standar_colors',
        'settings' => 'lwp_link_color',
    )));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'lwp_btn_color_control', array (
        'label' => __('Button Color', 'myFisrtTheme'),
        'section' => 'lwp_standar_colors',
        'settings' => 'lwp_btn_color',
    )));
    
}


add_action('customize_register', 'learningworddPress_customize_register');

//Output Customize CSS

function learningwordPress_customize_css() { ?>

    <style type='text/css'>

        a:link,
        a:visited {
            color: <?php echo get_theme_mod('lwp_link_color');?>;
        }
        .site-header nav ul li.current-menu-item a:link,
        .site-header nav ul li.current-menu-item a:visited,
        .site-header nav ul li.current-page-ancestor a:link,
        .site-header nav ul li.current-page-ancestor a:visited{
            background-color: <?php echo get_theme_mod('lwp_link_color_control');?>;

        }

        div.hd-search #searchsubmit {
            background-color: <?php echo get_theme_mod('lwp_link_color_control');?>;
        }

        div.info-box {
            background-color: <?php echo get_theme_mod('lwp_link_color_control');?>; 
        }



    </style>
<?php }

add_action('wp_head', 'learningWordPress_customize_css');


//Add Footer callout section to admin appearance cutsomize

function lwp_footer_callout($wp_customize) {
    
    $wp_customize->add_setting('lwp-footer-callout-display', array(
        'default' => 'No'
    ));

    
    $wp_customize->add_section('lwp-footer-callout-section', array(
        'title' => 'Footer callout'
    ));

    $wp_customize->add_setting('lwp-footer-callout-headline', array(
        'default' => 'Example Header Text'
    ));

    $wp_customize->add_setting('lwp-footer-callout-text', array(
        'default' => 'Example Header text'
    ));

    $wp_customize->add_setting('lwp-footer-callout-link');

    $wp_customize->add_setting('lwp-footer-callout-image');

    $wp_customize->add_control( new WP_Customize_Control($wp_customize,
    'lwp-footer-callout-display-control', array(
        'label' => 'Display this section',
        'section' => 'lwp-footer-callout-section',
        'settings' => 'lwp-footer-callout-display',
        'type' => 'select',
        'choices' => array('No' => 'No', 'Yes' => 'Yes'),
    )));

    $wp_customize->add_control( new WP_Customize_Control($wp_customize,
    'lwp-footer-callout-headline-control', array(
        'label' => 'Headline',
        'section' => 'lwp-footer-callout-section',
        'settings' => 'lwp-footer-callout-headline'
    )));

    $wp_customize->add_control( new WP_Customize_Control($wp_customize,
    'lwp-footer-callout-text-control', array(
        'label' => 'text',
        'section' => 'lwp-footer-callout-section',
        'settings' => 'lwp-footer-callout-text',
        'type' => 'textarea',
    )));

    $wp_customize->add_control( new WP_Customize_Control($wp_customize,
    'lwp-footer-callout-link-control', array(
        'label' => 'link',
        'section' => 'lwp-footer-callout-section',
        'settings' => 'lwp-footer-callout-link',
        'type' => 'dropdown-pages',
    )));

    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize,
    'lwp-footer-callout-image-control', array(
        'label' => 'Image',
        'section' => 'lwp-footer-callout-section',
        'settings' => 'lwp-footer-callout-image',
        'width' => 225,
        'height' => 150,
    )));

}

add_action('customize_register', 'lwp_footer_callout');

//Add carousel function


function carousel_init() {
    $elements = get_;
}


//function has_children() {
//    global $post;
//  $pages = get_pages('child_of=' . $post->ID);
//    return count($pages);
//}


add_action('DOMContentLoaded', 'carousel_init');


//add shortcode

require_once(get_template_directory() . '/shortcodes/categorySearchChild/index.php');

require_once(get_template_directory() . '/shortcodes/slider/index.php');

