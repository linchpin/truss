<?php
/**
 *
 * Include all of our needed Classes and scripts
 */

// Useful global constants
define( 'CLIENTNAME_VERSION', '1.0.0' );

if ( ! defined( 'SCRIPT_DEBUG' ) ) {
	define( 'SCRIPT_DEBUG', true ); // enable script debug by default
}

require_once 'includes/Linchpin/utilities/utilities.php'; // Useful Functions
require_once 'includes/Linchpin/utilities/hooks.php';     // Custom Truss Hooks
require_once 'includes/Linchpin/class-truss.php';         // Truss Classes
require_once 'includes/Foundation/foundation.php';        // Foundation Classes
require_once 'includes/ClientName.php';                   // Theme Class

/**
 * Instantiate our classes, kick the theme in gear.
 */

$theme = new ClientName();
