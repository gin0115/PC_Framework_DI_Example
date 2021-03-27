<?php

declare(strict_types=1);

/**
 * Database implementaiton for Quote_Repository interface.
 *
 * @package Gin0115\PC_PF_Example1
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @since 1.0.0
 */

namespace Gin0115\PC_PF_Example1\Quote\Repository;

use stdClass;
use Gin0115\PC_PF_Example1\Quote\Quote;
use PinkCrab\Core\Application\App_Config;
use Gin0115\PC_PF_Example1\Quote\Quote_Factory;
use Gin0115\PC_PF_Example1\Quote\Quote_Repository;

class Quote_WPDB_Repository implements Quote_Repository {

	/** @var wpdb */
	protected $wpdb;

	/**
	 * Constructs our quote models.
	 *
	 * @var Quote_Factory
	 */
	protected $quote_factory;

	/**
	 * Access to the app general settings
	 *
	 * @var App_Settings
	 */
	protected $app_config;

	public function __construct(
		\wpdb $wpdb,
		Quote_Factory $quote_factory,
		App_Config $app_config
	) {
		$this->quote_factory = $quote_factory;
		$this->wpdb          = $wpdb;
		$this->app_config    = $app_config;
	}

	/**
	 * Returns a single quote
	 *
	 * @return Quote|null
	 */
	public function get_quote(): ?Quote {
        // phpcs:disable WordPress.DB.PreparedSQL.NotPrepared
		$quote = $this->wpdb->get_row(
			sprintf( 'SELECT * FROM %s LIMIT 1;', $this->app_config->db_tables( 'quote' ) )
		);

		return ! empty( $quote )
			? $this->populate_quote( $quote )
			: null;
	}

	/**
	 * Returns an array of quotes, or null's if not can be found.
	 *
	 * @param int $quote_count
	 * @return array<Quote|null>
	 */
	public function get_quotes( int $quote_count ): array {

        // phpcs:disable WordPress.DB.PreparedSQL.NotPrepared
		$all_quotes = $this->wpdb->get_results(
			sprintf( 'SELECT * FROM %s;', $this->app_config->db_tables( 'quote' ) )
		);

		// Map all array representations into Quote models.
		$quotes = array_map( array( $this, 'populate_quote' ), $all_quotes );

		return count( $quotes ) >= $quote_count
			? array_slice( $quotes, 0, $quote_count )
			: array_pad( $quotes, $quote_count, null );
	}

	/**
	 * Maps a quote from an array to Quote model.
	 *
	 * @param stdClass $quote
	 * @return Quote
	 */
	private function populate_quote( stdClass $quote ): Quote {
		return $this->quote_factory->from_stdclass( $quote );
	}
}
