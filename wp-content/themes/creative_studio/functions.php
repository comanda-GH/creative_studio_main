<?php
/**
 * Created by PhpStorm.
 * User: rb
 * Date: 24.03.15
 * Time: 16:06
 */
function enqueue_styles() {
    wp_enqueue_style( 'creative_studio-style', get_stylesheet_uri());
    wp_register_style('font-style', 'http://fonts.googleapis.com/css?family=Comfortaa');
    wp_enqueue_style( 'font-style');
}
add_action('wp_enqueue_scripts', 'enqueue_styles');
/**Menu***/
register_nav_menu('menu','Меню');
/**upload thumbnails***/
add_theme_support('post-thumbnails');
// Add the Custom Post Type

require get_template_directory() .'/inc/afisha.php';
require get_template_directory() .'/inc/arzamath_17-widget.php';
function register_my_widgets(){
    register_sidebar( array(
        'name' => 'Боковая панель на главной странице',
        'id' => 'homepage-sidebar',
        'description' => 'Выводиться как боковая панель только на главной странице сайта.',
        'before_widget' => '<li class="homepage-widget-block">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ) );
}
add_action( 'widgets_init', 'register_my_widgets' );


