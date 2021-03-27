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
		// Even though we are passing an interface here, we can define
		// which repository to use in the depenedency.php file.
		$this->quote_respoitory = $quote_respoitory;

		// View has its own internal depenency (Renderable) which is what is
		// used to render html. By default we use the PHP engine, but can easily
		// be done using Blade, Twig, Mustache and any others.
		// We have a blade module, which can be added really easily if you need.
		$this->view = $view;
	}

	/**
	 * Hook loader
	 *
	 * @param \PinkCrab\Loader\Loader $loader
	 * @return void
	 */
	public function register( Loader $loader ): void {
		// This will add our filter, BUT it will only be added
		// When accessing the front end, using admin_filter() will do the reverse
		// or filter() will be added on either.
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

		// Get a quote from whatever repository we choose to inject.
		$quote = $this->quote_respoitory->get_quote();

		// If no quote returned, jsut reutrn the inital comment as is.
		if ( $quote === null ) {
			return $content;
		}

		// Generate the HTML for the quotes view.
		$quote_html = $this->view->render(
			'quote/quote', // File is /views/quote/quote.php
			array( // Sets these as variables for the template
				'body'   => $quote->body(), // $body
				'author' => $quote->author(), // $author
			),
			View::RETURN_VIEW // This ensures the templates html is returned not just printed.
		);

		// render() can be used to print, so have to check it actually reutrned a string.
		// If its doenst, just use a blank string.
		return ( is_string( $quote_html ) ? wp_kses_post( $quote_html ) : '' )
			. $content;
	}

}
