<?php

declare(strict_types=1);

/**
 * Handles all the data used by App_Config
 *
 * @package Gin0115\PC_PF_Example1
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @since 1.0.0
 */

// Get the path of the plugin base.
$base_path  = \dirname( __DIR__, 1 );
$plugin_dir = \basename( $base_path );
$wp_uploads = \wp_upload_dir();

return array(
	'db_tables' => array(
		// This allows the use of Config::db_tables('quotes') to access the table name
		// You can use Config::db_tables('quotes')
		// or pass App_Config as a dependency and use $app_config->db_tables('quotes');
		'quotes' => 'gin0115_pcpf_quotes',
	),
);
