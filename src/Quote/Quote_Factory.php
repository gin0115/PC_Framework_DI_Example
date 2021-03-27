<?php

declare(strict_types=1);

/**
 * Factory for construction Quote objects.
 *
 * @package Gin0115\PC_PF_Example1
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @since 1.0.0
 */

namespace Gin0115\PC_PF_Example1\Quote;

use stdClass;
use Gin0115\PC_PF_Example1\Quote\Quote;

class Quote_Factory {

	/**
	 * Returns a new quote object based on the body and author passed as
	 * params.
	 *
	 * @param string $body
	 * @param string $author
	 * @return Quote
	 */
	public function create( string $body, string $author ): Quote {
		return new Quote( $body, $author );
	}

	/**
	 * Returns a populated quote from a stdclass that contains
	 * body and autor properties.
	 *
	 * @param object $class
	 * @return Quote
	 */
	public function from_stdclass( $class ): Quote {
		return new Quote(
			\property_exists( $class, 'body' ) ? $class->body : '',
			\property_exists( $class, 'author' ) ? $class->author : '',
		);
	}
}
