<?php

declare(strict_types=1);

/**
 * Controller for handling all wp hook interactions.
 *
 * @package Gin0115\PC_PF_Example1
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @since 1.0.0
 */

namespace Gin0115\PC_PF_Example1\Quote;

use PinkCrab\Loader\Loader;
use PinkCrab\Core\Services\View\View;
use PinkCrab\Core\Interfaces\Registerable;

class Quote_Controller implements Registerable {

	/**
	 * Access to quotes via which ever quote repository is passed
	 *
	 * @var Quote_Repository
	 */
	protected $quote_respoitory;

	/**
	 * Access to the currently defined template engine (implements Renderable)
	 *
	 * @var View
	 */
	protected $view;

	public function __construct(
		Quote_Repository $quote_respoitory,
		View $view
	) {
		$this->quote_respoitory = $quote_respoitory;
		$this->view             = $view;
	}

	/**
	 * Hook loader
	 *
	 * @param \PinkCrab\Loader\Loader $loader
	 * @return void
	 */
	public function register( Loader $loader ): void {
		$loader->front_filter( 'the_content', array( $this, 'render_quote_with_content' ) );
	}

	/**
	 * Renders a quote before the existing content body
	 *
	 * @param string $content
	 * @return string
	 */
	public function render_quote_with_content( string $content ): string {

		if ( ! is_single() ) {
			return $content;
		}

		$quote = $this->quote_respoitory->get_quote();

		$quote_html = $this->view->render(
			'quote/quote',
			array(
				'body'   => $quote->body(),
				'author' => $quote->author(),
			),
			View::RETURN_VIEW
		);

		return ( is_string( $quote_html ) ? wp_kses_post( $quote_html ) : '' )
			. $content;
	}
}
