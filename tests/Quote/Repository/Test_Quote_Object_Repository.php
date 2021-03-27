<?php

declare(strict_types=1);

/**
 * Quote Object Repository tests
 *
 * @package Gin0115\PC_PF_Example1
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @since 1.0.0
 */

namespace Gin0115\PC_PF_Example1\Tests\Quote\Repository;

use WP_UnitTestCase;
use Gin0115\PC_PF_Example1\Quote\Quote;
use Gin0115\PC_PF_Example1\Quote\Quote_Factory;
use Gin0115\PC_PF_Example1\Quote\Repository\Quote_Object_Repository;

class Test_Quote_Object_Repository extends WP_UnitTestCase {

	/** @var Quote_Object_Repository */
	protected $quote_repository;

	public function setup(): void {
		parent::setup();
		$this->quote_repository = new Quote_Object_Repository( new Quote_Factory );
	}

	/** @testdox Single quotes should be accessible */
	public function test_can_get_single_quote(): void {
		$quote = $this->quote_repository->get_quote();
		$this->assertInstanceOf( Quote::class, $quote );
	}

	/** @testdox When getting many quotes, any more than three will be set as null */
	public function test_can_get_many_quotes(): void {
		// 3 Quotes in object repository.
		$quotes_less = $this->quote_repository->get_quotes( 2 );
		$quotes_more = $this->quote_repository->get_quotes( 5 );

		$this->assertCount( 2, $quotes_less );
		$this->assertCount( 2, array_filter( $quotes_less, array( $this, 'is_quote' ) ) );

		$this->assertCount( 5, $quotes_more );
		$this->assertCount( 3, array_filter( $quotes_more, array( $this, 'is_quote' ) ) );

	}

    /**
     * Validates if a valid quote.
     *
     * @param mixed $quote
     * @return bool
     */
	protected function is_quote( $quote ): bool {
		return is_a( $quote, Quote::class );
	}

}
