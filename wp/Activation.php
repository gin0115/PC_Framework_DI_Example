<?php

declare(strict_types=1);

/**
 * Actiation hook event.
 *
 * @package Gin0115\PC_PF_Example1
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @since 1.0.0
 */

namespace Gin0115\WP\PC_PF_Example1;

use PinkCrab\Core\Application\App;
use Gin0115\WP\PC_PF_Example1\Uninstalled;

class Activation {

	/**
	 * Entry point for action hook call.
	 *
	 * @return void
	 */
	public function activate() {
		// Register unistall hook.
		register_uninstall_hook( __FILE__, array( App::make( Uninstalled::class ), 'uninstall' ) );
	}
}
