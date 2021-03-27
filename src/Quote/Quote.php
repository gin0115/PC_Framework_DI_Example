<?php

declare(strict_types=1);

/**
 * Quote model
 *
 * @package Gin0115\PC_PF_Example1
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @since 1.0.0
 */

namespace Gin0115\PC_PF_Example1\Quote;

class Quote {

	/**
	 * The body of the quote.
	 *
	 * @var string
	 */
	protected $body = '';

	/**
	 * Author
	 *
	 * @var string
	 */
	protected $author = '';

	public function __construct( string $body, string $author ) {
		$this->body   = $body;
		$this->author = $author;
	}

	/**
	 * Get the body of the quote.
	 *
	 * @return string
	 */
	public function body(): string {
		return $this->body;
	}

	/**
	 * Get author
	 *
	 * @return string
	 */
	public function author(): string {
		return $this->author;
	}
}
