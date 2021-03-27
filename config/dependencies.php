<?php

/**
 * Handles all depenedency injection rules and config.
 *
 * @package Gin0115\PC_PF_Example1
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @since 1.0.0
 */

use PinkCrab\Core\Application\App;
use PinkCrab\Core\Interfaces\Renderable;
use PinkCrab\Core\Services\View\PHP_Engine;
use Gin0115\PC_PF_Example1\Quote\Quote_Repository;
use Gin0115\PC_PF_Example1\Quote\Repository\Quote_Object_Repository;

return array(
	// Binds all default rules, when ever either of these classes are passed
	// as dependecnies to another class, this is what is passed.
	// These can be set as either the name of the class or an instance.
	'*'                     => array(
		'substitutions' => array(

			// This gives us access to DI Container, Config and View services
			App::class        => App::get_instance(),

			// This ensures the PHP Template Renderer is populated with the base
			// path of the view directory.
			Renderable::class => new PHP_Engine( $config->path( 'view' ) ),

			// This allows us to pass the global isntance of wpdb to any class
			// which has wpdb as a dependency
			wpdb::class       => $GLOBALS['wpdb'],

			// Due to where this file is loaded, we have access to $config.
			App_Config::class => $config,
		),


	),

	/**
	 * Any class which has the Quote_Repository interface passed as a construct
	 * parameter will have an which ever class is set here (that implements Quote_Repository)
	 * will be used when constructing that class.
	 *
	 * This is used as a parameter to the Quote_Controller.
	 */
	Quote_Repository::class => array(
		'instanceOf' => Quote_Object_Repository::class,
	),

);
