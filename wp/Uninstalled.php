<?php

declare(strict_types=1);

/**
 * Uninstall hook event.
 *
 * @package Gin0115\PC_PF_Example1
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @since 1.0.0
 */

namespace Gin0115\WP\PC_PF_Example1;

use Gin0115\WP\PC_PF_Example1\Migrations\Quote_Migration;

class Uninstalled {

	/** @var wpdb */
	protected $wpdb;

	public function __construct( \wpdb $wpdb ) {
		$this->wpdb = $wpdb;
	}

	/**
	 * Entry points for the uninstall hook call.
	 *
	 * @return void
	 */
	public function uninstall() {

		// Run quote table migration.
		// This could have been dont via DI like Activation.
		( new Quote_Migration( $this->wpdb ) )->down();
	}
}
