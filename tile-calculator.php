<?php
/**
 * Plugin Name: Tile Calculator Elementor Widget
 * Description: A custom Elementor widget for tile calculation with dynamic JavaScript logic.
 * Version: 1.0
 * Author: Sabbir
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Include the widget
function tc_register_tile_calculator_widget( $widgets_manager ) {
    require_once( __DIR__ . '/widgets/tile-calculator-widget.php' );
    $widgets_manager->register( new \Tile_Calculator_Widget() );
}
add_action( 'elementor/widgets/register', 'tc_register_tile_calculator_widget' );

// Enqueue CSS & JS
function tc_enqueue_assets() {
    wp_enqueue_style( 'tc-style', plugin_dir_url( __FILE__ ) . 'assets/css/tile-calculator.css' );
    wp_enqueue_script( 'tc-script', plugin_dir_url( __FILE__ ) . 'assets/js/tile-calculator.js', ['jquery'], '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'tc_enqueue_assets' );
