<?php

declare(strict_types=1);

/**
 * Quote model tests
 *
 * @package Gin0115\PC_PF_Example1
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @since 1.0.0
 */

namespace Gin0115\PC_PF_Example1\Tests\Quote;

use WP_UnitTestCase;
use Gin0115\PC_PF_Example1\Quote\Quote;

class Test_Quote extends WP_UnitTestCase {

	public function test_can_get_quote_values(): void {
		$quote = new Quote( 'Body of text', 'author' );
		$this->assertEquals( 'Body of text', $quote->body() );
		$this->assertEquals( 'author', $quote->author() );
	}
}
