<?php

declare(strict_types=1);

/**
 * Quote Factory tests
 *
 * @package Gin0115\PC_PF_Example1
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @since 1.0.0
 */

namespace Gin0115\PC_PF_Example1\Tests\Quote;

use WP_UnitTestCase;
use Gin0115\PC_PF_Example1\Quote\Quote;
use Gin0115\PC_PF_Example1\Quote\Quote_Factory;

class Test_Quote_Factory extends WP_UnitTestCase {

	/** @var Quote_Factory */
	protected $quote_factory;

	public function setup(): void {
		parent::setup();
		$this->quote_factory = new Quote_Factory();
	}

	/** @testdox It should be possibe to create a quote from the text of the quote and author. */
	public function test_create_from_strings() {
		$quote = $this->quote_factory->create( 'body', 'author' );
		$this->assertEquals( 'body', $quote->body() );
		$this->assertEquals( 'author', $quote->author() );
	}

}
