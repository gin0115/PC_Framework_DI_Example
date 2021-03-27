<?php

declare(strict_types=1);

/**
 * Interface for all Quote Repositories
 *
 * @package Gin0115\PC_PF_Example1
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @since 1.0.0
 */

namespace Gin0115\PC_PF_Example1\Quote;

interface Quote_Repository {

	/**
	 * Returns a single quote
	 *
	 * @return Quote|null
	 */
	public function get_quote(): ?Quote;

	/**
	 * Returns an array of quotes, or null's if not can be found.
	 *
	 * @param int $quote_count
	 * @return array<Quote|null>
	 */
	public function get_quotes( int $quote_count): array;
}
