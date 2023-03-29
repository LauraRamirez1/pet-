<?php
/**
 * Child-Theme functions and definitions
 */

function tails_child_scripts() {
    wp_enqueue_style( 'tails-parent-style', get_template_directory_uri(). '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'tails_child_scripts' );

?>