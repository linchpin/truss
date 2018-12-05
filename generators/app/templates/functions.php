<?php
/**
 *
 * Include all of our needed Classes and scripts
 */

// Useful global constants
define( '<%= prefix_caps %>VERSION', '<%= theme_version %>' );
define( '<%= prefix_caps %>TYPEKIT', 'csi6jve' ); // Define if we are using typekit, this determines if typekit is used in the editor

if ( ! defined( 'SCRIPT_DEBUG' ) ) {
	define( 'SCRIPT_DEBUG', true ); // Enable script debug by default. Should be disabled in production
}

require_once 'includes/Linchpin/utilities/utilities.php'; // Useful Functions
require_once 'includes/Linchpin/utilities/hooks.php';     // Custom Truss Hooks
require_once 'includes/Linchpin/class-truss.php';         // Truss Classes
require_once 'includes/Foundation/class-foundation.php';  // Foundation Classes
require_once 'includes/<%= class_name %>.php';            // Theme Class

/**
 * Instantiate our classes, kick the theme in gear.
 */

$theme = new <%= class_name %>();
