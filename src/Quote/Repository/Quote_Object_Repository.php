<?php

declare(strict_types=1);

/**
 * Interface for all Quote Repositories
 *
 * @package Gin0115\PC_PF_Example1
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @since 1.0.0
 */

namespace Gin0115\PC_PF_Example1\Quote\Repository;

use Gin0115\PC_PF_Example1\Quote\Quote;
use Gin0115\PC_PF_Example1\Quote\Quote_Factory;
use Gin0115\PC_PF_Example1\Quote\Quote_Repository;

class Quote_Object_Repository implements Quote_Repository {

	/**
	 * The internal collection of quotes
	 *
	 * @var array<array{body:string,author:string}>
	 */
	protected $quotes = array();

	/**
	 * Constructs our quote models.
	 *
	 * @var Quote_Factory
	 */
	protected $quote_factory;

	public function __construct( Quote_Factory $quote_factory ) {

		$this->quote_factory = $quote_factory;

		// Popultes the internal collection.
		$this->quotes = array(
			array(
				'body'   => 'Quote 1',
				'author' => 'Some Body',
			),
			array(
				'body'   => 'Quote 2',
				'author' => 'Some Person',
			),
			array(
				'body'   => 'Quote 3',
				'author' => 'Some Person',
			),
		);
	}

	/**
	 * Returns a single quote
	 *
	 * @return Quote|null
	 */
	public function get_quote(): ?Quote {
		return $this->populate_quote( $this->quotes[0] );
	}

	/**
	 * Returns an array of quotes, or null's if not can be found.
	 *
	 * @param int $quote_count
	 * @return array<Quote|null>
	 */
	public function get_quotes( int $quote_count ): array {

		// Map all array representations into Quote models.
		$quotes = array_map( array( $this, 'populate_quote' ), $this->quotes );

		return count( $quotes ) <= $quote_count
			? array_slice( $quotes, 0, $quote_count )
			: array_pad( $quotes, $quote_count, null );
	}

	/**
	 * Maps a quote from an array to Quote model.
	 *
	 * @param array $quote
	 * @return Quote
	 */
	private function populate_quote( array $quote ): Quote {
		return $this->quote_factory->create( $quote['body'], $quote['author'] );
	}


}
