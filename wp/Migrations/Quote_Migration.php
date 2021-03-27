<?php

declare(strict_types=1);

/**
 * Handles the migration and truncation of the quotes database table
 * and intial data.
 *
 * @package Gin0115\PC_PF_Example1
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @since 1.0.0
 */

namespace Gin0115\WP\PC_PF_Example1\Migrations;

use PinkCrab\Core\Application\App;
use PinkCrab\Core\Application\Config;
use PinkCrab\Core\Application\App_Config;

class Quote_Migration {

	/** @var wpdb */
	protected $wpdb;

	protected $table;

	public function __construct( \wpdb $wpdb ) {
		$this->wpdb = $wpdb;

		// As this runs outside of the normal app life cycle
		// We need to use the static functions on app
		// to access the current configs.
		$this->table = App::retreive( 'config' )->db_tables( 'quote' ); // Returns our table name as if it was a constant.
	}

	/**
	 * Returns the tables schema as a sql statement
	 * This is supplied in wpdb/db_delta format.
	 *
	 * @return string
	 */
	private function schema_provider(): string {
		return <<<SQL
    CREATE TABLE $this->table (
    id int(11) NOT NULL AUTO_INCREMENT,
    body text NOT NULL,
    author text NOT NULL,
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY  (id)
    );
SQL;
	}

	/**
	 * Returns the intial data used to populate the database.
	 *
	 * @return array<array{body:string,author:string}>
	 */
	private function quote_provider(): array {
		return array(
			array(
				'body'   => 'DB Quote 1',
				'author' => 'Some Body',
			),
			array(
				'body'   => 'DB Quote 2',
				'author' => 'Some Person',
			),
			array(
				'body'   => 'DB Quote 3',
				'author' => 'Some Person',
			),
		);
	}

	/**
	 * Builds the table and popualtes the intial data.
	 *
	 * @return void
	 */
	public function up(): void {
		// Build table.
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $this->schema_provider() );

		// Seed all quotes to DB.
		$this->seed_quotes();
	}

	/**
	 * Inserts the quotes in to the table.
	 *
	 * @return void
	 */
	private function seed_quotes(): void {
		foreach ( $this->quote_provider() as $quote ) {
			$this->wpdb->insert(
				$this->table,
				array(
					'author' => $quote['author'],
					'body'   => $quote['body'],
				),
				array( '%s', '%s' )
			);
		}
	}

	/**
	 * Truncates the table.
	 *
	 * @return void
	 */
	public function down() {
		$this->wpdb->get_results(
			"DROP TABLE IF EXISTS {$this->table};" // phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		);
	}
}
