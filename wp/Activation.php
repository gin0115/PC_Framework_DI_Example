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
use Gin0115\WP\PC_PF_Example1\Migrations\Quote_Migration;

class Activation {

	/** @var wpdb */
	protected $wpdb;

	public function __construct( \wpdb $wpdb ) {
		$this->wpdb = $wpdb;
	}

	/**
	 * Entry point for action hook call.
	 *
	 * @return void
	 */
	public function activate() {
		// Register unistall hook.
		register_uninstall_hook( __FILE__, array( new Uninstalled( $this->wpdb ), 'uninstall' ) );

		// Run quote table migration.
		// This could have been dont via DI, but can get a bit mess with multiple
		// and as they are rarely used, its not a big issue.
		( new Quote_Migration( $this->wpdb ) )->up();
	}
}
