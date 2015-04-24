<?php
/**
 * Created by PhpStorm.
 * User: rb
 * Date: 24.03.15
 * Time: 16:06
 */
function enqueue_styles() {
    wp_enqueue_style( 'cr_studio-style', get_stylesheet_uri());
    wp_register_style('font-style', 'http://fonts.googleapis.com/css?family=Comfortaa');
    wp_enqueue_style( 'font-style');
}
add_action('wp_enqueue_scripts', 'enqueue_styles');
/**Menu***/
register_nav_menu('menu','Меню');
/**upload thumbnails***/
add_theme_support('post-thumbnails');
// Add the Custom Post Type
require get_template_directory() .'/inc/grafic.php';
require get_template_directory() .'/inc/afisha.php';
