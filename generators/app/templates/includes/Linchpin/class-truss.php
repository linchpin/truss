<?php
/**
 * Truss Base Class
 *
 * Where is all starts. Includes all of our Classes
 *
 * @package Truss
 * @since   1.0
 */

namespace Truss;

require_once 'class-activate.php';
require_once 'class-menu.php';
require_once 'class-tinymce.php';
require_once 'class-utilities.php';

/**
 * Class Core
 */
class Core {

	/**
	 * Construct
	 */
	public function __construct() {
		$truss_activate = new Activate();
		$truss_menu     = new Menu();
		$truss_tinymce  = new TinyMCE();
	}
}
