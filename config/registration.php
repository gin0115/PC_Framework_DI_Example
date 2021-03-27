<?php

declare(strict_types=1);

/**
 * Holds all classes which are to be loaded on initalisation.
 *
 * @package Gin0115\PC_PF_Example1
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @since 1.0.0
 */

use Gin0115\PC_PF_Example1\Quote\Quote_Controller;

return array(
	/**
	 * Builds out controller and having the 'the_content' filter
	 * added to the loader.
	 *
	 * The controller is constructed using the DI Container, so all objects
	 * and iterfaces passed will be automatically resolved (when possible)
	 *
	 * As the quote controller has an interface passed as a cosntruct parameter
	 * a rule is added in dependencies.php, to pass the repostitory to be used.
	 */
	Quote_Controller::class,
);
